<?php
class Library_Controller {
    public function AddAction() {
        if(!isset($_SESSION['user_login'])) {
            header("LOCATION: http://cms");
        }

        $view = new Library_View();

        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $model = new Library_Model();
            $row = $_POST;
            $model->Insert($row);
            header("LOCATION: http://cms");
            return;
        }
        return array(
            "Body" => $view->Add()
         );
    }

    public function DeleteAction() {
        if(!isset($_SESSION['user_login'])) {
            header("LOCATION: http://cms");
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $model = new Library_Model();
            $id = $_POST['id'];
            $model->Delete($id);
        }
    }

    public function EditAction($params) {
        if(!isset($_SESSION['user_login'])) {
            header("LOCATION: http://cms");
        }

        $view = new Library_View();
        $model = new Library_Model();
        $res = $model->FindById($params[0]);
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $row = $_POST;
            $model->Update($row);
            header("LOCATION: http://cms");
            return;
        }
        return array(
          "Body" => $view->Add($res[0]),
        );
    }
}
