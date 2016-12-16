<?php

$page = new page("Uživatelé");

$create = new button('<i class="fa fa-plus"></i> Vytvořit uživatele', 'userEdit', "-", "page", "green");
echo $create->getString();
	
$page->title();



$list = new listLoad("userList");

$list->addLabel("Vše", "all");
$list->addLabel("Administrátoři", "admin");
$list->addsSearchLabel("Hledejte podle jména");

$list->loadThere();


?>
