<?php
session_start();

require_once dirname(__FILE__) . '/config.php';
require_once dirname(__FILE__) . '/support.php';
require_once dirname(__FILE__) . '/table.php';
require_once dirname(__FILE__) . '/sql.php';

if(isset($runInstall)){
    require_once dirname(__FILE__) . '/../install.php';
    die;
}

$link = mysqli_connect($rocket["dbServer"],$rocket["dbUser"],$rocket["dbPass"]) or die ('Nelze se pripojit k databazi, zkontrolujte soubor config.php');
mysqli_select_db($link, $rocket["dbName"]) or die ('Nelze vybrat databazi, kontaktujte vašeho správce webu');
mysqli_query($link, "SET NAMES utf8");

require_once dirname(__FILE__) . '/files.php';
require_once dirname(__FILE__) . '/fileupload.php';
require_once dirname(__FILE__) . '/form.php';
require_once dirname(__FILE__) . '/interface.php';
require_once dirname(__FILE__) . '/support.php';
require_once dirname(__FILE__) . '/rewrite.php';
require_once dirname(__FILE__) . '/youtubeAPI.php';
require_once dirname(__FILE__) . '/alert.php';

$menu = new menu();

if ($mainLoad){
	    $out = "<?php ";
	     $dir = dirname(__FILE__).'/../modules';
    $cdir = scandir($dir);
    foreach ($cdir as $key => $value){


	if (!in_array($value,array(".",".."))){

		if (file_exists($dir . DIRECTORY_SEPARATOR . $value. DIRECTORY_SEPARATOR . "_config.php")) {
		    require_once $dir . DIRECTORY_SEPARATOR . $value. DIRECTORY_SEPARATOR . "_config.php";
		    
		  $out .= "  require_once \"".$dir . DIRECTORY_SEPARATOR . $value. DIRECTORY_SEPARATOR . "_config.php\";
			  ";
		
	}
    }
 
}
	   file_put_contents( dirname(__FILE__) ."/_temp.php" , $out." ?>");
	}else{
	     require_once "_temp.php";
	}
   

