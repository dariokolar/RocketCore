<?php

// původní hodnoty v $_FORM["mail"] atd...



$rew = rewrite::getRewrite($name, "tbLabels", $id);

$query = " SET  name = '$name',
		isActive = '$isActive',
		photo = '$photo',
		rew = '$rew'
	 ";
	
if ($id == "-"){
    $query = "INSERT INTO tbLabels $query";
}else{
    $query = "UPDATE tbLabels $query WHERE id = $id";
}

mysqli_query($link, $query);


mess::create("green", "Štítek byl uložen");
$return = true;

continueTo("index");