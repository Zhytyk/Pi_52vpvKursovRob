<?php
class Book_Controller {
    public function IndexAction($id_sec) {
        $view = new Book_View();
        $model = new Book_Model();

        $res = $model->FindAll($id_sec[0]);
        $id_lib = $model->FindLibraryIdBySectionId($id_sec[0])[0]["library_id"];
        return array(
            "Body" => $view->Index($res, $id_sec[0], $id_lib)
        );
    }

    public function AddAction($id_sec) {
        if(!isset($_SESSION['user_login'])) {
            header("LOCATION: http://cms");
        }

        $view = new Book_View();

        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $model = new Book_Model();
            $row = $_POST;
            $model->Insert($row);
            header("LOCATION: http://cms/book/index/".$_POST["section_id"]);
            return;
        }

        return array(
            "Body" => $view->Add($id_sec[0])
        );
    }

    public function DeleteAction($id_sec) {
        if(!isset($_SESSION['user_login'])) {
            header("LOCATION: http://cms");
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $model = new Book_Model();
            $id = $_POST['id'];
            $model->Delete($id);
            header("LOCATION: http://cms/book/index/".$id_sec[0]);
        }
    }

    public function EditAction($ids) {
        if(!isset($_SESSION['user_login'])) {
            header("LOCATION: http://cms");
        }

        $view = new Book_View();
        $model = new  Book_Model();
        $res = $model->FindById($ids[0]);
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $row = $_POST;
            $model->Update($row);
            header("LOCATION: http://cms/section/index/".$_POST['section_id']);
            return;
        }
        return array(
            "Body" => $view->Add($ids[1], $res[0]),
        );
    }
}
