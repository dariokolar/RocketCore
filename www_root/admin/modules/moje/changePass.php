<?php
if ($accept){     // nejdříve dotaz

/*
<form>
<?php 
echo form::passOld("passOld", "Stávající heslo", "", "", "", 8);
echo form::pass("pass", "Nové heslo", 8); 
?>
</form>*/

    $page = new page("Změna hesla");
    $page->title();

  $form = new form();



    $passOld = new input("passOld", "", "Stávající heslo");
    $passOld->text(false, "password");
    $form->add($passOld);


    $pass = new input("pass", "", "Nové heslo");
    $pass->pass(6, true);
    $form->add($pass);


    $form->plot();

$no = new button('<i class="fa fa-times"></i> Storno', '', $target, "storno", "red");
$yes = new button('<i class="fa fa-check"></i></i> Uložit', 'changePass', $target, "page");


echo $no->getString();
echo $yes->getString();



}else{
    
    
 $user = user::dejData($_SESSION["id"]);
 if ($user["pass"] != md5("efvsgoj".$passOld)){
     mess::create("yellow", "Vaše původní heslo není správné, heslo nebylo změněno");
 }else{
  
$pass = md5("efvsgoj".$pass); 
   $query = "UPDATE tbUsers SET
                   pass = '".$pass."'
                   WHERE id = {$_SESSION["id"]} ";
                   
mysql_query($query);

   
mess::create("green", "Heslo bylo změněno");
 }
 

$target = $user["id"];
continueTo("userEdit");
} 