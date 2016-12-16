<?php

$page = new page("Štítky");

$create = new button('<i class="fa fa-plus"></i> Přidat štítek', 'labelEdit', "-", "page", "green");
echo $create->getString();
	
$page->title();


$list = new listLoad("labelList");

$list->addLabel("Vše", "all", true);
$list->addLabel("Aktivní", "active");
$list->addLabel("Neaktivní", "non");
$list->addsSearchLabel("Hledání...");

$list->loadThere();


?>
