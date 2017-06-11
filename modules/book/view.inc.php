<?php
class Book_View {
    public function Index($assocParam = null, $id_sec, $id_lib) {
        $tpl = new Template('template/book/index.tpl');
        $body = "";
        if($assocParam != null) {
            foreach ($assocParam as  $value) {
                $body .= "<article>";
                $body .= "<header>".$value["name"]."</header>";
                $body .= "<div>".$value["description"]."</div>";
                $body .= "<footer>".$value["date"]."</footer>";
                if(isset($_SESSION['user_login'])) {
                    $body .= "<a class='go' href='/book/edit/" . $value['id'] . "/" . $id_sec . "'>Edit</a>";
                    $body .= "<form class='delete' method='POST' action='/book/delete/" . $id_sec . "'><input type='hidden' name='id' value=" . $value["id"] . " /><input type='submit' value='delete' /></form>";
                }
                $body .= "</article>";
            }
        }

        if(isset($_SESSION['user_login']))
            $body .= "<div><a class='go' href='/book/add/".$id_sec."'>Add Book</a></div>";
        $body .= "<div><a class='go' href='/section/index/".$id_lib."'>Go to back!</a></div>";

        $tpl->SetParam("Body", $body);

        return $tpl->GetHTML();
    }

    public function Add($id_sec, $assocParam = null) {
        $tpl = new Template('template/book/add.tpl');

        if($assocParam != null) {
            foreach ($assocParam as $key => $value) {
                $tpl->SetParam($key, $value);
            }
        }

        $tpl->SetParam("id_sec", $id_sec);
        return $tpl->GetHTML();
    }
}