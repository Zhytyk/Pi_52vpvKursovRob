<?php
class Library_Model {
    public function Insert($row)
    {
        Core::$Db->Insert('Library', $row);
    }

    public function Delete($id) {
        Core::$Db->DeleteById('Library','id', $id);
    }

    public function Update($row) {
        Core::$Db->UpdateById("Library", ["name" => $row["name"], "description" => $row["description"], "date" => $row["date"]], "id", $row["id"]);
    }

    public function FindById($id) {
        return Core::$Db->Select("Library", ["id", "name", "description", "date"], ["id" => $id]);
    }
}