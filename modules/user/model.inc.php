<?php
class User_Model {
    public function Insert($row)
    {
        Core::$Db->Insert('user', $row);
    }

    public function Delete($id) {
        Core::$Db->DeleteById('user','id', $id);
    }

    public function Update($row) {
        Core::$Db->UpdateById("user", ["login" => $row["login"], "password" => $row["password"], "email" => $row["email"]], "id", $row["id"]);
    }

    public function FindById($id) {
        return Core::$Db->Select("user", ["id", "login", "password", "email"], ["id" => $id]);
    }

    public function FindAll() {
        return Core::$Db->Select("user", ["id", "login", "password", "email"]);
    }

    public function FindByLoginAndPassword($login, $password){
        return Core::$Db->Select("user", ["id", "login", "password", "email"], ["login" => $login, "password" => $password]);
    }

    public function FindByLogin($login) {
        return Core::$Db->Select("user", ["login"], ["login" => $login]);
    }
}