<?php
require_once 'secure.php';
if (isset($_POST['naklad_id'])) {
    $naklad = new Naklad();
    $naklad->naklad_id =
        Helper::clearInt($_POST['naklad_id']);
    $naklad->sklad_id = Helper::clearInt($_POST['sklad_id']);
    $naklad->date =
        Helper::clearString($_POST['date']);
        $naklad->type_naklad_id =
        Helper::clearInt($_POST['type_naklad_id']);
        $naklad->user_id =
        Helper::clearInt($_POST['user_id']);
    
        if ((new NakladMap())->save($naklad)) {
        header('Location: view-naklad.php?id='.$naklad->naklad_id);
} else {
        if ($naklad->naklad_id) {

            header('Location: add-naklad.php?id='.$naklad->naklad_id);

        } else {
            header('Location: add-naklad.php');
        }
    }
}