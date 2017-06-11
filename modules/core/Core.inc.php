<?php
class Core
{
    public static $Db;
    public static $IndexTPL;
    public static function Init()
    {
        session_start();
        self::$Db = new Database("localhost", 'cms', 'root', '');
        self::$IndexTPL = new Template("template/index.tpl");
    }
    public static function Run()
    {
        self::MainPageInit();

        $url = $_GET['url'];
        $parts = explode('/', $url);
        $className = ucfirst(array_shift($parts)).'_Controller';
        $methodName = ucfirst(array_shift($parts)).'Action';

        if (class_exists($className))
        {
            $moduleObject = new $className();
            if (method_exists($moduleObject, $methodName))
            {
                $params = $moduleObject->$methodName($parts);
                self::$IndexTPL->SetParams($params);
            }
            else
            {
                // 404
            }
        } else
        {
            // 404
        }

    }

    public static function MainPageInit() {
        $header = "Welcome";

        if(!isset($_SESSION['user_login'])) {
            $header .= "<div><a class='go' href='/user/login'>Log in</a></div>";
        } else {
            $header .= " ".$_SESSION['user_login'];
            if($_SESSION['user_login'] == 'admin') {
                $header .= " <div><a class='go' href='/user/index'>View users!</a></div>";
                $header .= " <div><a class='go' href='/user/register'>Register users!</a></div>";
            }
            $header .= "<div><a href='/user/logout'>Log out</a></div>";
        }

        $body = "";

        $res = self::$Db->Select("Library", ["id", "name", "description", "date"]);

        foreach ($res as $value) {
            $body .= "<article>";
            $body .= "<header>".$value["name"]."</header>";
            $body .= "<div>".$value["description"]."</div>";
            $body .= "<footer>".$value["date"]."</footer>";
            if(isset($_SESSION['user_login'])) {
                $body .= "<a class='go' href='/library/edit/" . $value['id'] . "'>Edit</a>";
                $body .= "<form class='delete' method='POST' action='/library/delete/".$value['id']."'><input type='hidden' name='id' value=" . $value["id"] . " /><input type='submit' value='delete' /></form>";
            }
            $body .= "<a class='go' href='section/index/".$value['id']."'>Go to section</a>";
            $body .= "</article>";
        }
        if(isset($_SESSION['user_login'])) {
            $body .= "<a class='go' href=\"/library/add\" >Add library</a>";
        }

        self::$IndexTPL->SetParam('Header', $header);
        self::$IndexTPL->SetParam('Body', $body);
        self::$IndexTPL->SetParam('Footer', "Made by Paul!");
    }


    public static function Done()
    {
        self::$IndexTPL->Display();
    }
}