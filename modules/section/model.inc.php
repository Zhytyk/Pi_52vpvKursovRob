<?php
class Section_Model {
    public function Insert($row)
    {
        Core::$Db->Insert('Section', $row);
    }

    public function Delete($id) {
        Core::$Db->DeleteById('Section','id', $id);
    }

    public function Update($row) {
        Core::$Db->UpdateById("Section", ["name" => $row["name"], "description" => $row["description"], "date" => $row["date"]], "id", $row["id"]);
    }

    public function FindById($id) {
        return Core::$Db->Select("Section", ["id", "name", "description", "date"], ["id" => $id]);
    }

    public function FindAll($id_lib) {
        return Core::$Db->Select("Section", ["id", "library_id", "name", "description", "date"], ["library_id" => $id_lib]);
    }
}