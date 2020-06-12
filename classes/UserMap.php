<?php


class UserMap extends BaseMap
{
    


    const USER = 'user';
    

    public function identity($id){
        if ($this->findById($id)->validate()) {
            return self::USER;
        }
        return null;
    }



    public function auth($login, $password){
        $login = $this->db->quote($login);
        $res = $this->db->query("SELECT user.user_id, CONCAT(user.lastname,' ', user.firstname, ' ', IfNull(user.patronymic,'')) AS fio, "."user.pass, role.sys_name, role.name FROM user "."INNER JOIN role ON user.role_id=role.role_id "."WHERE user.login = $login ");
        $user = $res->fetch(PDO::FETCH_OBJ);
        if ($user) {
            if (password_verify($password, $user->pass))
            {
                return $user;
            }
        }
        return null;
    }

    public function findById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT user_id, lastname, firstname, patronymic, login, pass, sklad_id, date_birth, role_id ". "FROM user WHERE user_id = $id");
            $user = $res->fetchObject("User");
            if ($user) {
                return $user;
            }
        }
        return new User();
    }

    public function arrSklads(){
        $res = $this->db->query("SELECT sklad_id AS id, name AS value FROM sklad");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public function arrRoles(){
        $res = $this->db->query("SELECT role_id AS id, name AS value FROM role");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save(User $user){
        if (!$this->existsLogin($user->login)) {
            if ($user->user_id == 0) {
                return $this->insert($user);
            }
            else {
                return $this->update($user);
            }
        }
        return false;
    }

    private function insert(User $user)
    {
        $lastname = $this->db->quote($user->lastname);
        $firstname = $this->db->quote($user->firstname);
        $patronymic = $this->db->quote($user->patronymic);
        $login = $this->db->quote($user->login);
        $pass = $this->db->quote($user->pass);
        $date_birth = $this->db->quote($user->date_birth);

        if ($this->db->exec("INSERT INTO user(lastname,
firstname, patronymic, login, pass, sklad_id, date_birth,
role_id)"
                . " VALUES($lastname, $firstname, $patronymic, $login,
$pass, $user->sklad_id, $date_birth, $user->role_id,
") ) {
            $user->user_id = $this->db->lastInsertId();
            return true;
        }
        return false;
    }

    private function update(User $user){
        $lastname = $this->db->quote($user->lastname);
        $firstname = $this->db->quote($user->firstname);
        $patronymic = $this->db->quote($user->patronymic);
        $login = $this->db->quote($user->login);
        $pass = $this->db->quote($user->pass);
        $date_birth = $this->db->quote($user->date_birth);
        if ( $this->db->exec("UPDATE user SET lastname = $lastname, firstname = $firstname, patronymic = $patronymic,". " login = $login, pass = $pass, sklad_id = $user->sklad_id, date_birth = $date_birth, role_id = $user->role_id ". "WHERE user_id = ".$user->user_id) == 1) {
            return true;
        }
        return false;
    }

    private function existsLogin($login){
        $login = $this->db->quote($login);
        $res = $this->db->query("SELECT user_id FROM user WHERE login = $login");
        if ($res->fetchColumn() > 0) {
            return true;
        }
        return false;
    }

    public function findProfileById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT user.user_id, CONCAT(user.lastname,' ', user.firstname, ' ', user.patronymic) AS fio,". " user.login, user.birthday, sklad.name AS sklad, role.name AS role ". "INNER JOIN sklad ON user.sklad_id=sklad.sklad_id INNER JOIN role ON user.role_id=role.role_id WHERE user.user_id = $id");
            return $res->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }








}