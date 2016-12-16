<?php    


if ($accept){     // nejdříve dotaz

$data = gallery::photoData($target);
    
$page = new page($data["name"]);

$page->circle($data["link"], "img/photo.png");

$page->text("Opravdu chcete smazat tuto fotografii?");


$no = new button('<i class="fa fa-times"></i> Ne', '', $target, "storno", "red");
$yes = new button('<i class="fa fa-check"></i></i> Ano', 'photoDel', $target, "page");
$yes->addSource($source);


echo $no->getString();
echo $yes->getString();



}else{
    
    
      $query = "UPDATE tbGalleryPhotos SET
                   isDel = 1
                   WHERE file = $target";


new sql($query);

   
mess::create("green", "Fotografie byla smazána");
$return = true;

$target = $source;
continueTo("galNahled");
} 
