

function btnPress(BTN){

    for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();


    /* pokud je storno vyřešíme ihned */
    if (BTN.attr("do") === "storno"){
        $(".oknoAccept").parent().fadeOut(300, function(){
            $(".oknoAccept").find(".in").html("");
        });
        $(".oknoNote").parent().fadeOut(300, function(){
            $(".oknoNote").find(".in").html("");
        });
        return false;
    }


    /* Validace */
    $(".valid").each(function(){
        $(this).parent().find("input").each(function(){
            //	console.log($(this));
            $(this).trigger("focusout");
            $(this).trigger("change");
            $(this).trigger("keyup");
        });
    });

    var valid = true;
    $(".valid").each(function(){
        console.log($(this).val());
        if (parseInt($(this).val()) === 0){
            valid = false;
        }
    });
    /* Konec validací */
    if (BTN.hasClass("returnBack")){
        valid = true;
    }
    if (valid === false){
        return false;
    }

    /*skrytí všho co může být zobrazeno (vyskakovací okna)*/
    $(".oknoAccept").parent().fadeOut();
    $(".oknoNote").parent().fadeOut();

    if (BTN.attr("do") === "page"){
        /* přechod na běžnou stránku */

        buildAdminUrl(module, BTN.attr("page"), BTN.attr("target"), BTN.attr("source"));


        $(".content .in").fadeOut();
        $(".content").addClass("loading");
        var data = $('form').serializeArray();
        var editors = [];
        var editornames = [];
        try {
            for (var i in CKEDITOR.instances) {
                (function(i){
                    editornames.push([CKEDITOR.instances[i].name]);
                    editors.push([CKEDITOR.instances[i].getData()]);
                })(i);
            }
        }catch(err) {

        }
        console.log(editors);


        $.ajax({type: "POST",
            url: "/admin/core/pager.php",
            data: { module: module, page: BTN.attr("page"), form: data, editornames: editornames, editors: editors, source: BTN.attr("source"), target: BTN.attr("target") }
        }).done(function( data ) {
            try {
                for (var i in CKEDITOR.instances) {
                    (function(i){
                        CKEDITOR.instances[i].destroy(true);
                    })(i);
                }
            }catch(err) {

            }
            $(".content .in").delay(400).queue( function(next){
                $(this).html(data);
                $(".content .in").fadeTo(400,1);
                $(".content").removeClass("loading");

                next();
            });
            $('html,body').animate({ scrollTop: 0 }, 'slow');
        });
    }
    if (BTN.attr("do") === "del"){
        /* zobrazení potvrzovacího okna */
        $(".oknoAccept").parent().css("display", "flex").hide().fadeIn();
        $(".oknoAccept").find(".in").html('<div class="preppendThere"><img src="img/loader2.gif"></div>');
        $.ajax({type: "POST",
            url: "/admin/core/pager.php",
            data: { module: module, page: BTN.attr("page"), form: data, source: BTN.attr("source"), target: BTN.attr("target"), accept: false }
        }).done(function( data ) {
            $(".oknoAccept").find(".in").html(data);
            // $('html,body').animate({ scrollTop: 0 }, 'slow');
            $(".oknoAccept").fadeIn();
        });
    }
    if (BTN.attr("do") === "note"){
        /* zobrazení potvrzovacího malého okna (narozdíl od potvrzovacího má flexibilní výšku) */
        $(".oknoNote").parent().css("display", "flex").hide().fadeIn();
        $(".oknoNote").find(".in").html('<div class="preppendThere"><img src="img/loader2.gif"></div>');
        $.ajax({type: "POST",
            url: "/admin/core/pager.php",
            data: { module: module, page: BTN.attr("page"), form: data, source: BTN.attr("source"), target: BTN.attr("target"), accept: false }
        }).done(function( data ) {
            $(".oknoNote").find(".in").html(data);
            //  $('html,body').animate({ scrollTop: 0 }, 'slow');
            $(".oknoNote").fadeIn();
        });
    }


}

/*
 $(document).on("click", ".btn", function(){
 btnPress($(this));
 });*/

$(document).keypress(function(e) {
    if(e.which == 13) {

        var $targ = $(e.target);

        if (!$targ.is("textarea") && !$targ.is(":button,:submit") && !$targ.is("rocketeditor")) {
            btnPress($(".enterSubmit"));
            return false;
        }
        // btnPress($(".enterSubmit"));
    }
});
