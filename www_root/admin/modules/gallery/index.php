<?php

$page = new page("Fotogalerie");

$create = new button('<i class="fa fa-plus"></i> vytvořit novou fotogalerii', 'galEdit', "-", "note", "green");
echo $create->getString();
	
$page->title();


$list = new listLoad("galList");

$list->addLabel("Vše", "all", true);
$list->addLabel("Aktivní", "active");
$list->addLabel("Neaktivní", "non");
$list->addsSearchLabel("Hledání...");

$list->loadThere();


?>
