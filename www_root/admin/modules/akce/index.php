<?php

$page = new page("Kalendář akcí");

$create = new button('<i class="fa fa-plus"></i> Přidat akci', 'pageEdit', "-", "page", "green");
echo $create->getString();
	
$page->title();


$list = new listLoad("pageList");

$list->addLabel("Tento měsíc", "this", true);
$list->addLabel("Nadcházející", "future");
$list->addLabel("Proběhlé", "history");
$list->addsSearchLabel("Hledání...");

$list->loadThere();


?>
