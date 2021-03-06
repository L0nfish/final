<?php
require_once 'secure.php';
$size = 5;
if (isset($_GET['page'])) {
    $page = Helper::clearInt($_GET['page']);
} else {
    $page = 1;
}
$inventarMap = new InventarMap();
$count = $inventarMap->count();
$inventars = $inventarMap->findAll($page*$size-$size, $size);
$header = 'Список инвентаря';
require_once 'template/header.php';
?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <section class="content-header">
                    <h1><?=$header;?></h1>
                    <ol class="breadcrumb">
                        <li><a href="/index.php"><i class="fafa-dashboard"></i> Главная</a></li>
                        <li class="active"><?=$header;?></li>
                    </ol>
                </section>
                <div class="box-body">

                    <a class="btn btn-success" href="add-inventar.php">Добавить инвентарь</a>

                </div>
                <div class="box-body">
                    <?php
                    if ($inventars) {
                        ?>

                        <table id="example2" class="table table-bordered table-hover">

                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Специальность</th>
                            

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($inventars as $inventar) {
                                echo '<tr>';

                                echo '<td><a href="view-inventar.php?id='.$inventar->inventar_id.'">'.$inventar->name.'</a> '

                                . '<a href="add-inventar.php?id='.$inventar->inventar_id.'"><i class="fa fa-pencil"></i></a></td>';

                                echo '<td>'.$inventar->type_invent.'</td>';

                                echo '</tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    <?php } else {
                        echo 'Ни одной группы не найдено';
                    } ?>
                </div>
                <div class="box-body">
                    <?php Helper::paginator($count, $page,
                        $size); ?>
                </div>
            </div>
        </div>
    </div>
<?php
require_once 'template/footer.php';
?>