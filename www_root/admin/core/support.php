<?php

// return current (user's) IP
function dejIP(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function ifUserLogged(){

    if (isset($_SESSION["loged"]) and ($_SESSION["loged"] == true) ){

        return true;
    }else{
        return false;
    }
}


function checkUserLogIn(){

    if (isset($_SESSION["loged"]) and ($_SESSION["loged"] == true) ){

    }else{
        header("Location: /");
        die;
    }
}

function checkUserAdmin(){

    if (isset($_SESSION["loged"]) and ($_SESSION["isAdmin"] == 1) ){

    }else{
        header("Location: /admin/");
        die;
    }
}


function dateformat($date, $format = "j.n.Y"){
    return date($format, strtotime($date));
}

function mesicCesky($mesic, $up = false) {
    if ($up == true){
        $nazvy = array(1 => 'Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen', 'Červenec', 'Srpen', 'Září', 'Říjen', 'Listopad', 'Prosinec');
    }else{
        $nazvy = array(1 => 'leden', 'únor', 'březen', 'duben', 'květen', 'červen', 'červenec', 'srpen', 'září', 'říjen', 'listopad', 'prosinec');
    }
    return $nazvy[$mesic];
}

function mesicRew($mesic) {
    static $nazvy = array(1 => 'leden', 'unor', 'brezen', 'duben', 'kveten', 'cerven', 'cervenec', 'srpen', 'zari', 'rijen', 'listopad', 'prosinec');
    return $nazvy[$mesic];
}

function denCesky($mesic) {
    $nazvy = array(0 => 'Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota');

    return $nazvy[$mesic];
}


function mesicRew2num($mesic) {
    $nazvy["leden"] = 1;
    $nazvy["unor"] = 2;
    $nazvy["brezen"] = 3;
    $nazvy["duben"] = 4;
    $nazvy["kveten"] = 5;
    $nazvy["cerven"] = 6;
    $nazvy["cervenec"] = 7;
    $nazvy["srpen"] = 8;
    $nazvy["zari"] = 9;
    $nazvy["rijen"] = 10;
    $nazvy["listopad"] = 11;
    $nazvy["prosinec"] = 12;
    return $nazvy[$mesic];
}

//array vard dump with pre's
function echo_array($arr){
    echo "<pre>";
    var_dump($arr);
    echo "</pre>";
}

function valid($in){
    if(!is_string($in)){return ""; }
    global $link;
    return trim(htmlspecialchars(mysqli_real_escape_string($link, $in)));
}


function selfDomain(){
    return $_SERVER['SERVER_NAME'];
}

function selfURL($vcetneProtokolu = "ano"){
    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
    $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
    $protocol = $protocol."://";
    if ($vcetneProtokolu == "ne"){
        $protocol = "";
    }
    return $protocol.$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
}

function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }

function photo($src, $variant = "", $default = "/admin/img/photo.png"){

    if ($variant != ""){
        $variant = $variant."-";
    }
    if ($src == ""){
        $src =$default;
    }else{
        if (strtolower(substr($src, -3, 3)) == "jpg" && strtolower(substr($src, 0, 7)) == "/files/" ){
            $src = str_replace("/files/", "/files/$variant", $src);
        }
    }
    return $src;
}

function fileextension($src){
    $extension = "";
    $temp = explode(".", $src);
    $extension = strtolower(end($temp));
    return $extension;
}
function iconFile($src, $size = "medium", $def =  "img/no.png"){

    if(empty($src)){
        return $def;
        die;
    }

    $extension = "";
    $temp = explode(".", $src);
    $extension = strtolower(end($temp));

    $fotoExts = array("gif", "jpeg", "jpg", "png");
    if (in_array($extension, $fotoExts)){
        $link =  photo($src, $size, $def);
    }else{
        $link =  "img/no.png";
    }
    //    povoleno: "gif", "jpeg", "jpg", "png", "pdf", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "zip", "rar", "exe"
    if (strtolower($extension) == "pdf") {$link =  "img/pdf.png";		}
    if (strtolower($extension) == "doc") {$link =  "img/word.png";		}
    if (strtolower($extension) == "docx") {$link =  "img/word.png";		}
    if (strtolower($extension) == "xls") {$link =  "img/excel.png";		}
    if (strtolower($extension) == "xlsx") {$link =  "img/excel.png";		}
    if (strtolower($extension) == "ppt") {$link =  "img/powerpoint.png";		}
    if (strtolower($extension) == "pptx") {$link =  "img/powerpoint.png";		}
    if (strtolower($extension) == "zip") {$link =  "img/zip.png";		}
    if (strtolower($extension) == "rar") {$link =  "img/zip.png";		}
    if (strtolower($extension) == "exe") {$link =  "img/admin.png";		}

    return $link;
}

function photoData($id){
    $id = intval($id);
    $query = "SELECT * FROM tbFiles WHERE id = $id";

    $data = new sql($query);
    //$out = "";
    $data = $data->first();

        $array = json_decode($data["exif"], true);

    $out["aperture"] = $array["COMPUTED"]["ApertureFNumber"];
    $out["exposure"] = $array["ExposureTime"];
    $out["device"] = $array["Model"];
    $out["focal"] = $array["FocalLength"];
    $out["iso"] = $array["ISOSpeedRatings"];
    $out["exposure"] = $array["ExposureTime"];
    $out["date"] = $array["DateTimeOriginal"];

    return $out;
}


function ts($in){
    if ($_SESSION["lang"] == 1){
        return $in;
    }
    $translate = new Translator($_SESSION["lang"]);
    return $translate->__($in);
}


function fly($to, $subject, $text, $mail = ""){
    global $rocket;
    if(empty($mail)){
        $mail = $rocket["mail"];
    }


    ob_start();
    require dirname(__FILE__) . '/mail.php';
    $mess = ob_get_clean();



    $head  = 'From: '.$mail."\n";
    $head .= "MIME-Version: 1.0\n";
    $head .= "X-Mailer: PHP\n";
    $head .= "X-Priority: 3\n"; // priorita (1 nejvyšší, 2 velká, 3 normální ,4 nejmenší)
    $head .= 'Return-Path: <'.$mail.'>'."\n";
    $head .= "Content-Type: text/html; charset=UTF-8\r\n";


    $mail = @mail($to, $subject, $mess, $head);

    return "ok";
}




function continueTo($page){
    //back page after save
    global $module;
    global $target;
    global $source;
    global $user;
    echo mess::show();
    echo "<script> buildAdminUrl('$module', '$page', '$target', '$source'); </script>";
    require_once dirname(__FILE__).'/../modules/'.$module.'/'.$page.'.php';

}

function dejAnoNe($val){
    if ($val == 1){
        return "Ano";
    }else{
        return "Ne";
    }
}


function strong($val){
    return "<strong>$val</strong>";
}


function clickableLink($link){
    $url = $link;
    $prefixes = array('/', 'http://', 'https://');
    $gotPrefix = false;
    foreach($prefixes as $prefix) {
        if(substr($url, 0, strlen($prefix)) == $prefix) {
            $gotPrefix = true;
            break;
        }
    }
    if(!$gotPrefix)
        $url = 'http://' . $url;

    return $url;
}


function saveLabel($table, $arr, $material){
    if(!is_array($arr)){
        $arr = explode(",",$arr);
    }
    $query = "DELETE FROM $table WHERE material = $material";
    new sql($query);
    foreach ($arr as $val) {
        $query = "INSERT INTO $table SET material = '$material', label = '$val' ";
        new sql($query);
    }
}

function getSelectedLabels($table, $id){
    if(empty($id)){
        return false;
    }
    $query = "SELECT * FROM $table where material = $id";
    $tmp = new sql($query);
    $out = array();
    foreach ($tmp->all() as $label){
        $out[] = $label["label"];
    }
    return implode(",", $out);
}

function plotLabels($labels, $selected){
    $values = explode(",", $selected);
    $out = "";

    foreach($labels as $key => $val){
        if (in_array($key, $values)){
            $out .= '<div class="tag a labelTag" data="'.$key.'">'.$val.'</div>';
        }
    }
    return $out;
}


function plotTextLabels($labels, $selected){
    $values = explode(",", $selected);
    $out = array();

    foreach($labels as $key => $val){
        if (in_array($key, $values)){
            $out[] = $val;
        }
    }
    return implode(", ",$out);
}



function shortText($text, $lenght){
    $text = strip_tags($text);
    
    if(strlen($text) < $lenght){
        return $text;
    }
    return substr($text, 0, $lenght)."&hellip;";

}
