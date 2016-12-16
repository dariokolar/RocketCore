<?php
//error_reporting(0);

require_once dirname(__FILE__).'/load.php';
/*
 *	TinyRocket 3.0
 *	Uploader Assistent
 * 
 *	Avaible settings in config file
 */

    $tempfile = new fileupload();

if(!$tempfile->error){
    echo stripslashes(json_encode($tempfile->getResponse()));
}else{
    echo "upload error";
}



?>

