<?php

// původní hodnoty v $_FORM["mail"] atd...

$mail = trim(strtolower($mail));

    $query = "UPDATE tbUsers SET mail = '$mail', 
                                      name='$name',
                                      photo='$photo',  
                                      isDel=0
                   WHERE id = $id";





new sql($query);


new alert("green", "Uživatelská data byla uložena");

continueTo("index");