<?php

$i = 1;

$sort = str_replace("item[]=", "", $_POST["sort"]);

$sort = explode("&", $sort);

foreach ($sort as $value) {
    $query = " UPDATE tbGalleryPhotos SET  ownOrder =  '$i' WHERE file = $value ";
    
    new sql($query);
    
    $i++;
}

echo "ORDER SAVED";