<?php

// původní hodnoty v $_FORM["mail"] atd...

$rew = rewrite::getRewrite($title, "tbAkce", $id);

$datum = dateformat($datum, "Y-m-d H:i:s");

$query = " SET  title = '$title',
		perex = '$perex',
		text  ='$text',
		autor = '$autor',
		misto = '$misto',
		photo = '$photo',
		datum = '$datum',
		datumDo = '$datumDo',
		isDo = '$isDo'
	 ";
	
if ($id == "-"){
    $query = "INSERT INTO tbAkce $query";

    $temp = new sql($query);
    $tempID = $temp->inserted();
}else{
    $query = "UPDATE tbAkce $query WHERE id = $id";
    $temp = new sql($query);
    $tempID = $id;
}

//echo $query;


$rew = rewrite::getRewrite($title."-".dateformat($datum, "Y-m-d"));
$query = "UPDATE tbAkce set rew = '$rew' WHERE id = $tempID";
new sql($query);


//echo $query;
mess::create("green", "Data o akci byla uložena");
$return = true;

continueTo("index");







