<?php

class Sklad extends Table {

    public $sklad_id = 0;
    public $nomer = '';
    public $name = '';
    public $telephone = '';
    public $data_osnov = '';
    public $data_snos = '';

    public function validate()
{
    if (!empty($this->name) &&
        !empty($this->nomer) &&
        !empty($this->telephone) &&
        !empty($this->data_osnov) &&
        !empty($this->data_snos)) {
        return true;
    }
}

}
