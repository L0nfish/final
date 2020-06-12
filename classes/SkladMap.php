<?php

class SkladMap extends BaseMap
{
    public function findById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT sklad_id, name,nomer, telephone "
                . "FROM sklad WHERE sklad_id = $id");
            return $res->fetchObject("Sklad");
        }
        return new Sklad();
    }
    public function save(Sklad $sklad) {
        if ($sklad->validate()) {
            if ($sklad->sklad_id == 0) {
                return $this->insert($sklad);
            } else {
                return $this->update($sklad);
            }
        }
        return false;
    }
    private function insert(Sklad $sklad){
        $name = $this->db->quote($sklad->name);
        $nomer = $this->db->quote($sklad->nomer);
        $telephone = $this->db->quote($sklad->telephone);
        if ($this->db->exec("INSERT INTO sklad(name, nomer, telephone)"
                . " VALUES($name, $nomer,$telephone)") == 1) {
            $sklad->sklad_id = $this->db->lastInsertId();
            return true;
        }
        return false;
    }
    private function update(Sklad $sklad) {
        $name = $this->db->quote($sklad->name);
        $nomer = $this->db->quote($sklad->nomer);
        $telephone = $this->db->quote($sklad->telephone);
        if ( $this->db->exec("UPDATE sklad SET name = $name,nomer = $nomer, telephone = $telephone WHERE sklad_id = ".$sklad->sklad_id) == 1) {
            return true;
        }
        return false;
    }
    public function findAll($ofset=0,$limit=30){
        $res = $this->db->query("SELECT sklad.sklad_id,sklad.name, sklad.nomer,sklad.telephone"
            . " FROM sklad  LIMIT $ofset,$limit");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }
    public function count(){
        $res = $this->db->query("SELECT COUNT(*) AS cnt FROM sklad");
        return $res->fetch(PDO::FETCH_OBJ)->cnt;
    }
    public function findViewById($id=null){
        if ($id) {
$res = $this->db->query("SELECT sklad.sklad_id,sklad.name, sklad.nomer,sklad.telephone"
. " FROM sklad WHERE sklad_id = $id");
return $res->fetch(PDO::FETCH_OBJ);
}
        return false;
    }
    public function findAllsklad($ofset=0,$limit=30){
        $res = $this->db->query("SELECT sklad.sklad_id,sklad.name, sklad.nomer,sklad.telephone,sklad.data_osnov, sklad.data_snos"
            . " FROM sklad WHERE sklad.data_snos>CURRENT_DATE LIMIT $ofset,$limit");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }
}
?>