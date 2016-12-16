<?php 

$page = new page("Editace uživatele");
	
$back = new button('<i class="fa fa-arrow-left"></i> Zpět', 'index', $id);
$back->returnBack();
echo $back->getString();

$page->title();


$data["isActive"] = 1;
$data["isAdmin"] = 0;


if ($target!="-"){
     $data = user::dejData($target);
}


$form = new form();

$idcko = new input("id", $data);
$idcko->hidden();
$form->add($idcko);

$mail = new input("mail", $data, "E-mail");
$mail->mail();
$form->add($mail);


if ($id=="-"){
$pass = new input("pass", "", "Nové heslo");
$pass->pass(6, true);
$form->add($pass);
}


$name = new input("name", $data, "Jméno");
$name->text(4);
$form->add($name);


$name = new input("photo", $data, "Fotografie");
$name->image();
$form->add($name);



$isActive = new input("isActive", $data, "Aktivní");
$isActive->help("Nový uživatelé potvrzují svůj účet odkazem v e-mailové zprávě. Tato volba se poté změní automaticky.");
$isActive->option("Ano", "Ne");
$form->add($isActive);


$isAdmin = new input("isAdmin", $data, "Administrátor");
$isAdmin->help("Uživatel s adminnistrátorským právěm má přístup do této administrace. Může zde měnit veškerá nastavení.");
$isAdmin->option("Ano", "Ne");
$form->add($isAdmin);


$form->plot();


$save = new button('Uložit', 'userSave', $target);
$save->enterSubmit();
echo $save->getString();

?>
</form> 
