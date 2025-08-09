'use strict';

async function init(params) {
    const {
        tableId,
        sbSubjectSearchId,
        supervisorSearchId
    } = params;

    const myTable = MyTable({
        $el: $(`#${tableId}`)
    });

    $(`#${sbSubjectSearchId}`).autoComplete({
        bootstrapVersion: '4',
        resolverSettings: {
            url: 'sbsubjects/list.json'
        }
    });

    $(`#${supervisorSearchId}`).autoComplete({
        bootstrapVersion: '4',
        resolverSettings: {
            url: 'supervisors/list.json'
        }
    });


    myTable.update(await getExaminations());
}

/**
 *
 */
function MyTable(params)
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
     *
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
 *
 */
async function getExaminations ()
{
    try {
        const responce = await fetch(
            'examinations/search',
            {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({}),
            }
        );

        return await responce.json();
    } catch (e) {
        console.error(e);
    }
}