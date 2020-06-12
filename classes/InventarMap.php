<?php

class InventarMap extends BaseMap {
    public function findById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT inventar_id, name, type_inventar_id "
                . "FROM inventar WHERE inventar_id = $id");
            return $res->fetchObject("Inventar");
        }
        return new Inventar();
    }
    public function save(Inventar $inventar) {
        if ($inventar->validate()) {
            if ($inventar->inventar_id == 0) {
                return $this->insert($inventar);
            } else {
                return $this->update($inventar);
            }
        }
        return false;
    }
    private function insert(Inventar $inventar){
        $name = $this->db->quote($inventar->name);
        if ($this->db->exec("INSERT INTO inventar(name, type_inventar_id)"
                . " VALUES($name, $inventar->type_inventar_id)") == 1) {
            $inventar->inventar_id = $this->db->lastInsertId();
            return true;
        }
        return false;
    }
    private function update(Inventar $inventar) {
        $name = $this->db->quote($inventar->name);
        if ( $this->db->exec("UPDATE inventar SET name = " . $inventar . ",type_inventar_id = " . $inventar->inventar_id . ","
                . " WHERE inventar_id = ".$inventar->inventar_id) == 1) {
return true;
}
        return false;
    }
    public function findAll($ofset=0,$limit=30){
        $res = $this->db->query("SELECT inventar.inventar_id,inventar.name, type_invent.name AS type_invent"
            . " FROM inventar INNER JOIN type_invent ON inventar.type_inventar_id=type_invent.type_inventar_id LIMIT $ofset,$limit");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }
    public function count(){
        $res = $this->db->query("SELECT COUNT(*) AS cnt FROM inventar");
        return $res->fetch(PDO::FETCH_OBJ)->cnt;
    }
    public function findViewById($id=null){
        if ($id) {
$res = $this->db->query("SELECT inventar.inventar_id,inventar.name, type_invent.name AS type_invent"
    . " FROM inventar INNER JOIN type_invent ON inventar.type_inventar_id=type_invent.type_inventar_id WHERE inventar_id = $id");
return $res->fetch(PDO::FETCH_OBJ);
}
        return false;
    }
    public function arrInvents()
    {
        $res = $this->db->query("SELECT type_inventar_id AS id, name AS value FROM type_invent");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
