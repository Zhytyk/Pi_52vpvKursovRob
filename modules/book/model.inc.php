<?php
class Book_Model {
    public function Insert($row)
    {
        Core::$Db->Insert('Book', $row);
    }

    public function Delete($id) {
        Core::$Db->DeleteById('Book','id', $id);
    }

    public function Update($row) {
        Core::$Db->UpdateById("Book", ["name" => $row["name"], "description" => $row["description"], "date" => $row["date"]], "id", $row["id"]);
    }

    public function FindById($id) {
        return Core::$Db->Select("Book", ["id", "name", "description", "date"], ["id" => $id]);
    }

    public function FindLibraryIdBySectionId($id) {
        return Core::$Db->Select("Section", ["library_id"], ["id" => $id]);
    }

    public function FindAll($id_sec) {
        return Core::$Db->Select("Book", ["id", "section_id", "name", "description", "date"], ["section_id" => $id_sec]);
    }
}