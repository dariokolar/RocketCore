<?php

// původní hodnoty v $_FORM["mail"] atd...


$date = date("Y-m-d 23:59:59", strtotime($date));

$rew = rewrite::getRewrite($name, "tbGallery", $id);

$query = " SET  name = '$name',
		isActive = '$isActive',
		photo = '$photo',
		date = '$date',
		rew = '$rew'
	 ";
	
if ($id == "-"){
    $query = "INSERT INTO tbGallery $query";
    $tmp = new sql($query);
    $target = $tmp->inserted();
}else{
    $query = "UPDATE tbGallery $query WHERE id = $id";
    new sql($query);
    $target = $id;
}



mess::create("green", "Fotogalerie byla uložena");
$return = true;

continueTo("galNahled");