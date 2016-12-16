<?php
// menu
class menu {
    protected $menu;
    protected $menu2;
    
    public function __construct(){
	$i = 0;
	while($i <25){
	    $this->menu[$i] = "";
	    $i++;
	}
	$i = 0;
	while($i <25){
	    $this->menu2[$i] = "";
	    $i++;
	}
    }
    
    public function addTop($moduleFolder, $moduleName, $order = 25){
	while(!empty($this->menu["$order"])){
	    $order++;
	}
	$this->menu[$order]["folder"] = $moduleFolder;
	$this->menu[$order]["name"] = $moduleName;
    }
    public function addBottom($moduleFolder, $moduleName, $order = 25){
	while(!empty($this->menu2["$order"])){
	    $order++;
	}
	$this->menu2[$order]["folder"] = $moduleFolder;
	$this->menu2[$order]["name"] = $moduleName;
    }
    
    public function plot(){
	foreach($this->menu as $module){
	    if ($module != ""){
	    echo ' <div class="mainBtn a" module="'.$module["folder"].'" data="">'.$module["name"].'</div>';
	    }
	}
    }
    public function plotBottom(){
	foreach($this->menu2 as $module){
	    if ($module != ""){
	    echo ' <div class="mainBtn a" module="'.$module["folder"].'" data="">'.$module["name"].'</div>';
	    }
	}
    }
}




//page
class page{
    protected $pageName;
    protected $modul;
    
    public function __construct($name = ""){
	$this->pageName = $name;
    }
    
    public function title($name = NULL){
	if ($name != NULL){
	    $this->pageName = $name;
	}
	echo "<h1>{$this->pageName}</h1>";
    }
    public function breakPage($return = false){
        if($return) {
            return "<div class=clear></div>";
        }
        echo "<div class=clear></div>";
    }
    public function subtitle($text, $return = false){
        if($return){
            return "<div class=clear></div><h2>$text</h2><div class=clear></div>";
        }
        echo "<h2>$text</h2>";
    }
    public function text($text){
	echo "<p>$text</p>";
    }
    public function topPhoto($photo, $default="none"){
	if ($photo == "" && $default = "none"){
	    echo "";
	    return false;
	}
	$url = photo($photo, "big", $default);
	echo "<div class=topPhoto style='background-image: url(\"$url\")'></div>";
    }

    public function circle($url, $default){
	$url = photo($url, "medium", $default);
	echo "<div class=circle style='background-image: url(\"$url\")'></div>";
    }
    
    public function homeCircle($url, $default){
	$url = photo($url, "medium", $default);
	echo "<div class=homeCircle style='background-image: url(\"$url\")'></div>";
    }
}


// one line (for data list or photo list)
class line{
    protected $icon;
    protected $name;
    protected $id = 0;
    protected $notes = "";
    protected $infos = "";
    protected $buttons = "";
    protected $dragable = false;
    protected $bog = false;
    
    public function __construct($name, $id = 0){
	$this->name = $name;
	$this->id = $id;
    }
    public function addIcon($icon, $default, $size = "", $color = ""){
	if ($color != ""){
	    $color = " background-color: $color;";
	}
	$this->icon = ' <div class="icon" style="background-image: url('.photo($icon, "small", $default).'); '.$color.'">';
    }
    public function dragable(){
	$this->dragable = true;
    }
    public function big(){
	$this->big = true;
    }
    public function addButton($button){
	$this->buttons .= $button;
    }
    public function langButtons($page, $id = ""){
	if($id != ""){ $this->id = $id; }
	$this->buttons .= lang::buttons($this->id, $page);
    }
    public function addNote($string){
	$this->notes .= '<div class="notes">'.$string.'</div>';
    }
    public function addPerents($percents1, $percents2){
	$this->notes = "<div class=percentLine><div class=percentIn style='width: $percents1'></div>  <div class=info>$percents2</div></div>".$this->notes;
    }
    public function getString(){
	$big = "";
	if ($this->big){ $big = " photoBig "; }
	if ($this->dragable){ $this->icon .= '   <div class="drag a"></div> '; $big .= " dragableLine "; }
	if ($this->icon != ""){ $this->icon .= "</div>"; }
	return '<div class="dataLine '.$big.' a" id="item-'.$this->id.'">
                   '.$this->icon.'
                    <div class="data">
                        <div class="name">'.$this->name.'</div>
			'.$this->notes.'
                    </div>
                    <div class="btns">
                        '.$this->buttons.'
                    </div>
                    <div class="clear"></div>
                </div>';
    }
}

class button{
    protected $page;
    protected $source = "";
    protected $target;
    protected $do = "page";
    protected $color = "";
    protected $default = "";
    protected $ownClass = "";
    protected $title = "";
    
    public function __construct($text, $page, $target, $do = "page", $color = "", $ownClass = ""){
	$this->text = $text;
	$this->page = $page;
	$this->target = $target;
	$this->do = $do;
	$this->color = $color;
	$this->ownClass = $ownClass;
    }
    public function enterSubmit(){
	$this->default = " enterSubmit ";
    }
    public function returnBack(){
	$this->default = " returnBack ";
    }
    public function addSource($source){
	$this->source = $source;
    }
    public function addTitle($title){
        $this->title = $title;
    }
    public function getString(){
	return ' <div onclick="btnPress($(this));" class="btn a '.$this->color.'  '.$this->default.' '.$this->ownClass.'" page="'.$this->page.'" title="'.$this->title.'"  do="'.$this->do.'" source="'.$this->source.'" target="'.$this->target.'">'.$this->text.'</div>';
    }
}


class previewTable {
    protected $html;
    public function __construct (){
	$this->html = '<div class="detailTable">';
    }
    public function one($label, $value){
	$this->html .= ' <div class="line one">
	    <div class="label">
		'.$label.':
	    </div>
	    <div class="data">
		'.$value.'
	    </div>
	   
	</div>';
    } 
    public function two($label, $value, $label2, $value2){
	$this->html .= ' <div class="line two">
	    <div class="label">
		'.$label.':
	    </div>
	    <div class="data">
		'.$value.'
	    </div>
	    <div class="label">
		'.$label2.':
	    </div>
	    <div class="data">
		'.$value2.'
	    </div>
	</div>';
    }
    public function plot(){
	$this->html .= ' <div class="line"></div>
			</div>';
	echo $this->html;
    }
}


//záložky pro výpis náhledu 
class tabControl{
    protected $out = "";
    protected $first = "";
    protected $remembered = "";
    public function __construct(){
	global $module;
	if (isset($_SESSION["tabControlLast"]["$module"])){
	    $this->remembered = $_SESSION["tabControlLast"]["$module"];
	}
	    $this->out = '<div class="tabs">';
    }
    public function addTab($label, $code){
	if ($this->first == ""){
	    $this->first = $code;
	}
	$this->out .= '<div class="tab a TABdef'.$code.'" data="TAB'.$code.'">
	'.$label.'
    </div>';
    }
    public function plotThere(){
	
	if ($this->remembered == ""){
	    $this->remembered = $this->first;
	}
	
	$this->out .= '</div>';
	echo $this->out;
	echo ' <script>   $(".tabs .tab").unbind();
    $(".tabs .tab").click(function(){
	$(".tabs .tab").removeClass("aktivni");
	$(this).addClass("aktivni");
	$(".tabBlok").removeClass("aktivni");
	$(".tabBlok."+$(this).attr("data")).addClass("aktivni");
	
	$.ajax({type: "POST",
	    url: "/admin/core/pager.php",
	    data: { module: module, tabSet: $(this).attr("data"), tabControlSet:  true}
	});
    }); 
    $(".tabs .TABdef'.$this->remembered.'").trigger("click");
    </script>
    ';
    }
}
class tab{
    public function __construct($code = ""){
	    echo '<div class="tabBlok TAB'.$code.'">';
    }
    public function contentEnd(){
	echo "</div>";
    }
}

class multiFiles{
 protected $name = "";
 protected $label = "";
 protected $file = "";
 protected $source = "";
 protected $append = "";

    public function __construct($label, $name, $source){
        $this->name = $name;
        $this->label = $label;
        $this->file = $name;
        $this->source = $source;
    }
    public function appendTo($name){
        $this->append = $name;
    }
    public function plot(){
        $out = '<script>
                     $("#'.$this->name.'").unbind("focusout");
                </script>
                <div class="formline multiupload">
                        
                        <input type="file" class=fileClick id="fileClick'.$this->name.'" style="display:none" multiple accept="/*" onclick="">
                        <div class="nahled fileUpload a" onclick="$(this).parent().find(\'.fileClick\').trigger( \'click\' );" 
                        style="background-image: url(/admin/img/upload.png)">
                            <div class="notify a"></div>
                        </div>
                        <div class=input style="width: 800px; padding-top: 40px;">
                            <div class="imageBtn a fileNew" onclick="$(this).parent().parent().find(\'.fileClick\').trigger( \'click\' );" >Nahrát nové soubory</div>
                            <input type="hidden" class="return" name="'.$this->name.'" id="filereturn'.$this->name.'" value="" placeholder="test">     
                        <div class=help style="padding-top: 10px;">
                           Přetažením souboru na kolečko nebo kliknutím na tlačítko "Nahrát nový" můžete nahrát nový soubor</div>
                        </div>';
$out .= "
          <script>
                                    $('#{$this->name}').change(function(){
                                        $(this).parent().parent().find(\" .nahled\").css(\"background - image\",\"url(/admin/img/upload.png)\");
                                    });
                                    $('#fileClick{$this->name}').unbind();
                                    $('#fileClick{$this->name}').change(function(event){
                                        var files = event.target.files;
                                        handleFileUpload(files,$(this).parent());
                                    });
                                    $('#filereturn{$this->name}').unbind();
                                    $('#filereturn{$this->name}').change(function(event){
                                        $(this).parent().parent().find(\".nahled\").css('background-image','url(/admin/img/upload.png)');
                                          console.log($(this).val());
                                        $(\".preppendThere\").remove();
	$(\"#sortable$this->append\").prepend('<div class=\"preppendThere\"><img src=\"/admin/img/loader2.gif\"></div>');
        $.ajax({type: \"POST\",
		url: \"/admin/core/pager.php\",
		data: { module: module, page: '$this->file', source:  '$this->source', target: $(this).val()}
	}).done(function( data ) {
		$(\".preppendThere\").remove();
                $(\"#sortable$this->append\").prepend(data); 
			
	}); 
                                    });
                                    
                               </script>
";


        $out .= '
                        <div class="clear"></div>
               </div>
        ';

        return $out;
    }
}

class sortableSpace{
    
    protected $url = "";
    protected $name = "";
    public function __construct($name, $url, $multifiles = false){



        if($multifiles != false){
            $multifiles->appendTo($name);
            echo $multifiles->plot();
        }

	    $this->url = $url;
	    $this->name = $name;
	    echo ' <div id="orderSaved" class="orderSaved'.$name.'" style="display:none;">Nové pořadí bylo uloženo</div>
			    <div id="sortable'.$name.'">';
    }
    public function plotThere(){
	echo '</div>';
	echo ' <script>   $(function() {
    $( "#sortable'.$this->name.'" ).sortable( {
    axis: \'y\',
    update: function (event, ui) {
        var data = $(this).sortable(\'serialize\');
        $(".orderSaved'.$this->name.'").clearQueue();
        $(".orderSaved'.$this->name.'").fadeIn();
        $(".orderSaved'.$this->name.'").delay(2500).fadeOut();
        // POST to server using $.post or $.ajax
        $.ajax({type: "POST",
		url: "/admin/core/pager.php",
		data: { module: module, page: "'.$this->url.'", sort:  data}
	});
    }
    });
    $( "#sortable" ).disableSelection();
  });
  </script>
    ';
    }
}

//ajaxové stránkování
class listLoad{
    protected $pageName;
    protected $activeTag;
    protected $remembered = "";
    protected $search = "";
    protected $first = "";

    public function __construct($name){

        global $module;
        if (isset($_SESSION["labelControlLast"]["$module"])){
            $this->remembered = $_SESSION["labelControlLast"]["$module"];
            $this->search = $_SESSION["labelControlLastSearch"]["$module"];
        }

	$this->pageName = $name;
    }
    
    public function addLabel($name, $val){
        if ($this->first == ""){
            $this->first = $val;
        }
	    echo "<div class='tag a LABELdef$val' type='{$val}'>	{$name}   </div>";
    }
    public function addsSearchLabel ($placeholder = "", $val = ""){
        if($this->search != "" && $this->remembered == "search"){
            $val = $this->search;
        }
        echo " <input type='text' class='a' id='searchText' value='{$val}' placeholder='{$placeholder}' style='padding: 11px 10px;  float: left;  margin: 0 5px 0 0;  width: 160px;'>
        <div class='tag a LABELdefsearch' id=search type='search'>
        <i class='fa fa-search'></i>
        </div>";
    }
    public function loadThere(){

        if ($this->remembered == ""){
            $this->remembered = $this->first;
        }
	echo '
	  
	  <div class="clear"></div><br>
<div class="default">
<div class="preppendThere"></div>
</div>
<div class="loadMore a">Zobrazit další</div>
  
<script>
    var free = true;
    var pageNum = 1;
    $(".tag").unbind();
    $(".tag").click(function(){


console.log("1");
    $.ajax({type: "POST",
	    url: "/admin/core/pager.php",
	    data: { module: module, labelSet: $(this).attr("type"), searchSet: $("#searchText").val(), labelControlSet:  true}
	});


console.log("2");
	pageNum = 1;
	type = $(this).attr("type");
	 $(".tag").removeClass("aktivni");
	 $(this).addClass("aktivni");
	$(".loadMore").trigger("click");
	$(".loadMore").html("Zobrazit další");
	$(".loadMore").removeClass("nonactive");

console.log("3");
    });


 $("#searchText").unbind();
    $("#searchText").keypress(function(e) {
    if(e.which == 13) {
       $("#search").trigger("click");
    }
});
    

    $( ".loadMore" ).unbind();
    $(".loadMore").click(function(){
	if (free === false) { return false; }
	free= false;
	if (pageNum === 1){
	    $(".default").html("");
	}
	$(".preppendThere").remove();
	$(".default").append(\'<div class="preppendThere"><img src="img/loader2.gif"></div>\');
	
	$.ajax({type: "POST",
		url: "/admin/core/pager.php",
		data: {  module: module, page: "'.$this->pageName.'",load: "true", type: type, pageNum: pageNum, search: $("#searchText").val() }
            }).done(function( data ) {
	    
		$(".preppendThere").remove();
		if (data === "[[END]]"){
		    $(".loadMore").html("To je vše");
		    $(".loadMore").addClass("nonactive");
		}else{
		$(".default").append(data);
		}
	    pageNum = pageNum + 1;
	    free=true;
	    });
	});

    
   $(".tag.LABELdef'.$this->remembered.'").trigger("click");

    
   
</script>

	';
    }
}

