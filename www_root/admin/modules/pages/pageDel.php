<?php    


if ($accept){     // nejdříve dotaz

$data = pages::dejData($target);
    
$page = new page($data["name"]);

$page->circle($data["photo"], "img/page.png");
$page->title();
$page->text("Opravdu chcete smazat tuto stránku?");


$no = new button('<i class="fa fa-times"></i> Ne', '', $target, "storno", "red");
$yes = new button('<i class="fa fa-check"></i></i> Ano', 'pageDel', $target, "page");


echo $no->getString();
echo $yes->getString();



}else{
    
    
      $query = "UPDATE tbPages SET
                   isDel = 1
                   WHERE id = $target";


new sql($query);

   
mess::create("green", "Stránka byla smazána");
$return = true;

continueTo("index");
} 
