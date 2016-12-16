<?php

// původní hodnoty v $_FORM["mail"] atd...

$query = " DELETE FROM tbPagesLang WHERE  source = '$pageID' AND
		lang = '$target'
	 ";
	new sql($query);
	

$query = "INSERT INTO tbPagesLang
	    SET  name = '$name',
		lang = '$target',
		source = '$pageID',
		text = '{$_POST["CKEDITOR"]}'";

new sql($query);



mess::create("green", "Jazyková verze stránky byla uložena");
$return = true;

continueTo("index");