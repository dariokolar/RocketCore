<?php

$page = new page("Stránky");

$create = new button('<i class="fa fa-plus"></i> Přidat stránku', 'pageEdit', "-", "page", "green");
echo $create->getString();
	
$page->title();


$list = new listLoad("pageList");

$list->addLabel("Vše", "all", true);
$list->addLabel("Aktivní", "active");
$list->addLabel("Neaktivní", "non");
$list->addsSearchLabel("Hledání...");

$list->loadThere();


?>
