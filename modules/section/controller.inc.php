<?php
class Section_Controller {

    public function IndexAction($id_lib) {
        $view = new Section_View();
        $model = new Section_Model();

        $res = $model->FindAll($id_lib[0]);
        return array(
            "Body" => $view->Index($res, $id_lib[0])
        );
    }

    public function AddAction($id_lib) {
        if(!isset($_SESSION['user_login'])) {
            header("LOCATION: http://cms");
        }

        $view = new Section_View();

        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $model = new Section_Model();
            $row = $_POST;
            $model->Insert($row);
            header("LOCATION: http://cms/section/index/".$_POST["library_id"]);
            return;
        }

        return array(
            "Body" => $view->Add($id_lib[0])
         );
    }

    public function DeleteAction($id_lib) {
        if(!isset($_SESSION['user_login'])) {
            header("LOCATION: http://cms");
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $model = new Section_Model();
            $id = $_POST['id'];
            $model->Delete($id);
            header("LOCATION: http://cms/section/index/".$id_lib[0]);
        }
    }

    public function EditAction($ids) {
        if(!isset($_SESSION['user_login'])) {
            header("LOCATION: http://cms");
        }

        $view = new Section_View();
        $model = new Section_Model();
        $res = $model->FindById($ids[0]);
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $row = $_POST;
            $model->Update($row);
            header("LOCATION: http://cms/section/index/".$_POST['library_id']);
            return;
        }
        return array(
          "Body" => $view->Add($ids[1], $res[0]),
        );
    }
}
