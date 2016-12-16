<?php

$page = new page("Jazykové mutace");

$create = new button('<i class="fa fa-plus"></i> Přidat jazykovou mutaci', 'langEdit', "-", "page", "green");
echo $create->getString();
	
$page->title();





$list = new listLoad("langList");

$list->addLabel("Vše", "all", true);
$list->addLabel("Aktivní", "active");
$list->addLabel("Neaktivní", "non");
$list->addsSearchLabel("Hledání...");

$list->loadThere();


?>
