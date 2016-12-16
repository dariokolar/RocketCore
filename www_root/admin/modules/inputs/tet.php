<?php

$page = new page("Dostupné formulářové prvky");


$back = new button('<i class="fa fa-times"></i>', 'index', $id, "storno");
echo $back->getString();
?><br><?

$page->title();


$form = new form();

$form->add($page->subtitle("Základní textová pole", true));

$input = new input("name", $data, "Textové pole");
$input->text(4);
$input->help("Můžeme přidat kontrolu na počet znaků, případně změnit atribut type");
$form->add($input);

$input = new input("mail", $data, "Pole pro E-mail");
$input->mail();
$input->help("Kontroluje zda je zadána platná mailová adresa");
$form->add($input);


$input = new input("passOld", "", "Stávající heslo");
$input->text(false, "password");
$input->help("V zásadě textové pole s změněným atributem type, nic nekontrolujeme");
$form->add($input);


$input = new input("pass", $data, "Heslo");
$input->pass(6, true);
//$input->help("Dvě pole pro zadání hesla, kontroluje se počet znaků a schoda");
$form->add($input);



$form->add($page->subtitle("Pokročilé prvky", true));

$input = new input("photo", $data, "Pole pro upload souboru/obrázku");
$input->image();
$form->add($input);


$input = new input("text", $data, "WYSIWYG editor");
$input->editor();
$input->help("Automaticky zpracovávaný editor, neměl by likvidovat třídy, vlastní elementy a pod.");
$form->add($input);


$form->add($page->subtitle("Přepínače", true));

$input = new input("isActive", 1, "Přepínač");
$input->option("Ano", "Ne");
$form->add($input);

$data["obsahuje"] = 1;
$data["obsahujeval"] = "Ano, přepínač obsahuje doplňující hodnotu";
$input = new input("obsahuje", $data, "Přepínač s hodnotou");
$input->optionVal("Ano", "Ne", "obsahujeval", $data);
$form->add($input);



$form->add($page->subtitle("Datumy", true));

$input = new input("datum", dateformat("now"), "Výběr data");
$input->date();
$input->help("Výběr datumu z datepickeru, zatím bez možnosti nastavit omezení");
$form->add($input);




$form->add($page->subtitle("Výběry", true));


$arr = array("polozka" => "První položka v selectu", 584 => "Druhá položka - 584", "-" => "Něco dalšího");
$input = new input("select", $data, "Výběr ze selectu");
$input->select($arr);
$input->help("Výběr z pole, automatické zvolení položky z \$data nebo první");
$form->add($input);



$arr = array("První položka", "Druhá položka", "Něco dalšího");
$input = new input("drag", $data, "Položky k seřazení");
$input->draginput($arr);
$input->placeholder("Zadejte hodnotu");
$input->help("Změna a řazení položek, vrací text oddělený středníkem (;)");
$form->add($input);




$arr = labels::returnArray();
$data["labels"] = "1;3"; //simulace předvybraných štítků
$input = new input("labels", $data, "Výběr štítků");
$input->labels($arr);
$input->help("Napojeno na modul štítků, vrací idčka oddělená střeníky");
$form->add($input);



$form->plot();


$save = new button('Uložit', 'index', $_SESSION["id"]);
$save->enterSubmit();
echo $save->getString();



?>
