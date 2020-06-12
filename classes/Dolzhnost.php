<?php

class Dolzhnost extends Table {

    public $dolzhnost_id = 0;
    public $name = '';
    

    public function validate()
    {
        if (!empty($this->name) &&
            !empty($this->active)) {
            return true;
        }
        return false;
    }
}