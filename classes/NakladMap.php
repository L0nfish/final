<?php


class NakladMap extends BaseMap
{
    public function findById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT naklad_id, date, sklad_id, type_naklad_id, user_id". "FROM naklad WHERE naklad_id = $id");
            return $res->fetchObject("Naklad");
        }
        return new Naklad();
    }

    public function save(Naklad $naklad){
        if ($naklad->validate()) {
            if ($naklad->naklad_id == 0) {
                return $this->insert($naklad);
            }
            else {
                return $this->update($naklad);
            }
        }
        return false;
    }

    private function insert(Naklad $naklad){
        $date = $this->db->quote($naklad->date);
        if ($this->db->exec("INSERT INTO naklad(date, sklad_id, type_naklad_id, user_id)". " VALUES($date,$naklad->sklad_id, $naklad->type_naklad_id, $naklad->user_id)") == 1) {
            $naklad->naklad_id = $this->db->lastInsertId();
            return true;
        }
        return false;
    }

    private function update(Naklad $naklad){
        $date = $this->db->quote($naklad->date);
        if ( $this->db->exec("UPDATE naklad SET date = $date,". "sklad_id= $naklad->sklad_id, type_naklad_id= $naklad->type_naklad_id, user_id= $naklad->user_id WHERE naklad_id = ".$naklad->naklad_id) == 1) {
            return true;
        }
        return false;
    }

    public function findAll($ofset=0,$limit=30){
        $res = $this->db->query("SELECT naklad.naklad_id, naklad.date, sklad.name AS sklad, type_naklad.name AS type_naklad, user.lastname AS user  " . " FROM naklad 
        INNER JOIN user  ON naklad.user_id = user.user_id
        INNER JOIN sklad ON naklad.sklad_id = sklad.sklad_id
        INNER JOIN type_naklad ON naklad.type_naklad_id = type_naklad.type_naklad_id LIMIT $ofset,$limit");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }

    public function count(){
        $res = $this->db->query("SELECT COUNT(*) AS cnt FROM naklad");
        return $res->fetch(PDO::FETCH_OBJ)->cnt;
    }

    public function findViewById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT naklad.naklad_id, naklad.date, sklad.name AS sklad, type_naklad.name AS type_naklad, user.lastname AS user " . " FROM naklad 
            INNER JOIN user  ON naklad.user_id = user.user_id
            INNER JOIN sklad ON naklad.sklad_id = sklad.sklad_id
            INNER JOIN type_naklad ON naklad.type_naklad_id = type_naklad.type_naklad_id WHERE naklad_id = $id");
            return $res->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }
    public function arrNaklads(){
        $res = $this->db->query("SELECT type_naklad_id AS id, name AS value FROM type_naklad");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public function arrSklads(){
        $res = $this->db->query("SELECT sklad_id AS id, name AS value FROM sklad");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public function arrUsers(){
        $res = $this->db->query("SELECT user_id AS id, lastname AS value FROM user");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

}