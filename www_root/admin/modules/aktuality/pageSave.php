<?php

// původní hodnoty v $_FORM["mail"] atd...

$rew = rewrite::getRewrite($title, "tbAktuality", $id);

$datum = dateformat($datum, "Y-m-d H:i:s");

$query = " SET  title = '$title',
		perex = '$perex',
		text  ='$text',
		autor = '$autor',
		photo = '$photo',
		datum = '$datum'
	 ";
	
if ($id == "-"){
    $query = "INSERT INTO tbAktuality $query";
}else{
    $query = "UPDATE tbAktuality $query WHERE id = $id";
}

//echo $query;

$temp = new sql($query);
$tempID = $temp->inserted();

$rew = rewrite::getRewrite($title."-".dateformat($datum, "Y-m-d"));
$query = "UPDATE tbAktuality set rew = '$rew' WHERE id = $tempID";
new sql($query);


//echo $query;
mess::create("green", "Data o článku byla uložena");
$return = true;

continueTo("index");







