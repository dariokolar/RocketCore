<?php 

$page = new page("Editace článku");
	
$back = new button('<i class="fa fa-arrow-left"></i> Zpět', 'index', $id);
$back->returnBack();
echo $back->getString();

$page->title();


$data["autor"] = $user["name"];
if ($target!="-"){
     $data = aktuality::dejData($target);
}


$form = new form();


$name = new input("title", $data, "Název");
$name->text(4);
$form->add($name);

$name = new input("photo", $data, "Fotografie");
$name->image();
$form->add($name);


$name = new input("datum", $data, "Datum");
$name->date();
$form->add($name);


$name = new input("perex", $data, "Perex");
$name->editor();
$form->add($name);

$name = new input("text", $data, "Text");
$name->editor();
$form->add($name);


$name = new input("autor", $data, "Autor");
$name->text();
$form->add($name);



$form->plot();

 $save = new button('Uložit', 'pageSave', $id);
 $save->enterSubmit();
 echo $save->getString();

