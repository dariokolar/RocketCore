<?php    


if ($accept){     // nejdříve dotaz

$data = lang::dejData($target);
    
$page = new page($data["name"]);

$page->circle($data["photo"], "img/flag.png");
$page->title();
$page->text("Opravdu chcete smazat tento jazyk?");
$page->text("Smazání celé jazykové mutace může ovlivnit zobrazení Vašeho webu.");


$no = new button('<i class="fa fa-times"></i> Ne', '', $target, "storno", "red");
$yes = new button('<i class="fa fa-check"></i></i> Ano', 'langDel', $target, "page");


echo $no->getString();
echo $yes->getString();



}else{
    
    
      $query = "UPDATE tbLangs SET
                   isDel = 1
                   WHERE id = $target";


mysqli_query($link, $query);


   
mess::create("green", "Jazyková mutace byla smazána");
$return = true;

continueTo("index");
} 
