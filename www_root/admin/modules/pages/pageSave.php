<?php

// původní hodnoty v $_FORM["mail"] atd...



$rew = rewrite::getRewrite($name, "tbPages", $id);

$query = " SET  name = '$name',
		isActive = '$isActive',
		photo = '$photo',
		rew = '$rew',
		text = '$text'
	 ";
	
if ($id == "-"){
    $query = "INSERT INTO tbPages $query";
}else{
    $query = "UPDATE tbPages $query WHERE id = $id";
}

mysqli_query($link, $query);


mess::create("green", "Data o stránce byla uložena");
$return = true;

continueTo("index");