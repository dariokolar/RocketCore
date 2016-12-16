<?php    


if ($accept){     // nejdříve dotaz

$data = blog::dejData($target);
    
$page = new page($data["title"]);

$page->circle($data["photo"], "img/page.png");
$page->title();
$page->text("Opravdu chcete smazat tento článek?");


$no = new button('<i class="fa fa-times"></i> Ne', '', $target, "storno", "red");
$yes = new button('<i class="fa fa-check"></i></i> Ano', 'pageDel', $target, "page");


echo $no->getString();
echo $yes->getString();



}else{
    
    
      $query = "UPDATE tbAktuality SET
                   isDel = 1
                   WHERE id = $target";


new sql($query);

   
mess::create("green", "Článek byl smazán");
$return = true;

continueTo("index");
} 
