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

    <!-- jQuery -->
    <script src="<?= base_url('assets/js/jquery-3.7.1.min.js') ?>"></script>

    <!-- Bootstrap JS Bundle (Popper + JS) -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

    <style>
      #searchResults {
          position: absolute;
          z-index: 1000;
          width: 100%;
          max-height: 400px;
          overflow-y: auto;
          box-shadow: 0 6px 12px rgba(0,0,0,.175);
      }

      .list-group-item {
          cursor: pointer;
          transition: background-color 0.2s;
      }

      .list-group-item:hover {
          background-color: #f8f9fa;
      }
    </style>

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
            <!--<div class="col-md-8">
                <form method="post" action="<?= site_url('search') ?>">
                    <div class="form-group">
                        <label for="sbSubjectInput">Наименование СМП</label>
                        <input type="text"
                               class="form-control"
                               id="sbSubjectInput"
                               placeholder="Начните ввод...">
                        <div id="sbSubjectInputResults" class="list-group mt-2 d-none"></div>

                        <label for="supervisorInput">Контролирующий орган</label>
                        <input type="text"
                               class="form-control"
                               id="supervisorInput"
                               placeholder="Начните ввод...">
                        <div id="supervisorInputResults" class="list-group mt-2 d-none"></div>
                    </div>

                    <button class="btn btn-primary btn-lg" type="submit">
                        <i class="bi bi-search"></i> Найти
                    </button>
                </form>
            </div>-->

            <div class="card">
                <div class="card-header">
                    <h5>Результаты поиска</h5>
                </div>
                <div class="card-body" id="examinations_container">
                    Test
                </div>
            </div>
    </div>
</div>

        <!--<div class="input-group mb-4">
            <input type="text"
                   name="search_term"
                   class="form-control form-control-lg"
                   placeholder="Введите поисковый запрос..."
                   value="<?= esc($search_term ?? '') ?>">
            <button class="btn btn-primary btn-lg" type="submit">
                <i class="bi bi-search"></i> Найти
            </button>
        </div>
    </form>-->

    <!-- Результаты поиска -->

</div>
<!-- FOOTER: DEBUG INFO + COPYRIGHTS -->

<footer>
</footer>

<!-- SCRIPTS -->

<script {csp-script-nonce}>
    fetch(
        'search_examinations',
        {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({}),
        }
    );
</script>

<!-- -->

</body>
</html>
