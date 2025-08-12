'use strict';

/**
 * Точка входа - инициализация
 */
async function init(params)
{
    const {
        tableId,
        searchFormId,
        newFormId,
        exportToExcelBtnId
    } = params;

    /**
     * Автодополнения для СМБ
     */
    $('.bsubject-search').autoComplete({
        bootstrapVersion: '4',
        noResultsText: 'Нет данных',
        resolverSettings: {
            url: 'sbsubjects/search',
        },
        formatResult: item => ({ value: item.id, text: item.name }),
        preventEnter: true
    });

    /**
     * Автодополнения для проверяющих органов
     */
    $('.supervisor-search').autoComplete({
        bootstrapVersion: '4',
        noResultsText: 'Нет данных',
        resolverSettings: {
            url: 'supervisors/search'
        },
        formatResult: item => ({ value: item.id, text: item.name }),
        preventEnter: true,
    });

    /**
     * Список проверок
     */
    const list = ExaminationsList({
        $el: $(`#${tableId}`)
    });

    /**
     * Форма поиска проверок
     */
    Form({
        $el: $(`#${searchFormId}`),
        async onSubmit(fields) {
            list.update(await getExaminations(fields));
        }
    });

    /**
     * Форма создания новой проверки
     */
    Form({
        $el: $(`#${newFormId}`),
        async onSubmit(fields) {
            alert('Создана проверка с данными: ' + JSON.stringify(await createExamination(fields), null, ' '));
        }
    });

    /**
     * Экспорт текущего списка в файл Excel
     */
    $(`#${exportToExcelBtnId}`).on('click', () => {
        const ids = list.getIds();

        if (ids.length) {
            exportListToExcel(ids);
        } else {
            alert('Нечего экспортировать!');
        }
    });
}

/**
 * Список (таблица) проверок - объектная обертка
 */
function ExaminationsList(params)
{
    const {
        $el
    } = params;

    const $body = $el.find('tbody');
    let _list = [];

    const wrapper = Object.freeze({
        update,
        getIds
    });

    return wrapper;

    /**
     * Метод обновления данных
     */
    function update(list)
    {
        _list = list;

        $body.html(
            list.map(exam => (
                `<tr>
                    <td><input type="checkbox"></td>
                    <td>${exam.smallBusinessSubject.name}</td>
                    <td>${exam.supervisor.name}</td>
                    <td>с ${exam.from} по ${exam.to}</td>
                    <td class="text-end">${exam.duration}</td>
                 </tr>`
            ))
        );
    }

    /**
     * Возвращает только идентификаторы проверок из текущего списка
     */
    function getIds()
    {
        return _list.map(({ id }) => id);
    }
}

/**
 * Форма - объектная обертка
 */
function Form(params)
{
    const {
        $el,
        onSubmit
    } = params;

    const submitHandler = ('function' === typeof onSubmit) ? onSubmit : function (){};

    $el.on('submit', function (e) {
        e.preventDefault();

        submitHandler(
            $el
                .serializeArray()
                .reduce(
                    (result, param) => ({ ...result, [param.name]: param.value.trim() }),
                    {}
                )
        );
    });
}

/**
 * Асинхронная функция поиска проверок по заданным параметрам
 */
async function getExaminations(params)
{
    try {
        return await postJson('examinations/search', params);
    } catch (e) {
        console.error(e);

        return [];
    }
}

/**
 * JSON POST-транспорт
 */
async function postJson(url, params)
{
    const response = await fetch(
        url,
        {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(params)
        }
    );

    return await response.json();
}

/**
 * Создает новую проверку с данными params
 */
async function createExamination(params)
{
    try {
        return await postJson('examinations', params);
    } catch (e) {
        console.error(e);
        return 'Ошибка создания проверки';
    }
}

/**
 * Экспорт списка проверок с заданными идентификаторами в файл Excel,
 * инициирует загрузку файла браузером.
 */
async function exportListToExcel(examinationIds)
{
    // Создаем объект параметров
    const params = new URLSearchParams();

    // Добавляем ID как параметр `ids[]` (подходит для PHP-бэкенда)
    examinationIds.forEach(id => params.append('ids[]', id));

    // Один из способов загрузки файла
    location.href = `examinations/export?${params.toString()}`;
}