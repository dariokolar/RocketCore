<?php 

$page = new page("Můj účet");
	
?>
<?php
$page->title();


$data = user::dejData($_SESSION["id"]);


$form = new form();


$idcko = new input("id", $data);
$idcko->hidden();
$form->add($idcko);

$mail = new input("mail", $data, "E-mail");
$mail->mail();
$form->add($mail);


$name = new input("name", $data, "Jméno");
$name->text(4);
$form->add($name);


$name = new input("photo", $data, "Fotografie");
$name->image();
$form->add($name);


	
	$form->add('
	    <div class="formline">
                        <div class="label">
                            Změna hesla
                        </div>
                        <div class="input">
                            <div class="btn a" onclick="btnPress($(this));" style="    margin: 0 0 30px 0;    float: none;    display: inline-block;" page="changePass" do="note" source="" target="'.$id.'"><i class="fa fa-lock"></i> Změnit heslo</div>
                        </div>   
                        <div class="clear"></div>
               </div>');

  //   echo form::text("name", "Jméno", $data["name"], "", "", 4);
//echo form::image("photo", "Fotografie", $data["photo"]);

    
    $form->plot();


$save = new button('Uložit', 'userSave', $_SESSION["id"]);
$save->enterSubmit();
echo $save->getString();


?>
</form> 
