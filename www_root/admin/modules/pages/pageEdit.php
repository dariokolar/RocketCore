<?php 

$page = new page("Editace stránky");
	
$back = new button('<i class="fa fa-arrow-left"></i> Zpět', 'index', $id);
$back->returnBack();
echo $back->getString();

$page->title();

$data["isActive"] = 1;
$data["onHome"] = 0;
if ($target!="-"){
     $data = pages::dejData($target);
}


$form = new form();


$name = new input("name", $data, "Název");
$name->text(4);
$form->add($name);



$name = new input("photo", $data, "Fotografie");
$name->image();
$form->add($name);


$name = new input("text", $data, "Text");
$name->editor();
$form->add($name);



$isActive = new input("isActive", $data, "Aktivní");
$isActive->option("Ano", "Ne");
$form->add($isActive);

$form->plot();

 $save = new button('Uložit', 'pageSave', $id);
 $save->enterSubmit();
 echo $save->getString();

