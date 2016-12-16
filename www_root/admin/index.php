<?php


if(isset($_GET["reload"])){
  $mainLoad = true;  
}
require_once dirname(__FILE__).'/core/load.php';


if (isset($_SESSION["loged"]) and ($_SESSION["loged"] == true)){
    $user = user::dejData($_SESSION["id"]);
    $_SESSION["client"] = $user["client"];
}else{
    require  dirname(__FILE__) . '/login.php';
    die;
}

?>
<!DOCTYPE HTML>
<html>
    <head>
	    <meta http-equiv="content-type" content="text/html; charset=utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge" >
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">



        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=latin-ext' rel='stylesheet' type='text/css'>
        <script type='text/javascript' src='https://code.jquery.com/jquery-latest.min.js'></script>


        <meta name="theme-color" content="white">

        <link rel="stylesheet" href="/admin/style/template.css" type="text/css">
        <link rel="stylesheet" href="/admin/style/analytics.css" type="text/css">
        <link rel="stylesheet" href="/admin/style/ckown.css" type="text/css">
	    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	    <title><?php echo $rocket["name"]; ?></title>

	    <link href="/admin/style/font-awesome.min.css" rel="stylesheet" type="text/css">
	
        <link rel="stylesheet" href="/admin/scripts/jquery-ui.css">
        <script src="/admin/scripts/jquery-ui.js"></script>



        <script src="/admin/ckeditor/ckeditor.js"></script>
 
        <script src="/admin/scripts/datepicker-cs.js"></script>
	    <script type='text/javascript' src='/admin/scripts/mainControler.js'></script>
	    <script type='text/javascript' src='/admin/scripts/btnControler.js'></script>
	    <script type='text/javascript' src='/admin/scripts/main-menu.js'></script>

	    <script type='text/javascript' src='/admin/scripts/uploader.js'></script>
	    <script type='text/javascript' src='/admin/scripts/editor.js'></script>
	    <script>      var valid = 0;  </script>
    </head>
<body>
    <div class="top">
	<div class="logo">
	    <a href="/admin" ><img src="<?php echo $rocket["adminLogo"]; ?>" style=" height: 50px;   margin: 25px 0 0 20px;"></a>
    </div>
            <div class="userMin">
                <div class="userPhoto a" style="background-image: url(<?php echo photo($user["photo"], "small", "img/user.png"); ?>)" ></div>
                <div class="userName a"><?php echo $user["name"]; ?></div>
                <div class="user a">
                    <div class="userPhoto a" style="background-image: url(<?php echo photo($user["photo"], "small", "img/user.png"); ?>)" ></div>
                    <div class="userName a"><?php echo $user["name"]; ?></div>
                    <div class="userMail a"><?php echo $user["mail"]; ?></div> 
                   <div class="btns">
                       <div class="mainBtn a" module="moje" data=""><i class="fa fa-user"></i> Můj účet</div>
                       <a href="modules/users/logout.php"><div class="mainBtn a" page="logout" data=""><i class="fa fa-sign-out"></i> Odhlášení</div></a>
                    </div>
                </div>
            </div>
    </div>


    <div class="container">
	<div class="left">
	    <div class="mainMenu">
		<?php    $menu->plot();  ?>
	    </div>
	    
	    <div class="sideMenu">
		<?php    $menu->plotBottom();  ?>
	    </div>
	</div>
	<div class="content a">
        <div class="in">

            <script>
                <?php

                if(empty(valid($_GET["module"]))){
                    $_GET["module"] = "home";
                    $_GET["page"] = "index";
                }
                if(empty(valid($_GET["page"]))){
                    $_GET["page"] = "index";
                }


                ?>

                module = "<?=valid($_GET["module"]); ?>";
                rootName = "<?=$rocket["name"]; ?>";

                $(".mainBtn").each(function(){
                    if ($(this).attr("module") === module){
                        $(this).addClass("active");
                        document.title = rootName+" - "+$(this).html().replace(/<(?:.|\n)*?>/gm, '');
                    }
                });

                $.ajax({type: "POST",
                    url: "/admin/core/pager.php",
                    data: { module: "<?=valid($_GET["module"]); ?>", page: "<?=valid($_GET["page"]); ?>", target: "<?=valid($_GET["target"]); ?>", source: "<?=valid($_GET["source"]); ?>"}
                }).done(function( data ) {
                    buildAdminUrl("<?=valid($_GET["module"]); ?>", "<?=valid($_GET["page"]); ?>", "<?=valid($_GET["target"]); ?>", "<?=valid($_GET["source"]); ?>");
                    $(".content .in").delay(400).queue( function(next){
                        $(this).html(data);
                        $(".content .in").fadeTo(400,1);
                        $(".content").removeClass("loading");
                        next();
                    });

                });


            </script>
        </div>
	</div>
	<div class="clear"></div>
    </div>
	    
    <div class="cover coverFile">
        <div class="oknoFile">
            <div class="close a"><i class="fa fa-times"></i></div>
            <h2><i class="fa fa-folder-open"></i> Správce souborů</h2>
            <div class="in">
            </div>
        </div>
    </div>
	    
    <div class="cover coverAccept">
        <div class="oknoAccept">
            <div class="in">   
            </div>
        </div>
    </div>
	    
    <div class="cover float">
        <div class="oknoNote">
            <div class="in">  
            </div>
        </div>
    </div>
	    

	    
    <div class="bottom">
		© 2014 <?php if (date("Y", (strtotime("now"))) != "2014"){ echo " - ".date("Y", (strtotime("now")));};?> 
		&nbsp; | &nbsp;  
		Release <?php echo $rocket["version"]; ?>
		<?php echo $rocket["bottom"]; ?>
    </div>

</body>
</html>