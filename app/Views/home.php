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
</head>
<body>

<!-- HEADER: MENU + HEROE SECTION -->
<header>
</header>

<!-- CONTENT -->
<div class="container mt-5">
    <h1 class="mb-4">Перечень плановых проверок</h1>

    <!-- Форма поиска -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="card">
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
<script src="<?= base_url('assets/js/main.js') ?>"></script>

<script {csp-script-nonce}>
    init({
        tableId: 'myTable',
    });
</script>

<!-- -->

</body>
</html>