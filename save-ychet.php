<?php
require_once 'secure.php';
if (isset($_POST['ychet_inventar_id'])) {
    $ychet_invent = new Ychet_invent();
    $ychet_invent->ychet_inventar_id =
        Helper::clearInt($_POST['ychet_inventar_id']);
    $ychet_invent->naklad_id = Helper::clearInt($_POST['naklad_id']);
    $ychet_invent->kol_vo =
        Helper::clearString($_POST['kol_vo']);
        $ychet_invent->inventar_id =
        Helper::clearInt($_POST['inventar_id']);
    
        if ((new Ychet_inventMap())->save($ychet_invent)) {
        header('Location: view-ychet.php?id='.$ychet_invent->ychet_inventar_id);
} else {
        if ($ychet_invent->ychet_inventar_id) {

            header('Location: add-ychet.php?id='.$ychet_invent->ychet_inventar_id);

        } else {
            header('Location: add-ychet.php');
        }
    }
}