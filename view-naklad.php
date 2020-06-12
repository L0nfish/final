<?php
require_once 'secure.php';
if (isset($_GET['id'])) {
    $id = Helper::clearInt($_GET['id']);
    $naklad = (new NakladMap())->findViewById($id);
    $header = 'Просмотр предметов';
    require_once 'template/header.php';
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <section class="content-header">
                    <h1><?=$header;?></h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fafa-dashboard"></i> Главная</a></li>

                        <li><a href="list-naklad.php">Предметы</a></li>

                        <li class="active"><?=$header;?></li>
                    </ol>
                </section>
                <div class="box-body">

                    <a class="btn btn-success" href="add-naklad.php?id=<?=$id;?>">Изменить</a>

                </div>
                <div class="box-body">

                    <table class="table table-bordered table-hover">

                        <tr>
                            <th>Дата</th>

                            <td><?=$naklad->date;?></td>

                        </tr>
                        <tr>

                            <th>Склад</th>

                            <td><?=$naklad->sklad;?></td>

                        </tr>
                        <tr>

                            <th>Тип накладной</th>

                            <td><?=$naklad->type_naklad;?></td>

                        </tr>
                        <tr>

                            <th>Пользователь</th>

                            <td><?=$naklad->user;?></td>

                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
}
require_once 'template/footer.php';
?>