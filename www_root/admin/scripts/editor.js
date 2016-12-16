
function getHTML(){
    $("rocketeditor *").each(function(){
        if($(this).html() == "" && $(this)[0].nodeName !== "IMG"  && $(this)[0].nodeName !== "BR") {
            $(this).remove();
        }
    });
    //$("textarea").val($("rocketeditor").html().replace(new RegExp("div", 'g'), "p")  );
    $("textarea").val($("rocketeditor").html()  );
}

function replaceSelectedText(replacementText) {
    var sel, range;
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.rangeCount) {
            range = sel.getRangeAt(0);
            range.deleteContents();
            range.insertNode(document.createTextNode(replacementText));
        }
    } else if (document.selection && document.selection.createRange) {
        range = document.selection.createRange();
        range.text = replacementText;
    }
}

$(document).ready(function(){

    var target = "";
    $(".content").on("keypress", "rocketeditor", function(e){
        if(e.keyCode == '13' &&  target.nodeName.toLowerCase() !== "li"){
            console.log(target.nodeName.toLowerCase());
            document.execCommand('formatBlock', false, 'p');
        }
    });
    $('.content').on('DOMCharacterDataModified', "rocketeditor", function( e ) {
        target = e.target;
    });
    $(".content").on("keyup", "rocketeditor", function(){
        bindDraggables();
        getHTML();
    });
    $(".content").on("click", "rocketeditor", function(e){
        target = e.target;

        console.log(target.nodeName.toLowerCase());
        $(".rocketeditor-toolbar .markup").removeClass("aktivni");
        $(".rocketeditor-toolbar .align").removeClass("aktivni");
        $(".rocketeditor-toolbar .link").removeClass("aktivni");
        $(".rocketeditor-toolbar .image").removeClass("aktivni");
        $(".rocketeditor-toolbar .insert").removeClass("aktivni");
        $(".rocketeditor-tabs").css("height","0");
        $(".rocketeditor-toolbar .tool.type-"+target.nodeName.toLowerCase()).addClass("aktivni");
        if(target.nodeName.toLowerCase() == "li"){
            $(".rocketeditor-toolbar .tool.type-"+$(target).parent()[0].nodeName.toLowerCase()).addClass("aktivni");
        }
        $(".rocketeditor-toolbar .tool.type-"+$(target).closest("p").css("textAlign")).addClass("aktivni");

        if(target.nodeName.toLowerCase() === "a"){
            $(".rocketeditor-toolbar .link.type-"+target.nodeName.toLowerCase()).addClass("aktivni");
            $(".rocketeditor-tabs .tab").hide();
            $(".rocketeditor-tabs .tab.link").fadeIn();
            $(".rocketeditor-tabs .tab.link input").val($(target).attr("href"));
            $(".rocketeditor-tabs").css("height",$(".rocketeditor-tabs .tab.link").height() );
        }
        if(target.nodeName.toLowerCase() === "img"){
            $(".rocketeditor-toolbar .image.type-"+target.nodeName.toLowerCase()).addClass("aktivni");
            $(".rocketeditor-tabs .tab").hide();
            $(".rocketeditor-tabs .tab.image").fadeIn();
            $(".rocketeditor-tabs .tab.image .src").val($(target).attr("src"));
            $(".rocketeditor-tabs .tab.image .width").val($(target).attr("width"));
            $(".rocketeditor-tabs .tab.image .height").val($(target).attr("height"));
            $(".rocketeditor-tabs").css("height",$(".rocketeditor-tabs .tab.image").height() );
        }
    });

    $(".rocketeditor-tabs .tab.link input").keyup(function(){
        $(target).attr("href", $(this).val());
        getHTML()
    });

    $(".rocketeditor-tabs .tab.image input").keyup(function(){
        $(target).attr( $(this).attr("class"), $(this).val());
        getHTML()
    });

    $(".content").on("click", ".rocketeditor-toolbar .image", function(){
        if($(this).hasClass("aktivni")){
            $(".rocketeditor-toolbar .image").removeClass("aktivni");
            $(target).replaceWith(function() { return this.innerHTML; });
            $(".rocketeditor-tabs").css("height","0");
        }else{
            $(".rocketeditor-toolbar .image").removeClass("aktivni");
            markup($(this).attr("type"), "temp");
            target = $(".temp")[0];
            $(target).removeAttr("class");
            $(target).attr("src", "#");
            $(this).addClass("aktivni");
            $(".rocketeditor-tabs .tab.image").fadeIn();
            $(".rocketeditor-tabs").css("height",$(".rocketeditor-tabs .tab.image").height() );
            $(".rocketeditor-tabs .tab.image input").val("");
            $(".rocketeditor-tabs .tab.image .src").focus();
        }
        getHTML()
    });

    $(".content").on("click", ".rocketeditor-toolbar .insert", function(){
        if($(this).hasClass("aktivni")){
            $(".rocketeditor-toolbar .markup").removeClass("aktivni");
            if(target.nodeName.toLowerCase() == "li"){
                target = $(target).parent()[0];
            }
            $(target).replaceWith(function() { return this.innerHTML.replace(new RegExp("<li>", 'g'),"").replace(new RegExp("</li>", 'g'),"<br>"); });
        }else{
            $(".rocketeditor-toolbar .markup").removeClass("aktivni");

            var selection= window.getSelection().getRangeAt(0);
            var selectedText = selection.extractContents();
            var span= document.createElement($(this).attr("type"));
            var li= document.createElement("li");
            li.appendChild(selectedText);
            span.appendChild(li);
            selection.insertNode(span);
        }
        getHTML()
    });

    $(".content").on("click", ".rocketeditor-toolbar .link", function(){
        if($(this).hasClass("aktivni")){
            $(".rocketeditor-toolbar .link").removeClass("aktivni");
            $(target).replaceWith(function() { return this.innerHTML; });
            $(".rocketeditor-tabs").css("height","0");
        }else{
            $(".rocketeditor-toolbar .link").removeClass("aktivni");
            markup($(this).attr("type"), "temp");
            target = $(".temp")[0];
            $(target).removeAttr("class");
            $(target).attr("href", "#");
            $(this).addClass("aktivni");
            $(".rocketeditor-tabs .tab.link").fadeIn();
            $(".rocketeditor-tabs").css("height",$(".rocketeditor-tabs .tab.link").height() );
            $(".rocketeditor-tabs .tab.link input").val("");
            $(".rocketeditor-tabs .tab.link input").focus();
        }
        getHTML()
    });

    $(".content").on("click", ".rocketeditor-toolbar .markup", function(){
        if($(this).hasClass("aktivni")){
            $(".rocketeditor-toolbar .markup").removeClass("aktivni");
            $(target).replaceWith(function() { return this.innerHTML; });
        }else{
            $(".rocketeditor-toolbar .markup").removeClass("aktivni");
            markup($(this).attr("type"), "");
            //$(this).addClass("aktivni");
        }
        getHTML()
    });

    $(".content").on("click", ".rocketeditor-toolbar .align", function(){
        if(target.nodeName.toLowerCase() === "div"){
            alert("chyba");
        }
        if($(this).hasClass("aktivni")){
            $(".rocketeditor-toolbar .align").removeClass("aktivni");
            $(".rocketeditor-toolbar .align.type-left").addClass("aktivni");
            $(target).closest("p").css("text-align", "left");
        }else{
            $(".rocketeditor-toolbar .align").removeClass("aktivni");
            $(target).closest("p").css("text-align", $(this).attr("type"));
            $(this).addClass("aktivni");
        }
        getHTML()
    });

    $(".content").on("drop", "rocketeditor", function(e){
        e.preventDefault();
        var e = e.originalEvent;
        var content = e.dataTransfer.getData('text/html');
        var range = null;
        if (document.caretRangeFromPoint) { // Chrome
            range = document.caretRangeFromPoint(e.clientX, e.clientY);
        }
        else if (e.rangeParent) { // Firefox
            range = document.createRange();
            range.setStart(e.rangeParent, e.rangeOffset);
        }
      //  console.log('range', range)
        var sel = window.getSelection();
        sel.removeAllRanges(); sel.addRange(range);

        $('rocketeditor').get(0).focus(); // essential
        document.execCommand('insertHTML',false, content);
        //$('#editor').append(content);
        sel.removeAllRanges();
        bindDraggables();
     //   console.log($('[dragged="dragged"]').length);
        $('.dragged').remove();
        getHTML();
    });
});


var bindDraggables = function() {
    //console.log('binding draggables', $('rocketeditor img').length);
    $('rocketeditor img').attr("contenteditable", false);
    $('rocketeditor img').off('dragstart').on('dragstart', function(e) {

        if (!e.target.id)
            e.target.id = (new Date()).getTime();
        e.originalEvent.dataTransfer.setData('text/html', e.target.outerHTML);
       // console.log('started dragging');
        $(e.target).addClass('dragged');
    }).on('click', function() {
      //  console.log('there was a click');
    });
}


function markup(type, classa){
    var selection= window.getSelection().getRangeAt(0);
    var selectedText = selection.extractContents();
    var span= document.createElement(type);
    if(classa !== ""){
        span.className = classa;
    }
   //
    span.appendChild(selectedText);
    selection.insertNode(span);
}