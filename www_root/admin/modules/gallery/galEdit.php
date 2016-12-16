<?php 

$page = new page("Editace fotogalerie");


$back = new button('<i class="fa fa-times"></i>', 'index', $id, "storno");
echo $back->getString();
?><br><?


$page->title();

$data["isActive"] = 1;
if ($target!="-"){
     $data = gallery::dejData($target);
}

$form = new form();


$name = new input("name", $data, "Název");
$name->text(4);
$form->add($name);



$name = new input("date", $data, "Datum");
$name->date();
$form->add($name);


$isActive = new input("isActive", $data, "Aktivní");
$isActive->option("Ano", "Ne");
$form->add($isActive);

$form->plot();

 $save = new button('Uložit', 'galSave', $id);
 $save->enterSubmit();
 echo $save->getString();

