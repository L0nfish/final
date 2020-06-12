<?php
require_once 'secure.php';
$size = 4;
if (isset($_GET['page'])) {
    $page = Helper::clearInt($_GET['page']);
} else {
    $page = 1;
}
$nakladMap = new NakladMap();
$count = $nakladMap->count();
$naklads = $nakladMap->findAll($page*$size-$size, $size);
$header = 'Список накладных';
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

                    <a class="btn btn-success" href="add-naklad.php">Добавить накладную</a>

                </div>
                <div class="box-body">
                    <?php
                    if ($naklads) {
                        ?>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Дата</th>
                                <th>Склад</th>
                                <th>Тип накладной</th>
                                <th>Пользователь</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($naklads as $naklad) {
                                echo '<tr>';
                                echo '<td><a href="view-naklad.php?id='.$naklad->naklad_id.'">'.$naklad->date.'</a> '. '<a href="add-naklad.php?id='.$naklad->naklad_id.'"><i class="fa fa-pencil"></i></a></td>';
                                echo '<td>'.$naklad->sklad.'</td>';
                                echo '<td>'.$naklad->type_naklad.'</td>';
                                echo '<td>'.$naklad->user.'</td>';
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