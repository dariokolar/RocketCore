<?php

    if ($_POST["type"] == "this"){$query = " and isDel = 0 and date_format(datum, '%Y-%m')=date_format(now(), '%Y-%m') order by datum desc"; }
    if ($_POST["type"] == "future"){$query = " and isDel = 0 and datum > NOW() order by datum desc"; }
    if ($_POST["type"] == "history"){$query = " and isDel = 0 and datum < NOW() order by datum desc"; }


    if ($_POST["type"] == "search"){
	$query = "and isDel = 0 and title LIKE  '%$search%'"; }
    $out = akce::dejList($pageNum, $query);
    
   
    if ($out == "" ){
ob_clean();
echo "[[END]]";die;
    }else{
	echo $out;
    }
	    die;



