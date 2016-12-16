<?php

    if ($_POST["type"] == "all"){$query = " and isDel = 0 order by datum desc"; }
    if ($_POST["type"] == "all2"){$query = " and isDel = 0 order by views desc"; }


    if ($_POST["type"] == "search"){
	$query = "and isDel = 0 and title LIKE  '%$search%'"; }
    $out = aktuality::dejList($pageNum, $query);
    
   
    if ($out == "" ){
ob_clean();
echo "[[END]]";die;
    }else{
	echo $out;
    }
	    die;



