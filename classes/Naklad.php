<?php

class Naklad extends Table
{

    public $naklad_id = 0;
    public $sklad_id = 0;
    public $type_naklad_id = 0;
    public $date = '';
    public $user_id = 0;

    public function validate()
    {
        if (!empty($this->sklad_id) &&
            !empty($this->type_naklad_id) &&
            !empty($this->date) &&
            !empty($this->user_id)) {
            return true;
        }
    }
}
