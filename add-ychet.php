<?php
require_once 'secure.php';
$id = 0;
if (isset($_GET['id'])) {
    $id = Helper::clearInt($_GET['id']);
}
$ychet_invent = (new Ychet_inventMap())->findById($id);
$header = (($id)?'Редактировать':'Добавить').' лист учёта';
require_once 'template/header.php';
?>
    <section class="content-header">
        <h1><?=$header;?></h1>
        <ol class="breadcrumb">

            <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>

            <li><a href="list-ychet.php">Учёт</a></li>
            <li class="active"><?=$header;?></li>
        </ol>
    </section>
    <div class="box-body">
        <form action="save-ychet.php" method="POST">
            <div class="form-group">
                <label>Количество</label>
                <input type="text" class="form-control" name="kol_vo" required="required" value="<?=$ychet_invent->kol_vo;?>">
            </div>

            <div class="form-group">
                <label>Накладная</label>
                <select class="form-control" name="naklad_id">
                    <?= Helper::printSelectOptions($ychet_invent->naklad_id, (new Ychet_inventMap())->arrNakladss());?>
                </select>
            </div>
            <div class="form-group">
                <label>Инвентарь</label>
                <select class="form-control" name="inventar_id">
                    <?= Helper::printSelectOptions($ychet_invent->inventar_id, (new Ychet_inventMap())->arrInventarss());?>
                </select>
            </div>

            
            <div class="form-group">
                <button type="submit" name="saveYchet_invent" class="btn btn-primary">Сохранить</button>
            </div>
            <input type="hidden" name="ychet_inventar_id" value="<?=$id;?>"/>
        </form>
    </div>
<?php
require_once 'template/footer.php';
?>