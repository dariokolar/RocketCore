<?php
require_once dirname(__FILE__).'/load.php';
/*
 * 
 * Mini filemanager
 */

?>
<div class="fileSpace">
    <?php
    $test = "filemanagerinput";
    echo "<div class='fileupload'><input type='file' class=fileClick id='fileClick{$test}' style='display:none' multiple accept=\"/*\">
                        <div class='nahled fileUpload a' style='background-image: url(img/upload.png)' onclick='$(this).parent().find(\".fileClick\").trigger( \"click\" );'>
                            <div class='notify a'></div>
                        </div>

                 <div class='imageBtn a fileNew' onclick='$(this).parent().find(\".fileClick\").trigger( \"click\" );' >Nahrát nový</div>

                            <input type=hidden name={$test} id={$test} value='' placeholder='' class='a'>
                                <script>
                                    $('#{$test}').unbind();
                                    $('#{$test}').change(function(){
                                        console.log($(this).val());
                                        console.log( $(this).parent());
                                        $(this).parent().after('<div class=\"box file a\" ><div class=\"icon\" style=\"background-image: url('+$(this).val()+')\"></div><div class=\"data\"><div class=\"name\">'+$(this).val().replace('/files/','')+'</div></div><div class=\"info\"><div class=link>'+$(this).val()+'</div></div></div>');
                                        $(this).parent().parent().find('.fileUpload').css('background-image','url(img/upload.png)');

                                          $(\".coverFile .oknoFile .box\").unbind();
                                        $(\".coverFile .oknoFile .box\").click(function(){
                                            ";
    if(isset($_GET["ckedit"])){
        echo "    obj.insertHtml(\"<img src='\"+$(this).find(\".link\").html()+\"' >\"); ";
    }else{ echo "
                                            obj.find(\"input.a\").val($(this).find(\".link\").html());
                                            obj.find(\"input.a\").trigger(\"change\");
                                            obj.find(\".nahled\").css(\"background-image\",\"url('\"+($(this).find(\".link\").html())+\"')\")  ;
                                            ";} echo "
                                            $(\".cover\").fadeOut();
                                        });
                                    });
                                    $('#fileClick{$test}').unbind();
                                    $('#fileClick{$test}').change(function(event){
                                        var files = event.target.files;
                                        handleFileUpload(files,$(this).parent());
                                    });
                               </script>

</div>

                    ";

    ?>
                    <?php echo files::dejList(1); ?>
                </div> 
                <script>
                 $(".fileSpace .box").unbind("click");
            </script>