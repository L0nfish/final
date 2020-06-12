<?php
require_once 'secure.php';

$id = 0;
if (isset($_GET['id'])) {
$id = Helper::clearInt($_GET['id']);
}
$inventar = (new InventarMap())->findById($id);
$header = (($id)?'Редактировать':'Добавить').' инвентарь';
require_once 'template/header.php';
?>
<section class="content-header">
<h1><?=$header;?></h1>
<ol class="breadcrumb">

<li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>

<li><a href="list-inventar.php">Группы</a></li>
<li class="active"><?=$header;?></li>
</ol>
</section>
<div class="box-body">
<form action="save-inventar.php" method="POST">
<div class="form-group">
<label>Название</label>
<input type="text" class="form-control"name="name" required="required" value="<?=$inventar->name;?>">
</div>
<div class="form-group">
<label>Тип инвентаря</label>
<select class="form-control" name="type_inventar_id">
<?= Helper::printSelectOptions($inventar->type_inventar_id, (new InventarMap())->arrInvents());?>
</select>
</div>
<div class="form-group">
<button type="submit" name="saveInventar" class="btn btn-primary">Сохранить</button>
</div>
<input type="hidden" name="inventar_id"
value="<?=$id;?>"/>
</form>
</div>
<?php
require_once 'template/footer.php';
?>