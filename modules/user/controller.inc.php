<?php
class User_Controller {
    public function IndexAction() {
        if($_SESSION['user_login'] != 'admin') {
            header("LOCATION: http://cms/");
        }

        $view = new User_View();
        $model = new User_Model();

        $res = $model->FindAll();
        return array(
            "Header" => "Welcome admin!",
            "Body" => $view->Index($res)
        );
    }

    public function DeleteAction() {
        if($_SESSION['user_login'] != 'admin') {
            header("LOCATION: http://cms/");
        }

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $model = new User_Model();
            $model->Delete($_POST["id"]);
            header("LOCATION: http://cms/user/index");
        }
    }

    public function EditAction($id) {
        if($_SESSION['user_login'] != 'admin') {
            header("LOCATION: http://cms/");
        }
        $view =  new User_View();
        $model = new User_Model();
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $model = new User_Model();
            $model->Update($_POST);
            header("LOCATION: http://cms/user/index");
        }
        $user = $model->FindById($id[0]);
        return array(
            "Header" => "Welcome admin!",
            "Body" => $view->Edit($id, $user)
        );

    }


    public function RegisterAction() {
        if($_SESSION['user_login'] != 'admin') {
            header("LOCATION: http://cms/");
        }
        $header = "<span>Register please</span>";
        $view = new User_View();
        $model = new User_Model();

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if($_POST["password"] != $_POST["password_c"]) {
                $header = "<span>Please enter correct password</span>";
            } else {
                $check = $model->FindByLogin($_POST["login"]);
                if(count($check) == 0) {
                    $model->Insert(["login" => $_POST["login"], "password" => $_POST["password"], "email" => $_POST["email"]]);
                    header("LOCATION: http://cms/");
                } else {
                    $header = "<span>Please enter another login</span>";
                }
            }
        }


        return array(
            "Header" => $header,
            "Body" => $view->Register(),
        );
    }

    public function LoginAction() {
        unset($_SESSION["user_login"]);

        $view = new User_View();
        $model = new User_Model();

        $header = "<span>Register please</span>";

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $res = $model->FindByLoginAndPassword($_POST["login"], $_POST["password"]);
            if(count($res) > 0) {
                $_SESSION['user_login'] = $res[0]["login"];
                header("LOCATION: http://cms/");
            } else {
                $header = "<span>Please write correct data!</span> ";
            }
        }

        return array(
            "Header" => $header,
            "Body" => $view->Login()
        );
    }

    public function LogoutAction() {
        unset($_SESSION["user_login"]);
        header("LOCATION: http://cms/");
    }
}
