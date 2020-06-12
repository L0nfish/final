<?php

class Ychet_inventMap extends BaseMap {
    public function findById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT ychet_inventar_id, naklad_id, inventar_id, kol_vo". "FROM ychet_invent WHERE ychet_inventar_id = $id");
            return $res->fetchObject("Ychet_invent");
        }
        return new Ychet_invent();
    }

    public function save(Ychet_invent $ychet_invent){
        if ($ychet_invent->validate()) {
            if ($ychet_invent->ychet_invent_id == 0) {
                return $this->insert($ychet_invent);
            }
            else {
                return $this->update($ychet_invent);
            }
        }
        return false;
    }

    private function insert(Ychet_invent $ychet_invent){
        $kol_vo = $this->db->quote($ychet_invent->kol_vo);
        if ($this->db->exec("INSERT INTO ychet_invent(kol_vo, naklad_id, inventar_id)". " VALUES($kol_vo,$ychet_invent->naklad_id, $ychet_invent->inventar_id)") == 1) {
            $ychet_invent->ychet_invent_id = $this->db->lastInsertId();
            return true;
        }
        return false;
    }

    private function update(Ychet_invent $ychet_invent){
        $kol_vo = $this->db->quote($ychet_invent->kol_vo);
        if ( $this->db->exec("UPDATE ychet_invent SET kol_vo = $kol_vo,". "naklad_id= $ychet_invent->naklad_id, inventar_id= $ychet_invent->inventar_id WHERE ychet_inventar_id = ".$ychet_invent->ychet_inventar_id) == 1) {
            return true;
        }
        return false;
    }

    public function findAll($ofset=0,$limit=30){
        $res = $this->db->query("SELECT ychet_invent.ychet_inventar_id, inventar.name AS name, naklad.naklad_id AS naklads, ychet_invent.kol_vo AS kol_vo " . " FROM ychet_invent 
        INNER JOIN inventar  ON ychet_invent.inventar_id = inventar.inventar_id
        INNER JOIN naklad  ON ychet_invent.naklad_id = naklad.naklad_id LIMIT $ofset,$limit");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }

    public function count(){
        $res = $this->db->query("SELECT COUNT(*) AS cnt FROM ychet_invent");
        return $res->fetch(PDO::FETCH_OBJ)->cnt;
    }

    public function findViewById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT ychet_invent.ychet_inventar_id, inventar.name AS name, naklad.naklad_id AS naklads, ychet_invent.kol_vo  " . " FROM ychet_invent 
            INNER JOIN inventar  ON ychet_invent.inventar_id = inventar.inventar_id
            INNER JOIN naklad  ON ychet_invent.naklad_id = naklad.naklad_id WHERE ychet_inventar_id = $id");
            return $res->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }
    public function arrInventarss(){
        $res = $this->db->query("SELECT inventar_id AS id, name AS value FROM inventar");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public function arrNakladss(){
        $res = $this->db->query("SELECT naklad_id AS id, naklad_id AS value FROM naklad");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findAlldate($ofset=0,$limit=30){
        $res = $this->db->query("SELECT ychet_invent.ychet_inventar_id, inventar.name AS name, naklad.naklad_id AS naklads, ychet_invent.kol_vo AS kol_vo, inventar.data_prov AS prov " . " FROM ychet_invent 
        INNER JOIN inventar  ON ychet_invent.inventar_id = inventar.inventar_id
        INNER JOIN naklad  ON ychet_invent.naklad_id = naklad.naklad_id WHERE inventar.data_prov>=CURRENT_DATE LIMIT $ofset,$limit");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }
}