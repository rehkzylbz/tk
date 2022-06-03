<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TK</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <div class="container pt-3">
            <h1>Запрос в транспортные компании</h1>
            <h5 class="my-3">Список отправлений:</h5>
            <?php foreach ($data['packs'] as $key => $pack) { ?>
                <form id="data_form_<?php echo $key; ?>" method="POST" class="data_form row border-bottom border-primary mb-5">                    
                    <div class="col-1"><?php echo $key; ?></div>
                    <div class="error_box alert alert-danger d-none col py-1" role="alert" id="error_box_<?php echo $key; ?>"></div>
                    <div class="result_box alert alert-success d-none col py-1" role="alert" id="result_box_<?php echo $key; ?>"></div>
                    <div class="row mb-2 col-12">
                        <label for="from_point" class="col-sm-2 col-form-label">Из: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="from_point" name="from_point" value="<?php echo $pack['from_point']; ?>">
                        </div>
                    </div>
                    <div class="row mb-2 col-12">
                        <label for="to_point" class="col-sm-2 col-form-label">В: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="to_point" name="to_point" value="<?php echo $pack['to_point']; ?>">
                        </div>
                    </div>
                    <div class="row mb-2 col-12">
                        <div class="input-group justify-content-between col-12 col-lg my-1">
                            <label for="weight" class="col-sm-3 col-form-label">Адресат: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="client" name="client" value="<?php echo $pack['client']; ?>">
                            </div>
                        </div>
                        <div class="input-group justify-content-between col-12 col-lg my-1">
                            <label for="weight" class="col-sm-3 col-form-label">Вес, кг: </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="weight" name="weight" value="<?php echo $pack['weight']; ?>" min="0" max="9999" step="0.1">
                            </div>
                        </div>
                        <div class="input-group justify-content-between col-12 col-lg my-1">
                            <label for="weight" class="col-sm-3 col-form-label">Объём, л: </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="volume" name="volume"  value="<?php echo $pack['volume']; ?>" min="0" max="9999" step="0.1">
                            </div>
                        </div>
                        <div class="input-group justify-content-between col-12 col-lg my-1">
                            <label for="company_name" class="col-sm-3 col-form-label">Компания: </label>
                            <div class="col-sm-9">
                                <select class="form-select" id="company_name" name="company_name">
                                    <option value="Fast">Быстрая</option>
                                    <option value="Slow">Медленная</option>
                                    <option value="Other" disabled>Другая</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            <?php } ?>
            <button id="send_form" class="btn btn-primary">Запросить</button>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <script src="app/resources/js/front.js"></script>
    </body>
</html>