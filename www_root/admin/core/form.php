<?php


class input{
    protected $name;
    protected $data;
    protected $label;
    protected $input;
    protected $help;
    protected $value;
    protected $placeholder;
    protected $other = "";
    protected $valid = "<input type=hidden class=valid value=1>";

    public function __construct($name, $value="", $label = ""){
        $this->name = $name;
        $this->label = $label;
        $this->inputval = $value;
        if(is_array($value)){
            $this->value = $value[$this->name];
        }else{
            $this->value = $value;
        }
    }
    public function help($string){
        $this->help = "<div class=help>{$string}</div>";
    }
    public function placeholder($string){
        $this->placeholder = $string;
    }
    public function option($yes = "Ano", $no = "Ne"){
        if ($this->value == 1){
            $out = $yes;
        }else{
            $out = $no;
        }
        $this->input = " <input type=\"hidden\" name=\"{$this->name}\" id=\"{$this->name}\" value=\"{$this->value}\" >
                            <div class=\"option a\" id=\"{$this->name}OPT\"><div class=\"in a val{$this->value}\">$out</div></div><div class='clear'></div>";
        $this->validate('
               <script>
                  $("#'.$this->name.'OPT").unbind("click");
                  $("#'.$this->name.'OPT").click(function(){
                    if ($(this).parent().find("#'.$this->name.'").val() === "0"){
                        $(this).parent().find("#'.$this->name.'").val(1);
                        $(this).find(".in").removeClass("val0");
                        $(this).find(".in").addClass("val1");
                        $(this).find(".in").html("'.$yes.'");
                    }else{
                        $(this).parent().find("#'.$this->name.'").val(0);
                        $(this).find(".in").removeClass("val1");
                        $(this).find(".in").addClass("val0");
                        $(this).find(".in").html("'.$no.'");
                    }
                      $(this).parent().find("#'.$this->name.'").trigger("change");
                });
            </script>', 1);

    }

    public function optionval($yes = "Ano", $no = "Ne", $valname = false, $valdata = false){



        if(!$valname || !$valdata){
            $valname = $this->name."Val";
            $valdata = $this->inputval;
        }

        if(is_array($valdata )){
            $valdata = $valdata[$valname];
        }else{
            $valdata;
        }

        if ($this->value == 1){
            $out = $yes;
            $display = "";
        }else{
            $out = $no;
            $display = " style='display:none' ";
        }
        $this->input = " <input type=\"hidden\" name=\"{$this->name}\" id=\"{$this->name}\" value=\"{$this->value}\" >
                            <div class=\"option a\" id=\"{$this->name}OPT\"><div class=\"in a val{$this->value}\">$out</div></div>";

     
        $this->input .='
			 <input type="text" name="'.$valname.'val" id="'.$valname.'" value="'.$valdata.'" placeholder="'.$this->placeholder.'" '.$display.' class="a optionWithVal">
               <div class=\'clear\'></div>         ';

        $this->validate('
               <script>
                  $("#'.$this->name.'OPT").unbind("click");
                  $("#'.$this->name.'OPT").click(function(){
                    if ($(this).parent().find("#'.$this->name.'").val() === "0"){
                        $(this).parent().find("#'.$this->name.'").val(1);
                        $(this).find(".in").removeClass("val0");
                        $(this).find(".in").addClass("val1");
                        $(this).find(".in").html("'.$yes.'");
                        $("#'.$valname.'").fadeIn();
                    }else{
                        $(this).parent().find("#'.$this->name.'").val(0);
                        $(this).find(".in").removeClass("val1");
                        $(this).find(".in").addClass("val0");
                        $(this).find(".in").html("'.$no.'");
                        $("#'.$valname.'").fadeOut();
                    }
                });
            </script>', 1);

    }


    public function validate($script, $valid = 0){
        $this->valid = "    <input type=hidden class=valid value=$valid>
                            <div class=smallWarGreen style='display:none;'>
                                <i class='fa fa-check'></i>
                            </div>
                            <div class=smallWarRed>
                                <i class='fa fa-times'></i>
                            </div>
                            $script";
    }
    public function plot(){
        echo $this->returnString();
    }
    public function returnString(){
        $out = "<script>
                     $('#{$this->name}').unbind();
                </script>
               <div class='formline'>
                        <div class=label>
                            {$this->label}
                        </div>
                        <div class=input>
                                {$this->input}
                                {$this->valid}
                                {$this->help}
                        </div>

                        </div>  {$this->other} ";
        return $out;
    }

    public function hidden(){
        $this->input = "<input type=hidden name={$this->name} id={$this->name} value='{$this->value}'>";
    }
    public function mail($valid = true){
        $this->input = "<input type=text name={$this->name} id={$this->name} value='{$this->value}' placeholder='{$this->placeholder}' class=a>";
        if($valid) {
            $this->validate('
               <div class="warning red a">
                       Toto nevypadá jako email!
               </div>
               <script>
                $("#'.$this->name.'").focusout(function(){
                    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    if (re.test($(this).val()) == false){
                        $(this).parent().parent().find(".warning").addClass("active");
                        $(this).parent().parent().find(".smallWarGreen").fadeOut();
                        $(this).parent().parent().find(".smallWarRed").fadeIn();
                        $(this).parent().parent().find(".valid").val(0);
                    }else{
                        $(this).parent().parent().find(".warning").removeClass("active");
                        $(this).parent().parent().find(".smallWarGreen").fadeIn();
                        $(this).parent().parent().find(".smallWarRed").fadeOut();
                        $(this).parent().parent().find(".valid").val(1);
                    }
                });
            </script>');
        }
    }
    public function text($minChar = false, $type="text", $readonly = false){
        if($readonly){$temp = "readonly";}
        $this->input = " <input type=$type name={$this->name} id={$this->name} value='{$this->value}' placeholder='{$this->placeholder}' class=a $temp>";
        if($minChar != false) {
            $this->validate('
               <div class="warning red a">
                         Text je příliš krátký! '.$minChar.' je minimum.
               </div>
               <script>
                $("#'.$this->name.'").focusout(function(){
                    if ($(this).val().length < '.($minChar).'){
                        $(this).parent().parent().find(".warning").addClass("active");
                        $(this).parent().parent().find(".smallWarGreen").fadeOut();
                        $(this).parent().parent().find(".smallWarRed").fadeIn();
                        $(this).parent().parent().find(".valid").val(0);
                    }else{
                        $(this).parent().parent().find(".warning").removeClass("active");
                        $(this).parent().parent().find(".smallWarGreen").fadeIn();
                        $(this).parent().parent().find(".smallWarRed").fadeOut();
                        $(this).parent().parent().find(".valid").val(1);
                    }
                });
            </script>');
        }
    }
    public function pass($minChar = 6, $repeat = false){
        $this->input = " <input type='password' name={$this->name} id={$this->name} value='{$this->value}' placeholder='{$this->placeholder}' class=a >";
        if($minChar != false) {
            $this->validate('
               <div class="warning red a">
                          Heslo je příliš krátké! '.$minChar.' je minimum.
               </div>
               <script>
                $("#'.$this->name.'").keyup(function(){

                    $("#'.$this->name.'2").trigger( "keyup" );
                    if ($(this).val().length < '.($minChar).'){
                        $(this).parent().parent().find(".warning").addClass("active");
                        $(this).parent().parent().find(".smallWarGreen").fadeOut();
                        $(this).parent().parent().find(".smallWarRed").fadeIn();
                        $(this).parent().parent().find(".valid").val(0);

                    }else{
                        $(this).parent().parent().find(".warning").removeClass("active");
                        $(this).parent().parent().find(".smallWarGreen").fadeIn();
                        $(this).parent().parent().find(".smallWarRed").fadeOut();
                        $(this).parent().parent().find(".valid").val(1);

                    }
                });
            </script>');
        }

        if($repeat){

            $pass = new input("pass2", "", " Potvrzení hesla");
            $pass->pass();
            $pass->placeholder("Zopakujte heslo");
            $pass->help("Zvolte minimálně $minChar znaků a kombinujte číslice a písmena. Pro bezpečnějsí heslo kombinujte malá a velká písmena, číslice a speciální znaky.");
            $pass->validate('
               <div class="warning red a">
                            Hesla se neschodují!
               </div>
               <script>
                 $("#'.$this->name.'2").keyup(function(){

                    if ($(this).val() !==  $("#'.$this->name.'").val() || $(this).val().length < 1){
                        $(this).parent().parent().find(".warning").addClass("active");
                        $(this).parent().parent().find(".smallWarGreen").fadeOut();
                        $(this).parent().parent().find(".smallWarRed").fadeIn();
                        $(this).parent().parent().find(".valid").val(0);
                    }else{
                        $(this).parent().parent().find(".warning").removeClass("active");
                        $(this).parent().parent().find(".smallWarGreen").fadeIn();
                        $(this).parent().parent().find(".smallWarRed").fadeOut();
                        $(this).parent().parent().find(".valid").val(1);
                    }
                });
            </script>');
            $this->other = $pass->returnString();

        }

    }
    public function image(){
        $this->input = "<input type='file' class=fileClick id='fileClick{$this->name}' style='display:none' multiple accept=\"/*\">
                        <div class='nahled fileUpload a' style='background-image: url(".photo($this->value, "small", "/admin/img/upload.png").")' onclick='$(this).parent().find(\".fileClick\").trigger( \"click\" );'>
                            <div class='notify a'></div>
                        </div>
                        <div class=file>
                            <div class='imageBtn a fileNew' onclick='$(this).parent().parent().find(\".fileClick\").trigger( \"click\" );' >Nahrát novou</div>
                            <div class='imageBtn a fileManager' onclick='openFileManager($(this).parent().parent());' >Vybrat ze správce souborů</div>
                            <input type=hidden class='addData'  value='' >
                            <input type=text name={$this->name} id={$this->name} value='{$this->value}' placeholder='...nebo odkaz existujícího obrázku' class='a'>
                                <script>
                                    $('#{$this->name}').change(function(){
                                        $(this).parent().parent().find(\".nahled\").css(\"background-image\",\"url(\"+$(this).val()+\")\");
                                    });
                                    $('#fileClick{$this->name}').unbind();
                                    $('#fileClick{$this->name}').change(function(event){
                                        var files = event.target.files;
                                        handleFileUpload(files,$(this).parent());
                                    });
                               </script>

                        <div class=help>
			    Můžete nahrát nový obrázek, nebo použít některý, který jste již použili v minulosti. Dovolenými formáty jsou *.jpg, *.png a *.gif.
                        </div>
                        </div>";

    }
    public function textarea($minChar = false, $type="text"){
        $this->input = " <textarea name={$this->name} id={$this->name} placeholder='{$this->placeholder}' class=a >{$this->value}</textarea>";
        if($minChar != false) {
            $this->validate('
               <div class="warning red a">
                         Text je příliš krátký! '.$minChar.' je minimum.
               </div>
               <script>
                $("#'.$this->name.'").focusout(function(){
                    if ($(this).val().length < '.($minChar).'){
                        $(this).parent().parent().find(".warning").addClass("active");
                        $(this).parent().parent().find(".smallWarGreen").fadeOut();
                        $(this).parent().parent().find(".smallWarRed").fadeIn();
                        $(this).parent().parent().find(".valid").val(0);
                    }else{
                        $(this).parent().parent().find(".warning").removeClass("active");
                        $(this).parent().parent().find(".smallWarGreen").fadeIn();
                        $(this).parent().parent().find(".smallWarRed").fadeOut();
                        $(this).parent().parent().find(".valid").val(1);
                    }
                });
            </script>');
        }
    }
    public function date(){
        if(empty($this->value)){
            $this->value = date("j.n.Y",strtotime("now"));
        }else{
            $this->value= dateformat($this->value);
        }
        $this->input = " <input type='text' name={$this->name} id={$this->name} value='{$this->value}' placeholder='{$this->placeholder}' class=a >";

        $this->validate('

               <script>
                    $( "#'.$this->name.'" ).datepicker({
							    dateFormat: "dd.mm.yy",
							    firstDay: 1
							  });
            </script>', 1);

    }
    public function editor(){
        $this->input = " <textarea type=$type name={$this->name} id={$this->name} placeholder='{$this->placeholder}' class=a >{$this->value}</textarea>";

        $this->validate('

               <script>
                       CKEDITOR.replace( \''.$this->name.'\' );
            </script>', 1);

    }
    public function select($data = array()){


        $this->input = " <select name={$this->name} id={$this->name}  class=a >";

        foreach($data as $key => $val){
            $tempSel = "";
            if($this->value == $key){
                $tempSel = "selected";
            }
            $this->input .= "<option value='$key' $tempSel >$val</option>";
        }

        $this->input .= "</select>";


    }

    public function draginput($data = array()){

        $tempVal = "";
        $empty = true;
        foreach($data as $val){
            if($tempVal == ""){
                $tempVal = $val;
            }else{
                $tempVal = $tempVal.";".$val;
            }
            $empty = false;
        }


        $this->input = " <input type='hidden' name={$this->name} id={$this->name} value='$tempVal' class=a ><div class='unsubSort'> <div class=\"sortable sortable{$this->name}\">";

        if($empty){
            $this->input .='<div class="item"><input class="a" type="text" value="" placeholder="'.$this->placeholder.'"><i class="fa fa-arrows"></i><i class="fa fa-times"></i></div>';
        }
        foreach($data as $val){
            $this->input .='<div class="item"><input class="a" type="text" value="'.$val.'" placeholder="'.$this->placeholder.'"><i class="fa fa-arrows"></i><i class="fa fa-times"></i></div>';
        }

        $this->input .= "
            </div>
            <div class=\"sortablepridat sortablepridat{$this->name} a\">
                <i class=\"fa fa-plus\"></i> Přidat
            </div></div><div class=clear></div>";
        $this->validate('

               <script>
                      $(".sortablepridat'.$this->name.'").unbind();
                      $(".sortable'.$this->name.'").unbind();
            $(".sortablepridat'.$this->name.'").click(function(){
                $(".sortable'.$this->name.'").append(\'<div class="item"><input  class="a" type="text" value="" placeholder="'.$this->placeholder.'"><i class="fa fa-arrows"></i><i class="fa fa-times"></i></div>\')  ;
            });
            $(".sortable'.$this->name.'").on("click", ".fa-times",  function(){
                $(this).parent().remove();
                plotDragItems("'.$this->name.'");
            });
            $(".sortable'.$this->name.'").on("change", "input",  function(){
                plotDragItems("'.$this->name.'");
            });

            $(function() {
                $( ".sortable'.$this->name.'" ).sortable( {
                    axis: \'y\',
                    update: function (event, ui) {

                        plotDragItems("'.$this->name.'");
                    }
                } );

            });


            </script>', 1);

    }


    public function labels($data = array()){


        $values = explode(";", $this->value);
        $this->input = " <input type='hidden' name={$this->name} id={$this->name} value='{$this->value}' class=a >  <div class=\"input tagSelect {$this->name}TAG\">";


        foreach($data as $key => $val){
            $aktivni = " ";
            if (in_array($key, $values)){
                $aktivni = " aktivni ";
            }
            $this->input .= '<div class="tag a '.$aktivni.' labelTag" data="'.$key.'">'.$val.'</div>';


        }
        $this->input .= " </div>";

        $this->validate('

               <script>
                 $(".'.$this->name.'TAG .tag").unbind();
                  $(".'.$this->name.'TAG .tag").unbind();
			    $(".'.$this->name.'TAG .tag").click(function(){
			       if ($(this).hasClass("aktivni")){
				   //ma, tedy odebírám
				   $(this).removeClass("aktivni");
				   //   $("#'.$this->name.'").val(   $("#'.$this->name.'").val().replace(",\'"+$(this).attr("data")+"\'", "")  );
			       }else{
				   //nema, tedy pridavam
				   $(this).addClass("aktivni");
				//   console.log($("#'.$this->name.'").val()+ ",\'"+$(this).attr("data")+"\'");
				  // $("#'.$this->name.'").val( $("#'.$this->name.'").val()+ ",\'"+$(this).attr("data")+"\'");
				  
			       }
			       $("#'.$this->name.'").val("");
			         $(".'.$this->name.'TAG .tag.aktivni").each(function(){
			         if(      $("#'.$this->name.'").val() === ""){
			              $("#'.$this->name.'").val($(this).attr("data"));
			         }else{
			              $("#'.$this->name.'").val( $("#'.$this->name.'").val()+ ","+$(this).attr("data"));
			         }
			         });
			       
			   });
                 
                  


            </script>', 1);

    }
    public function labelsSearch($data = array(), $afterlbels = ""){


        $values = explode(",", $this->value);
        $this->input = " <input type='hidden' name={$this->name} id={$this->name} value='{$this->value}' class=a>  <div class=\"input tagSelect {$this->name}TAG\" style=\" background: #f4f4f4;   border-radius: 2px; margin: 0 0 10px 0;\">";

        $this->input .= "<input type='text' id={$this->name}TAGS  class='a tagSearch {$this->name}TAGS' placeholder='{$this->placeholder}' autocomplete='off' style='margin: 0'> <div class=hello style='padding: 10px;'>{$this->placeholder}</div> ";

        foreach($data as $key => $val){
            $aktivni = " ";
            $aktivni2 = " style=\"display:none;\" ";
            if (in_array($key, $values)){
                $aktivni = " aktivni ";
                //   $aktivni2 = " ";
            }
            $this->input .= '<div class="tag a '.$aktivni.' tag'.$key.' labelTag" data="'.$key.'" '.$aktivni2.' >'.$val.'</div>';


        }
        $this->input .= " </div><div class=\"input tagSelect \" style='margin: 0 0 10px 0;'><span class='{$this->name}TAG2'>";


        foreach($data as $key => $val){


            if (in_array($key, $values)){
                $this->input .= '<div class="tag a aktivni tag'.$key.' labelTag" data="'.$key.'" >'.$val.' &nbsp; <i class=\'fa fa-times-circle\'></i></div>';

            }


        }

        $this->input .= "</span>$afterlbels</div>";

        $this->validate('

               <script>
                 $(".'.$this->name.'TAG .tag").unbind();
                 $(".'.$this->name.'TAGS").unbind();
                  $(".'.$this->name.'TAG .tag").unbind();
			    $(".'.$this->name.'TAGS").keyup(function(){
			    if($(".' . $this->name . 'TAGS").val().length < 2 ){  $(".' . $this->name . 'TAG .tag").hide(); $(".' . $this->name . 'TAG .hello").show(); return false; }
			    $(".' . $this->name . 'TAG .hello").hide();
			             $(".' . $this->name . 'TAG .tag").each(function(){
			             
			             if($(this).hasClass("aktivni")){    $(this).hide(); }else{
			             
                   if($(this).text().toUpperCase().indexOf( $(".' . $this->name . 'TAGS").val().toUpperCase()) != -1){
                               $(this).show();
                           }else{
                            $(this).hide();
                           } }
                           });
			   });
			    $(".'.$this->name.'TAG .tag").click(function(){
			       if ($(this).hasClass("aktivni")){
				   //ma, tedy odebírám
				   $(this).removeClass("aktivni");
				   //   $("#'.$this->name.'").val(   $("#'.$this->name.'").val().replace(",\'"+$(this).attr("data")+"\'", "")  );
			       }else{
			       $(this).hide();
				   //nema, tedy pridavam
				   $(this).addClass("aktivni");
				//   console.log($("#'.$this->name.'").val()+ ",\'"+$(this).attr("data")+"\'");
				  // $("#'.$this->name.'").val( $("#'.$this->name.'").val()+ ",\'"+$(this).attr("data")+"\'");
				  
			       }
			       $("#'.$this->name.'").val("");
			         $(".'.$this->name.'TAG2").html("");
			         $(".'.$this->name.'TAG .tag.aktivni").each(function(){
			         
			           $(".'.$this->name.'TAG2").append("<div class=\'tag a aktivni\' data=\'"+$(this).attr("data")+"\'>"+$(this).html()+" &nbsp; <i class=\'fa fa-times-circle\'></i></div> ");
			         
               
			         
			         if(      $("#'.$this->name.'").val() === ""){
			              $("#'.$this->name.'").val($(this).attr("data"));
			         }else{
			              $("#'.$this->name.'").val( $("#'.$this->name.'").val()+ ","+$(this).attr("data"));
			         }
			         });
			         $(".'.$this->name.'TAG2 .tag").unbind();
                  $(".'.$this->name.'TAG2 .tag").click(function(){
                                 $(".'.$this->name.'TAG .tag"+$(this).attr("data")).trigger("click");
                                  $(".'.$this->name.'TAGS").trigger("keyup");
                  });
                  
			   });
                   $(".'.$this->name.'TAG2 .tag").click(function(){
                                 $(".'.$this->name.'TAG .tag"+$(this).attr("data")).trigger("click");
                                  $(".'.$this->name.'TAGS").trigger("keyup");
                  });
                  
                  
 
 
 
            </script>', 1);

    }
}


class form {
    protected $data;

    public function __construct(){
        $this->data = "";
    }
    public function add($in){
        if ($in instanceof input ){
            $this->data .= $in->returnString();
        }else{
            $this->data .= $in;
        }
    }
    public function plot(){
        echo "<form>".$this->returnString()."</form>";
    }
    public function returnString(){
        return $this->data;
    }


}

