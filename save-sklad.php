<?php
require_once 'secure.php';
if (isset($_POST['sklad_id'])) {
    $sklad = new Sklad();
    $sklad->sklad_id =
        Helper::clearInt($_POST['sklad_id']);
    $sklad->name = Helper::clearString($_POST['name']);
    $sklad->nomer =
        Helper::clearString($_POST['nomer']);
        $sklad->telephone =
        Helper::clearString($_POST['telephone']);
        
    
        if ((new SkladMap())->save($sklad)) {
        header('Location: view-sklad.php?id='.$sklad->sklad_id);
} else {
        if ($sklad->sklad_id) {

            header('Location: add-sklad.php?id='.$sklad->sklad_id);

        } else {
            header('Location: add-sklad.php');
        }
    }
}