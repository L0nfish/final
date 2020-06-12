<?php
require_once 'secure.php';
if (isset($_POST['inventar_id'])) {
    $inventar = new Inventar();
    $inventar->inventar_id =
        Helper::clearInt($_POST['inventar_id']);
    $inventar->name = Helper::clearString($_POST['name']);
    $inventar->type_inventar_id =
        Helper::clearInt($_POST['type_inventar_id']);
    if ((new InventarMap())->save($inventar)) {
        header('Location: view-inventar.php?id='.$inventar->inventar_id);
} else {
        if ($inventar->inventar_id) {

            header('Location: add-inventar.php?id='.$inventar->inventar_id);

        } else {
            header('Location: add-inventar.php');
        }
    }
}