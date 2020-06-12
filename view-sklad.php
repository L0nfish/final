<?php
require_once 'secure.php';

if (isset($_GET['id'])) {
    $id = Helper::clearInt($_GET['id']);
    $sklad = (new SkladMap())->findViewById($id);
    $header = 'Просмотр складов';
    require_once 'template/header.php';
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <section class="content-header">
                    <h1><?=$header;?></h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fafa-dashboard"></i> Главная</a></li>

                        <li><a href="list-sklad.php">Группы</a></li>

                        <li class="active"><?=$header;?></li>
                    </ol>
                </section>
                <div class="box-body">

                    <a class="btn btn-success" href="add-sklad.php?id=<?=$id;?>">Изменить</a>

                </div>
                <div class="box-body">

                    <table class="table table-bordered table-hover">

                        <tr>
                            <th>Название</th>

                            <td><?=$sklad->name;?></td>

                        </tr>
                        <tr>

                            <th>Номер склада</th>

                            <td><?=$sklad->nomer;?></td>

                        </tr>
                        <tr>

                            <th>Телефон</th>

                            <td><?=$sklad->telephone;?></td>

                        </tr>
                        <tr>
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