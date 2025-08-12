<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Плановые проверки</title>
    <meta name="description" content="Test task">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap-icons.min.css') ?>" rel="stylesheet">
</head>
<body>

<!-- HEADER: MENU + HEROE SECTION -->
<header>
</header>

<!-- CONTENT -->
<div class="container mt-4">
    <h1 class="mb-4">Перечень плановых проверок</h1>

    <!-- Форма поиска -->
    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="card mb-5">
                <div class="card-body">
                    <form id="searchForm">
                        <div class="mb-3">
                            <label for="sbsubject" class="form-label">Проверяемый СМП</label>
                            <input
                                type="text"
                                name="sbsubject"
                                class="form-control bsubject-search"
                                autocomplete="off"
                                spellcheck="false">
                        </div>

                        <div class="mb-3">
                            <label for="supervisor" class="form-label">Контролирующий орган</label>
                            <input
                                type="text"
                                name="supervisor"
                                class="form-control supervisor-search"
                                autocomplete="off"
                                spellcheck="false">
                        </div>
                        <div class="grid gap-2">
                            <button type="submit" class="btn btn-primary">Найти</button>
                            <button type="reset" class="btn btn-outline-secondary">Очистить</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar">
                <div class="input-group" role="group" aria-label="First group">
                    <button
                        type="button"
                        class="btn btn-outline-secondary me-2"
                        data-bs-toggle="modal"
                        data-bs-target="#createModal"
                        title="Добавить проверку"
                    >Добавить</button>
                    <button
                        type="button"
                        disabled
                        class="btn btn-outline-secondary me-2"
                        title="Редактировать проверку"
                    >Редактировать</button>
                    <button
                        type="button"
                        disabled
                        class="btn btn-danger"
                        title="Удалить проверку"
                    >Удалить</button>
                </div>
                <div class="btn-group me-2" role="group" aria-label="First group">
                    <button type="button" id="exportToExcel" class="btn btn-secondary" title="Экпортировать список в Excel">
                        <i class="bi bi-file-earmark-arrow-down"></i>
                    </button>
                    <button type="button" disabled class="btn btn-secondary" title="Импортировать список из Excel">
                        <i class="bi bi-file-earmark-arrow-up"></i>
                    </button>
                </div>
            </div>
            
            <div class="card mt-3">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col"><input type="checkbox"></th>
                            <th scope="col">Проверяемый СМП</th>
                            <th scope="col">Контролирующий орган</th>
                            <th scope="col">Плановый период проверки</th>
                            <th scope="col">Плановая длительность</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                <div
                        class="border rounded"
                        data-coreui-locale="en-US"
                        data-coreui-start-date="2024/02/13"
                        data-coreui-toggle="calendar"
                ></div>
            </div>
        </div>
    </div>
</div>

<!-- Форма создания проверки -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить проверку</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form id="newForm">
                    <div class="mb-3">
                        <label for="newSbsubjectName" class="col-form-label">Проверяемый СМП:</label>
                        <input
                            type="text"
                            autocomplete="off"
                            spellcheck="false"
                            required
                            class="form-control bsubject-search"
                            name="sbsubject"
                            id="newSbsubjectName">
                    </div>
                    <div class="mb-3">
                        <label for="newSupervisorName" class="col-form-label">Контролирующий орган:</label>
                        <input
                            type="text"
                            required
                            autocomplete="off"
                            spellcheck="false"
                            class="form-control supervisor-search"
                            name="supervisor"
                            id="newSupervisorName">
                    </div>
                    <div class="mb-3">
                        <label for="newPeriodFrom" class="col-form-label">Плановый период:</label>
                        <div class="col">
                            с:&nbsp;<input type="date" required name="from" class="orm-control" id="newPeriodFrom">&nbsp;&nbsp;
                            по:&nbsp;<input type="date" required name="to" class="orm-control" id="newPeriodTo">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="newPlannedDuration" class="col-form-label">Плановая длительность:</label>
                        <div class="col-5">
                            <input type="number" required name="duration" class="form-control" id="newPlannedDuration" value="3">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="reset" form="newForm" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="submit" form="newForm" class="btn btn-primary">Добавить</button>
            </div>
        </div>
    </div>
</div>

<footer>
</footer>

<!-- jQuery -->
<script src="<?= base_url('assets/js/jquery-3.7.1.min.js') ?>"></script>
<!-- Bootstrap JS Bundle (Popper + JS) -->
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap-autocomplete.min.js') ?>"></script>
<script src="<?= base_url('assets/js/main.js') ?>"></script>

<script {csp-script-nonce}>
    init({
        tableId: 'myTable',
        searchFormId: 'searchForm',
        newFormId: 'newForm',
        exportToExcelBtnId: 'exportToExcel'
    });
</script>

<!-- -->

</body>
</html>