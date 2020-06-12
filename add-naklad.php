<?php
require_once 'secure.php';
$id = 0;
if (isset($_GET['id'])) {
    $id = Helper::clearInt($_GET['id']);
}
$naklad = (new NakladMap())->findById($id);
$header = (($id)?'Редактировать':'Добавить').' Накладную';
require_once 'template/header.php';
?>
    <section class="content-header">
        <h1><?=$header;?></h1>
        <ol class="breadcrumb">

            <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>

            <li><a href="list-naklad.php">Накладные</a></li>
            <li class="active"><?=$header;?></li>
        </ol>
    </section>
    <div class="box-body">
        <form action="save-naklad.php" method="POST">
            <div class="form-group">
                <label>Дата</label>
                <input type="date" class="form-control" name="date" required="required" value="<?=$naklad->date;?>">
            </div>

            <div class="form-group">
                <label>Тип накладной</label>
                <select class="form-control" name="type_naklad_id">
                    <?= Helper::printSelectOptions($naklad->type_naklad_id, (new NakladMap())->arrNaklads());?>
                </select>
            </div>
            <div class="form-group">
                <label>Склад</label>
                <select class="form-control" name="sklad_id">
                    <?= Helper::printSelectOptions($naklad->sklad_id, (new NakladMap())->arrSklads());?>
                </select>
            </div>
            <div class="form-group">
                <label>Пользователь</label>
                <select class="form-control" name="user_id">
                    <?= Helper::printSelectOptions($naklad->user_id, (new NakladMap())->arrUsers());?>
                </select>
            </div>

            
            <div class="form-group">
                <button type="submit" name="saveNaklad" class="btn btn-primary">Сохранить</button>
            </div>
            <input type="hidden" name="naklad_id" value="<?=$id;?>"/>
        </form>
    </div>
<?php
require_once 'template/footer.php';
?>