'use strict';

/**
 * Точка входа - инициализация
 */
async function init(params) {
    const {
        tableId,
        sbSubjectSearchId,
        supervisorSearchId,
        searchFormId
    } = params;

    const myTable = ExaminationsList({
        $el: $(`#${tableId}`)
    });

    SearchForm({
        $form: $(`#${searchFormId}`),
        async onSubmit(fields) {
               myTable.update(await getExaminations(fields));
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

    const wrapper = Object.freeze({
        update
    });

    return wrapper;

    /**
     * Метод обновления данных
     */
    function update(list)
    {
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
}

/**
 * Форма поиска - объектная обертка
 */
function SearchForm(params)
{
    const {
        $form,
        onSubmit
    } = params;

    const submitHandler = ('function' === typeof onSubmit) ? onSubmit : function (){};

    $('.bsubject-search', $form).autoComplete({
        bootstrapVersion: '4',
        noResultsText: 'Нет данных',
        resolverSettings: {
            url: 'sbsubjects/search',
        },
        formatResult: item => ({ value: item.id, text: item.name }),
        preventEnter: true
    });

    $('.supervisor-search', $form).autoComplete({
        bootstrapVersion: '4',
        noResultsText: 'Нет данных',
        resolverSettings: {
            url: 'supervisors/search'
        },
        formatResult: item => ({ value: item.id, text: item.name }),
        preventEnter: true,
    });

    $form.on('submit', function (e) {
        e.preventDefault();

        submitHandler(
            $form
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
async function getExaminations (params)
{
    try {
        const response = await fetch(
            'examinations/search',
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
    } catch (e) {
        console.error(e);

        return [];
    }
}