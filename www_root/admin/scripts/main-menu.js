$(document).ready(function(){
var LEFT = $(".left");
$(document).on( 'scroll',  function(){
    if ($(window).scrollTop() < 101){
        LEFT.removeAttr("style");
        LEFT.css("height",(	$(".mainMenu").height() + $(".sideMenu").height() + 38 )+"px");
        return false;
    }

    if ($(window).scrollTop() > $("body").height() - LEFT.height() - 38 ){
        LEFT.removeAttr("style");
        LEFT.css("position","absolute");
        LEFT.css("bottom","0px");
        LEFT.css("height",(	$(".mainMenu").height() + $(".sideMenu").height() + 38 )+"px");
    }else{
        if ($(window).scrollTop() > 100){
            LEFT.removeAttr("style");
            LEFT.css("position","fixed");
            LEFT.css("top","0px");
            LEFT.css("height",(	$(".mainMenu").height() + $(".sideMenu").height() + 38 )+"px");
        }
    }

});
});