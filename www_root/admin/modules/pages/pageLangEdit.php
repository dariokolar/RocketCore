<?php 

$page = new page("Editace stránky - ".lang::title($target));
	
$back = new button('<i class="fa fa-arrow-left"></i> Zpět', 'index', $id);
$back->returnBack();
echo $back->getString();

$page->title();


$dataOld = pages::dejData($source);
$data = pages::dejLangData($source, $target);

?>


<form>
<?php 

 echo form::hidden("lang", $target); 
 echo form::hidden("pageID", $source); 
 echo form::text("name", "Název", $data["name"], "", "Původně: ". $dataOld["name"], 2); 
 echo form::ckeditor("text", "Text pro podstránku procedury", $data["text"], "", "<br>Původně: ".strip_tags($dataOld["text"]) );

 $save = new button('Uložit', 'pageSaveLang', $id);
 $save->enterSubmit();
 echo $save->getString();

?>
</form> 

