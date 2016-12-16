<?php

/*
 * TynyRocket 3.0
 * Modul pro správu uživatelských účtů
 * 
 * (c) 2015
 */


class user
{



    public function __construct($id)
    {


    }

    static function overMail($mail)
    {
        new sql("UPDATE tbUsers SET isActive = 1 WHERE mail = '" . valid($mail) . "'  ");

    }

    static function hashPass($in){
        return md5(sha1(str_replace(substr($in, 0, intval(strlen($in)/2)), "", $in)).md5($in).sha1(substr($in, 0, intval(strlen($in)/2))));
    }
    static function dejData($id)
    {
        $id = intval($id);
        $query = new sql("SELECT * FROM tbUsers WHERE id = '$id'");
        return $query->first();
    }

    static function dejList($page, $filtr = "")
    {
        $page = intval($page);

        if ($page == 1) {
            $query = "SELECT * FROM tbUsers where isDel = 0 $filtr ";
            $_SESSION["query"] = $query;
        }
        $num = 8;
        $page = ($page - 1) * $num;

        $query = new sql($_SESSION["query"] . " LIMIT $page,$num");

        $out = "";
        foreach ($query->all() as $zaznam) {
            $line = new line($zaznam["name"]);
            $line->addIcon($zaznam["photo"], "img/user.png");
            $line->addNote($zaznam["mail"]);
            $line->addNote('Poslední přihlášení: ' . date("j.n.Y", (strtotime($zaznam["last"]))));
            $del = new button('<i class="fa fa-times"></i> Smazat', 'userDel', $zaznam["id"], "del", "red");
            $edit = new button('<i class="fa fa-pencil"></i> Upravit', 'userEdit', $zaznam["id"]);
            $line->addButton($del->getString());
            $line->addButton($edit->getString());

            $out .= $line->getString();
        }
        return $out;
    }

    static function login($mail, $pass, $isAdmin = 1)
    {
        $pass = self::hashPass($pass);
        $mail = valid($mail);

        $mail = trim(strtolower($mail));

        $query = new sql("SELECT *,count(id)as celkem FROM tbUsers WHERE mail = '$mail' AND pass='$pass' AND isActive = 0 AND isDel = 0 AND isAdmin = $isAdmin");
        foreach ($query->all() as $zaznam) {
            if ($zaznam["celkem"] == 1) {
                return 2;
            }
        }
        $query = new sql("SELECT *,count(id)as celkem FROM tbUsers WHERE mail = '$mail' AND pass='$pass' AND isActive = 1 AND isDel = 0  AND isAdmin = $isAdmin");
        foreach ($query->all() as $zaznam) {
            if ($zaznam["celkem"] == 1) {
                $_SESSION["loged"] = true;
                $_SESSION["isAdmin"] = $zaznam["isAdmin"];
                $_SESSION["id"] = $zaznam["id"];
                $_SESSION["client"] = $zaznam["client"];
                $_SESSION["mail"] = $zaznam["mail"];
                $_SESSION["name"] = $zaznam["name"];
                setcookie("TinyRocket_LastUser", $zaznam["id"], strtotime('+30 days'), '/');
                new sql("UPDATE tbUsers SET last = NOW() WHERE id ={$_SESSION["id"]} ");

                return 1;
            }
        }
        return 0;
    }

    static function dataProLogin($id)
    {
        $id = intval($id);
        $query = new sql("SELECT * FROM tbUsers WHERE id = '$id'");
        foreach ($query->all() as $zaznam) {
            $user["mail"] = $zaznam["mail"];
            $user["photo"] = $zaznam["photo"];
            $user["name"] = $zaznam["name"];
        }
        return $user;
    }


}
