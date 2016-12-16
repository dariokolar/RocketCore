<?php    


if ($accept){     // nejdříve dotaz

$data = user::dejData($target);
    
$page = new page($data["name"]);

$page->circle($data["photo"], "img/user.png");
$page->title();
$page->text("Opravdu chcete smazat tohoto uživatele?");


$no = new button('<i class="fa fa-times"></i> Ne', '', $target, "storno", "red");
$yes = new button('<i class="fa fa-check"></i></i> Ano', 'userDel', $target, "page");


echo $no->getString();
echo $yes->getString();



}else{
    
    
      $query = "UPDATE tbUsers SET
                   isDel = 1
                   WHERE id = $target";


mysqli_query($link, $query);

   
mess::create("green", "Uživatel byl smazán");
$return = true;

continueTo("index");
} 
