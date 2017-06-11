<?php
class User_View {
    public function Index($assocParam) {
        $tpl = new Template("template/user/index.tpl");
        $body = "";

        if($assocParam != null) {
            foreach ($assocParam as $value) {
                $body .= "<article>";
                $body .= "<div>Login : <span>".$value["login"]."</span>";
                $body .= "<div><a href='/user/edit/".$value["id"]."' >Edit</a></div>";
                $body .= "<form method='post' action='/user/delete'><input type='hidden' name='id' value='".$value["id"]."' /><input type='submit' value='delete' /></form>";
                $body .= "</div></article>";
            }
        }
        $body .= "<a class='go' href='/'>Go to home</a>";

        $tpl->SetParam("Body", $body);

        return $tpl->GetHTML();
    }

    public function Edit($id, $assocParam = null) {
        $tpl = new Template("template/user/edit.tpl");

        foreach ($assocParam[0] as $key => $value) {
            $tpl->SetParam($key, $value);
        }

        return $tpl->GetHtml();
    }

    public function Register() {
        $tpl = new Template("template/user/register.tpl");

        return $tpl->GetHTML();
    }

    public function Login() {
        $tpl = new Template("template/user/login.tpl");

        return $tpl->GetHTML();
    }
}