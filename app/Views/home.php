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
                    <form>
                        <div class="mb-3">
                            <label for="sbsubject" class="form-label">Проверяемый СМП</label>
                            <input type="text" class="form-control" id="sbsubject_search" autocomplete="off">
                        </div>

                        <div class="mb-3">
                            <label for="supervisor" class="form-label">Контролирующий орган</label>
                            <input type="text" class="form-control" id="supervisor_search" autocomplete="off">
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
                    <button type="button" class="btn btn-outline-secondary me-2">Добавить</button>
                    <button type="button" disabled class="btn btn-outline-secondary me-2">Редактировать</button>
                    <button type="button" disabled class="btn btn-danger">Удалить</button>
                </div>
                <div class="btn-group me-2" role="group" aria-label="First group">
                    <button type="button" class="btn btn-secondary" title="Экпортировать список в Excel">
                        <i class="bi bi-file-earmark-arrow-down"></i>
                    </button>
                    <button type="button" class="btn btn-secondary" title="Импортировать список из Excel">
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
    </div>
</div>

<!-- Результаты поиска -->

</div>
<!-- FOOTER: DEBUG INFO + COPYRIGHTS -->

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
        sbSubjectSearchId: 'sbsubject_search',
        supervisorSearchId: 'supervisor_search'
    });
</script>

<!-- -->

</body>
</html>