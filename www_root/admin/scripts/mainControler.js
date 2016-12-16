var module;

$(document).ready(function(){

    $(".content").css("min-height",(	$(".mainMenu").height() + $(".sideMenu").height() + 38 + 38 + 5 )+"px");
    $(".left").css("height",(	$(".mainMenu").height() + $(".sideMenu").height() + 38 )+"px");

    $(".mainBtn").click(function(){

        $(".mainBtn").removeClass("active");
        $(this).addClass("active");
        $(".content .in").fadeOut();
        $(".content").addClass("loading");

        document.title = rootName+" - "+$(this).html().replace(/<(?:.|\n)*?>/gm, '');
        module = $(this).attr("module");
//	window.location.hash=module;

        buildAdminUrl($(this).attr("module"), "", "", "");

        $.ajax({type: "POST",
            url: "/admin/core/pager.php",
            data: { module: $(this).attr("module"), page: "index"}
        }).done(function( data ) {

            $(".content .in").delay(400).queue( function(next){
                $(this).html(data);
                $(".content .in").fadeTo(400,1);
                $(".content").removeClass("loading");
                next();
            });
            $('html,body').animate({ scrollTop: 0 }, 'slow');
        });

    });

});





function buildAdminUrl(module, page, target, source){
    var url = "/admin/"+module;

    if(page == "index"){
        page = "";
    }
    if(page !== ""){
        url = url+"/"+page;
    }
    var parts = [];

    if(target !== ""){
        parts.push("target="+target);
    }
    if(source !== ""){
        parts.push("source="+source);
    }

    var tmp = parts.join("&");

    if(tmp !== ""){
        url = url + "?" + tmp;
    }

    window.history.pushState(url, 'Správa materiálů', url);

}