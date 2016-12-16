<?php    


if ($accept){     // nejdříve dotaz

$data = akce::dejData($target);
    
$page = new page($data["title"]);

$page->circle($data["photo"], "img/page.png");
$page->title();
$page->text("Opravdu chcete smazat tuto akci?");


$no = new button('<i class="fa fa-times"></i> Ne', '', $target, "storno", "red");
$yes = new button('<i class="fa fa-check"></i></i> Ano', 'pageDel', $target, "page");


echo $no->getString();
echo $yes->getString();



}else{
    
    
      $query = "UPDATE tbAkce SET
                   isDel = 1
                   WHERE id = $target";


new sql($query);

   
mess::create("green", "Akce byly smazána");
$return = true;

continueTo("index");
} 
