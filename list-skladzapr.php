<?php
require_once 'secure.php';
$size = 5;
if (isset($_GET['page'])) {
    $page = Helper::clearInt($_GET['page']);
} else {
    $page = 1;
}
$skladMap = new SkladMap();
$count = $skladMap->count();
$sklads = $skladMap->findAllsklad($page*$size-$size, $size);
$header = 'Список складов';
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

                    

                </div>
                <div class="box-body">
                    <?php
                    if ($sklads) {
                        ?>

                        <table id="example2" class="table table-bordered table-hover">

                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Номер</th>
                                <th>Телефон</th>
                                <th>Дата основания</th>
                                <th>Дата сноса</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($sklads as $sklad) {
                                echo '<tr>';

                                echo '<td><a href="view-sklad.php?id='.$sklad->sklad_id.'">'.$sklad->name.'</a> '

                                . '<a href="add-sklad.php?id='.$sklad->sklad_id.'"><i class="fa fa-pencil"></i></a></td>';

                                echo '<td>'.$sklad->nomer.'</td>';
                                echo '<td>'.$sklad->telephone.'</td>';
                                echo '<td>'.$sklad->data_osnov.'</td>';
                                echo '<td>'.$sklad->data_snos.'</td>';
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