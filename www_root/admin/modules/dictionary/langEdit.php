<?php 

$page = new page("Editace jazykové mutace");
	
$back = new button('<i class="fa fa-arrow-left"></i> Zpět', 'index', $id);
$back->returnBack();
echo $back->getString();

$page->title();

$data["isActive"] = 1;
if ($target!="-"){
     $data = lang::dejData($target);
}
?>

<form>
<?php 

 echo form::hidden("id", $target); 
 echo form::text("name", "Název", $data["name"], "", "", 4); 
    
 echo form::text("short", "Zkratka", $data["short"], "", "Zadejte zktratku jazkové mutace, například 'CZ', 'ENG', atd.", 2); 
                   
 echo form::image("icon", "Ikona", $data["icon"]); 
    if ($id != 1){
 echo form::option("isActive", "Aktivní", $data["isActive"], "Ano", "Ne", "");
    }else{
	
 echo form::hidden("isActive", 1);
    }

 $page->subtitle("Slovník");
 
 if ($id != "-") {
     try{
$filename = dirname(__FILE__)."/$id.txt";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);
     }catch (Exception $e) {
	 $contents = "";
     }
} 

echo form::bigTextarea("file", "Překlady", $contents, "", "Zapisujte formát ve tvaru: Originál=Překlad, jednotlivé fráze oddělujte novým řádkem"); 
     

$save = new button('Uložit', 'langSave', $id);
$save->enterSubmit();
echo $save->getString();

?>
</form> 

