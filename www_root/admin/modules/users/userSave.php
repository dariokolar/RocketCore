<?php

$pass = user::hashPass($pass);

// původní hodnoty v $_FORM["mail"] atd...

$mail = trim(strtolower($mail));
	
if ($id == "-"){
    $query = "INSERT INTO tbUsers SET mail = '$mail', 
                                      pass='$pass', 
                                      name='$name',
                                      photo='$photo',
                                      last=NOW(),
                                      created=NOW(),
                                      ip='".dejIP()."',
                                      isAdmin='$isAdmin', 
                                      isActive='$isActive', 
                                      isDel=0";
}else{
    $query = "UPDATE tbUsers SET mail = '$mail', 
                                      name='$name',
                                      photo='$photo',
                                      isAdmin='$isAdmin', 
                                      isActive='$isActive',  
                                      isDel=0
                   WHERE id = $id";
}




new sql($query);

new alert("green", "Uživatelská data byla uložena");

continueTo("index");