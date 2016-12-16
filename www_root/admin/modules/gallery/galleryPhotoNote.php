<?php    


if ($accept){     // nejdříve dotaz

$data = gallery::photoData($target);
    
$close = new button('<i class="fa fa-times"></i>', '', $target, "storno");
echo $close->getString();

$page = new page($data["name"]);

$page->circle($data["link"], "img/photo.png");

 echo "<form>";
    echo form::textarea("note", "Upravte poznámku k fotografii:", $data["note"], ""); 
    echo "</form>";

$save = new button('<i class="fa fa-check"></i></i> Uložit', 'galleryPhotoNote', $target, "page");
$save->enterSubmit();
$save->addSource($source);
echo $save->getString();

   

}else{
   
    
      $query = "UPDATE tbPhotos SET
                   note = '$note'
                   WHERE photo = $target";


mysql_query($query);

   
mess::create("green", "Poznámka k fotografii byla uložena");
$return = true;


$target = $source;
continueTo("galleryNahled");
} 
