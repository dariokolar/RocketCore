<?php
session_start();


require_once dirname(__FILE__) . '/../../core/load.php';




$_SESSION["loged"] = false;
session_destroy();
session_start();
session_regenerate_id(true); 

session_start();

new alert("green", "Odhlášení bylo úspěšné");
header("Location: ../../");


