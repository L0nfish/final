<?php
require_once 'secure.php';

if (isset($_GET['id'])) {
    $id = Helper::clearInt($_GET['id']);
    $inventar = (new InventarMap())->findViewById($id);
    $header = 'Просмотр инвентаря';
    require_once 'template/header.php';
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <section class="content-header">
                    <h1><?=$header;?></h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fafa-dashboard"></i> Главная</a></li>

                        <li><a href="list-inventar.php">Группы</a></li>

                        <li class="active"><?=$header;?></li>
                    </ol>
                </section>
                <div class="box-body">

                    <a class="btn btn-success" href="add-inventar.php?id=<?=$id;?>">Изменить</a>

                </div>
                <div class="box-body">

                    <table class="table table-bordered table-hover">

                        <tr>
                            <th>Название</th>

                            <td><?=$inventar->name;?></td>

                        </tr>
                        <tr>

                            <th>Тип инвентаря</th>

                            <td><?=$inventar->type_invent;?></td>

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