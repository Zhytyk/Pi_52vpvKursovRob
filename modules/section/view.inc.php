<?php
class Section_View {

    public function Index($assocParam = null, $id_lib) {
        $tpl = new Template('template/section/index.tpl');
        $body = "";
        if($assocParam != null) {
            foreach ($assocParam as  $value) {
                $body .= "<article>";
                $body .= "<header>".$value["name"]."</header>";
                $body .= "<div>".$value["description"]."</div>";
                $body .= "<footer>".$value["date"]."</footer>";
                if(isset($_SESSION['user_login'])) {
                    $body .= "<a class='go' href='/section/edit/" . $value['id'] . "/" . $id_lib . "'>Edit</a>";
                    $body .= "<form class='delete' method='POST' action='/section/delete/" . $id_lib . "'><input type='hidden' name='id' value=" . $value["id"] . " /><input type='submit' value='delete' /></form>";
                }
                $body .= "<a class='go' href='/book/index/".$value['id']."'>Go to books</a>";
                $body .= "</article>";
            }
        }
        if(isset($_SESSION['user_login']))
            $body .= "<div><a class='go' href='/section/add/".$id_lib."'>Add section</a></div>";
        $body .= "<div><a class='go' href='/'>Go to back!</a></div>";

        $tpl->SetParam("Body", $body);

        return $tpl->GetHTML();
    }

    public function Add($id_lib, $assocParam = null) {
        $tpl = new Template('template/section/add.tpl');

        if($assocParam != null) {
            foreach ($assocParam as $key => $value) {
                $tpl->SetParam($key, $value);
            }
        }

        $tpl->SetParam("id_lib", $id_lib);
        return $tpl->GetHTML();
    }
}