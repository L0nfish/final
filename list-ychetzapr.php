<?php
require_once 'secure.php';
$size = 4;
if (isset($_GET['page'])) {
    $page = Helper::clearInt($_GET['page']);
} else {
    $page = 1;
}
$ychet_inventMap = new Ychet_inventMap();
$count = $ychet_inventMap->count();
$ychets = $ychet_inventMap->findAlldate($page*$size-$size, $size);
$header = 'Список учётных листов';
require_once 'template/header.php';
?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <section class="content-header">
                    <h1><?=$header;?></h1>
                    <ol class="breadcrumb">
                        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                        <li class="active"><?=$header;?></li>
                    </ol>
                </section>
                <div class="box-body">

                   
                </div>
                <div class="box-body">
                    <?php
                    if ($ychets) {
                        ?>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Количество</th>
                                <th>Название инвентаря</th>
                                <th>Накладная</th>
                                <th>Последняя дата проверки</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($ychets as $ychet) {
                                echo '<tr>';

                                echo '<td><a href="view-ychet.php?id='.$ychet->ychet_inventar_id.'">'.$ychet->kol_vo.'</a> '

                                . '<a href="add-ychet.php?id='.$ychet->ychet_inventar_id.'"><i class="fa fa-pencil"></i></a></td>';

                                echo '<td>'.$ychet->name.'</td>';
                                echo '<td>'.$ychet->naklads.'</td>';
                                echo '<td>'.$ychet->prov.'</td>';
                                echo '</tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    <?php } else {
                        echo 'Ни одного предмета не найдено';
                    } ?>
                </div>
                <div class="box-body">
                    <?php Helper::paginator($count, $page,$size); ?>
                </div>
            </div>
        </div>
    </div>
<?php
require_once 'template/footer.php';
?>