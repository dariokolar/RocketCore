<?php
session_start();

require_once dirname(__FILE__) . '/../../core/load.php';


$code = user::login($_POST["mail"],$_POST["pass"]);
    if ($code == 1){
        new alert("green", "Vítejte zpět");

        header("Location: ../../");
    }elseif($code == 0){
        new alert("red", "Zadané uživatelské jméno nebo heslo neznáme");
        header("Location: ../../");
    }elseif($code == 2){
        new alert("yellow", "Váš učet není aktivní");

        header("Location: ../../");

    }

