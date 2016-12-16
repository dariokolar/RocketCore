
var obj;
function openFileManager(temp){
    obj = temp;
    $(".coverFile").css("display", "flex").hide().fadeIn();
    $.ajax({type: "POST",url: "/admin/core/filemanager.php"}).done(function( data ) {
        $(".coverFile .in").html(data);
        $(".coverFile .oknoFile .box").unbind();
        $(".coverFile .oknoFile .box").click(function(){

            if( typeof(CKEDITOR) !== "undefined" )

            obj.find("input.a").val($(this).find(".link").html());
            obj.find("input.a").trigger("change");
            obj.find(".nahled").css("background-image","url('"+($(this).find(".info .icon").html())+"')")  ;
            $(".cover").fadeOut();
        });

        $(".coverFile .oknoFile .close").unbind();
        $(".coverFile .oknoFile .close").click(function(){
            $(".cover").fadeOut();
        });
    });
}


function openFileManager2(temp){
    obj = temp;
    $(".coverFile").css("display", "flex").hide().fadeIn();
    $.ajax({type: "POST",url: "/admin/core/filemanager.php?ckedit"}).done(function( data ) {
        $(".coverFile .in").html(data);
        $(".coverFile .oknoFile .box").unbind();
        $(".coverFile .oknoFile .box").click(function(){
            obj.insertHtml("<img src='"+$(this).find(".link").html()+"' >");
            $(".cover").fadeOut();
        });
        $(".coverFile .oknoFile .close").unbind();
        $(".coverFile .oknoFile .close").click(function(){
            $(".cover").fadeOut();
        });
    });
}




$(document).on("dragenter", ".fileUpload", function(e){
    e.stopPropagation();
    e.preventDefault();
    $(this).addClass("enter");
});
$(document).on("dragover", ".fileUpload", function(e){
     e.stopPropagation();
     e.preventDefault();
});
$(document).on("drop", ".fileUpload", function(e){
    $(this).removeClass("enter");
    e.preventDefault();
    var files = e.originalEvent.dataTransfer.files;
    handleFileUpload(files,$(this).parent());
});

$(document).on('dragenter', function (e) {
    e.stopPropagation();
    e.preventDefault();
});
$(document).on('dragover', function (e) {
  e.stopPropagation();
  e.preventDefault();
});
$(document).on('drop', function (e) {
    e.stopPropagation();
    e.preventDefault();
});


function sendFileToServer(formData, obj){
    var uploadURL ="/admin/core/upload.php"; //Upload URL
    var extraData ={ }; //Extra Data.
    var jqXHR=$.ajax({
        xhr: function() {
            var xhrobj = $.ajaxSettings.xhr();
            if (xhrobj.upload) {
                xhrobj.upload.addEventListener('progress', function(event) {
                    var percent = 0;
                    var position = event.loaded || event.position;
                    var total = event.total;
                    if (event.lengthComputable) {
                        percent = Math.ceil(position / total * 100);
                    }
                    obj.find(".nahled .notify").css("opacity","0.9");
                    obj.find(".nahled .notify").html(percent+"%");
                    obj.find(".nahled .notify").css('background-image','none');
                    if(percent === 100){
                        obj.find(".nahled .notify").css("opacity","1");
                        obj.find(".nahled .notify").html("");
                        obj.find(".nahled .notify").css('background-image','url(/admin/img/loader2.gif)');
                    }


                }, false);
            }
        return xhrobj;
        },
    url: uploadURL,
    type: "POST",
    contentType:false,
    processData: false,
    cache: false,
    data: formData,
    dataType: "json",
    success: function(data){
	obj.find(".nahled .notify").css("opacity","0");
        obj.find(".nahled").css("background-image","url('"+(data["icon"])+"')")  ;
        obj.find("input.a").val(data["link"]);
	obj.find("input.a").trigger("change");
        obj.find("input.return").val(data["id"]);
        obj.find("input.return").trigger("change");
        }
    }); 
}

function handleFileUpload(files,objDrag){
   for (var i = 0; i < files.length; i++){
        var fd = new FormData();
        fd.append('file', files[i]);
 	fd.append('addData', objDrag.find(".addData").val());
        sendFileToServer(fd, objDrag);
 
   }
}






function plotDragItems(name){

    $("#"+name).val("");
    $(".sortable"+name+" .item").each(function(){
        if ( $("#"+name).val() === ""){
            $("#"+name).val( $(this).find("input").val()) ;
        }else{
            $("#"+name).val( $("#"+name).val()+";"+$(this).find("input").val() );
        }

    });

}