<?php

if ($target!="-"){
    $data = gallery::dejData($target);
}
    $page = new page("Náhled fotogalerie");




$page->breakPage();


$page->topPhoto($data["nahled"]["link"], "big");



$page->breakPage();


$back = new button('<i class="fa fa-arrow-left"></i> Zpět', 'index', $target);




$back->returnBack();
echo $back->getString();



$btn = new button("Upravit informace o fotogalerii", "galEdit", $target, "note");
echo $btn->getString();
$page->title($data["name"]);



$page->breakPage();




$multifiles = new multiFiles("Fotografie", "galOne", $target);


$photoOrder = new sortableSpace("files", "galOrder", $multifiles);
$tmp = gallery::dejPhotoList($target);

if(!empty($tmp)){
    echo $tmp;
}else{
    ?>
        <div class="nothing" onclick="$('.fileClick').trigger('click');">
            <center>
                <span style="display: inline-block;background: #F4F4F4;width: 85px;width: 64px;padding: 23px 0;border-radius: 50%; color:grey;">
                    <i class="fa fa-plus"></i>
                </span>
            </center>
            <center>
                <strong style="color:grey;"><br>Nahrajte fotografie<br><br></strong>
            </center>
        </div>
<?
}
$photoOrder->plotThere();



$page->breakPage();

