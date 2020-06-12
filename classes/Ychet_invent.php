<?php

class Ychet_invent extends Table {

    public $ychet_inventar_id = 0;
    public $naklad_id = 0;
    public $inventar_id = 0;
    public $kol_vo = '';

    public function validate()
    {
        if (!empty($this->naklad_id) &&
        !empty($this->inventar_id) &&
        !empty($this->kol_vo) 
        ) {
            return true;
        }
        return false;
    }
}