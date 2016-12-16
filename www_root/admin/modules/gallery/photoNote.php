<?php    


if ($accept){     // nejdříve dotaz

$data = gallery::photoData($target);
    
$close = new button('<i class="fa fa-times"></i>', '', $target, "storno");
echo $close->getString();

$page = new page($data["name"]);

$page->circle($data["link"], "img/photo.png");





    $form = new form();


    $name = new input("note", $data, "Upravte poznámku k fotografii:");
    $name->textarea();
    $form->add($name);



    $form->plot();


$save = new button('<i class="fa fa-check"></i></i> Uložit', 'photoNote', $target, "page");
$save->enterSubmit();
$save->addSource($source);
echo $save->getString();

   

}else{
   
    
      $query = "UPDATE tbGalleryPhotos SET
                   note = '$note'
                   WHERE file = $target";


new sql($query);

   
mess::create("green", "Poznámka k fotografii byla uložena");
$return = true;


$target = $source;
continueTo("galNahled");
} 
