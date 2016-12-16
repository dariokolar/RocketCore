<?php

$page = new page("Aktuality");

$create = new button('<i class="fa fa-plus"></i> Přidat článek', 'pageEdit', "-", "page", "green");
echo $create->getString();
	
$page->title();


$list = new listLoad("pageList");

$list->addLabel("Vše od nejnovějších", "all", true);
$list->addLabel("Vše od nejčtenějších", "all2");
$list->addsSearchLabel("Hledání...");

$list->loadThere();


?>
