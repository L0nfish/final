<?php

class Inventar extends Table {

    public $inventar_id = 0;
    public $name = '';
    public $type_inventar_id = 0;
    public $data_prov = '';

    public function validate()
    {
        if (!empty($this->name) &&
            !empty($this->type_inventar_id) &&
            !empty($this->data_prov)
            ) {
            return true;
        }
        return false;
    }
}