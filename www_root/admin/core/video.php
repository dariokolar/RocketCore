<?php

require_once 'load.php';


$val = valid($_POST["val"]);




$data = YTapi::getData($val);


if ($data == "err"){
    ob_clean();echo "ERR";die;
}

$id = $data["id"];


if (empty($id)){
    ob_clean();echo "ERR";die;
}

echo $data["thumb"]["big"];
