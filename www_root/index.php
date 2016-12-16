<?php
session_start();
if (isset($_GET["clear"])){
    session_destroy();
    session_start();
    session_regenerate_id(true); 
}

require_once dirname(__FILE__) . "/admin/core/load.php";


$_SESSION["lastUrl"] = $_SERVER['REQUEST_URI'];


$page = strip_tags($_GET["p"]);
$rew = strip_tags($_GET["rew"]);
$cat = strip_tags($_GET["cat"]);

if (!isset($_SESSION["loged"]) or ($_SESSION["loged"] != true)) {
}else{
$user = user::dejData($_SESSION["id"]);
}



if($page == "do"){
    $page = str_replace(".php", "", $rew);
    if (file_exists(dirname(__FILE__) . "/do/$rew.php")) {
    require_once dirname(__FILE__) . "/do/$rew.php";
    } else {
       require_once dirname(__FILE__) . "/404.php";
    }
    die;
}

if($page == "ajax"){
    $page = str_replace(".php", "", $rew);
    if (file_exists(dirname(__FILE__) . "/ajax/$rew.php")) {
        require_once dirname(__FILE__) . "/ajax/$rew.php";
    } else {
        require_once dirname(__FILE__) . "/404.php";
    }
    die;
}

if($page == "page"){
    $page = $rew;
    $rew = $cat;
}

if ($page == "") {
   require_once dirname(__FILE__) . "/homepage.php";
} else {
    if (file_exists(dirname(__FILE__) . "/$page.php")) {
	    require_once dirname(__FILE__) . "/$page.php";
    } else {
	unset($data);
        $temp = $page;
        $page = new pageout();
        $page->byrew($temp);
        $rew = $temp;
        if (!empty($page->id)){
            require_once dirname(__FILE__) . "/page.php";
        }else{
            require_once dirname(__FILE__) . "/404.php";
        }
    }
}

