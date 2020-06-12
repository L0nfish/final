<?php
require_once 'secure.php';
if (isset($_GET['id'])) {
    $id = Helper::clearInt($_GET['id']);
    $ychet = (new Ychet_inventMap())->findViewById($id);
    $header = 'Просмотр листов учёта';
    require_once 'template/header.php';
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <section class="content-header">
                    <h1><?=$header;?></h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fafa-dashboard"></i> Главная</a></li>

                        <li><a href="list-ychet.php">Листы учёта</a></li>

                        <li class="active"><?=$header;?></li>
                    </ol>
                </section>
                <div class="box-body">

                    <a class="btn btn-success" href="add-ychet.php?id=<?=$id;?>">Изменить</a>

                </div>
                <div class="box-body">

                    <table class="table table-bordered table-hover">

                        <tr>
                            <th>Количество</th>

                            <td><?=$ychet->kol_vo;?></td>

                        </tr>
                        <tr>

                            <th>Инвентарь</th>

                            <td><?=$ychet->name;?></td>

                        </tr>
                        <tr>

                            <th>Накладная</th>

                            <td><?=$ychet->naklads;?></td>

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