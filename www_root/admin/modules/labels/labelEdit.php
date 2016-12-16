<?php 

$page = new page("Editace štítku");
	
$back = new button('<i class="fa fa-arrow-left"></i> Zpět', 'index', $id);
$back->returnBack();
echo $back->getString();

$page->title();

$data["isActive"] = 1;
if ($target!="-"){
     $data = labels::dejData($target);
}


$form = new form();


$name = new input("name", $data, "Název");
$name->text(4);
$form->add($name);



$name = new input("photo", $data, "Fotografie");
$name->image();
$form->add($name);



$isActive = new input("isActive", $data, "Aktivní");
$isActive->option("Ano", "Ne");
$form->add($isActive);

$form->plot();

 $save = new button('Uložit', 'labelSave', $id);
 $save->enterSubmit();
 echo $save->getString();

