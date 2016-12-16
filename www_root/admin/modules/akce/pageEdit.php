<?php 

$page = new page("Editace akce");
	
$back = new button('<i class="fa fa-arrow-left"></i> Zpět', 'index', $id);
$back->returnBack();
echo $back->getString();

$page->title();

$data["isDo"] = 0;
$data["autor"] = $user["name"];
if ($target!="-"){
     $data = akce::dejData($target);
}


$form = new form();


$name = new input("title", $data, "Název");
$name->text(4);
$form->add($name);

$name = new input("photo", $data, "Fotografie");
$name->image();
$form->add($name);


$name = new input("datum", $data, "Datum konání");
$name->date();
$name->help("V tento datum se zobrazí v kalendáři");
$form->add($name);


$input = new input("isDo", $data, "Více denní akce");
$input->option("Ano", "Ne");
$form->add($input);

$tmp = "style='opacity: 1'";
if($data["isDo"] == 0){
    $tmp = "style='opacity: 0.3'";
}
$form->add("<div class='clear'></div><div class='datumDoOption a' $tmp>");

$name = new input("datumDo", $data, "Datum do");
$name->date();
$form->add($name);

$form->add("</div>");


$name = new input("misto", $data, "Místo konání akce");
$name->text();
$form->add($name);


$name = new input("perex", $data, "Perex");
$name->editor();
$form->add($name);

$name = new input("text", $data, "Text");
$name->editor();
$form->add($name);


$name = new input("autor", $data, "Autor");
$name->text();
$form->add($name);



$form->plot();

 $save = new button('Uložit', 'pageSave', $id);
 $save->enterSubmit();
 echo $save->getString();

?>
<script>
    $(".datumDoOption").unbind();
    $("#isDo").change(function () {
        if($("#isDo").val() === "1"){
            $(".datumDoOption").css("opacity", "1");
        }else{
            $(".datumDoOption").css("opacity", "0.3");
        }
    });

</script>
