<?php


if(!isset($runInstall)){
    header("Location: /admin");
    die;
}

if(isset($_POST["install"])){

    unset($runInstall);
    $out = "<?php

//
// TinyRocket 4
// Core
//  _____            _        _     _  _   
// |  __ \          | |      | |   | || |  
// | |__) |___   ___| | _____| |_  | || |_
// |  _  // _ \ / __| |/ / _ \ __| |__   _|
// | | \ \ (_) | (__|   <  __/ |_     | |  
// |_|  \_\___/ \___|_|\_\___|\__|    |_|
//
// Build 2016/4/21
//

// \$runInstall = true; 

// Database (MySQL Access)
\$rocket[\"dbServer\"] = '{$_POST["dbServer"]}';
\$rocket[\"dbUser\"] = '{$_POST["dbUser"]}';
\$rocket[\"dbPass\"] = '{$_POST["dbPass"]}';
\$rocket[\"dbName\"] = '{$_POST["dbName"]}';

// Default sender
\$rocket[\"mail\"] = \"{$_POST["defmail"]}\";

// Server
\$rocket[\"name\"] = '{$_POST["name"]}';
\$rocket[\"adminLogo\"] = '/admin/img/logo.png';
\$rocket[\"domain\"] = '{$_POST["domain"]}';

// Rocket
\$rocket[\"versionName\"] = \"Rocket Core\";
\$rocket[\"version\"] = \"4.0\";
\$rocket[\"bottom\"] = \"&nbsp; | &nbsp; <a href='http://tinyrocket.cz'>TinyRocket</a> by <a href='http://flytown.cz'>FlyTown</a> &nbsp; | &nbsp; PHP \".phpversion().\"	\";


// Upload options
\$rocket[\"convertPNGtoJPG\"] = {$_POST["convertPNGtoJPG"]};
\$rocket[\"watermarkForFullSize\"] = {$_POST["watermarkForFullSize"]};
\$rocket[\"watermarkFile\"] = dirname(__FILE__) . '/../img/dev.png';
\$rocket[\"fullSize\"] = \"{$_POST["fullSize"]}\"; //px;
\$rocket[\"mediumSize\"] = \"{$_POST["mediumSize"]}\"; //px;
\$rocket[\"smallSize\"] = \"{$_POST["smallSize"]}\"; //px;
\$rocket[\"bigSize\"] = \"{$_POST["bigSize"]}\"; //px;
\$rocket[\"allowedExtensions\"]  = array({$_POST["allowedExtensions"]});
\$rocket[\"fotoExtensions\"] = array(\"gif\", \"jpeg\", \"jpg\", \"png\");

/*
 * Copy optional modules to /modules folder
 */

    ";

    file_put_contents( dirname(__FILE__) ."/core/config.php" , $out);

    $mainLoad = true;

    sleep(1);

    $rocket["dbServer"] = $_POST["dbServer"];
    $rocket["dbUser"] = $_POST["dbUser"];
    $rocket["dbPass"] = $_POST["dbPass"];
    $rocket["dbName"] = $_POST["dbName"];


    require_once dirname(__FILE__) . '/core/support.php';
    require_once dirname(__FILE__) . '/core/table.php';
    require_once dirname(__FILE__) . '/core/sql.php';


    $link = mysqli_connect($rocket["dbServer"],$rocket["dbUser"],$rocket["dbPass"]) or die ('Nelze se pripojit k databazi, zkontrolujte soubor config.php');
    mysqli_select_db($link, $rocket["dbName"]) or die ('Nelze vybrat databazi, kontaktujte vašeho správce webu');
    mysqli_query($link, "SET NAMES utf8");

    require_once dirname(__FILE__) . '/core/files.php';
    require_once dirname(__FILE__) . '/core/fileupload.php';
    require_once dirname(__FILE__) . '/core/form.php';
    require_once dirname(__FILE__) . '/core/interface.php';
    require_once dirname(__FILE__) . '/core/support.php';
    require_once dirname(__FILE__) . '/core/rewrite.php';
    require_once dirname(__FILE__) . '/core/youtubeAPI.php';
    require_once dirname(__FILE__) . '/core/alert.php';

    $menu = new menu();

    if ($mainLoad){
        $out = "<?php ";
        $dir = dirname(__FILE__).'/modules';
        $cdir = scandir($dir);
        foreach ($cdir as $key => $value){


            if (!in_array($value,array(".","..",".DS_Store"))){

                if (file_exists($dir . DIRECTORY_SEPARATOR . $value. DIRECTORY_SEPARATOR . "_config.php")) {
                    require_once $dir . DIRECTORY_SEPARATOR . $value. DIRECTORY_SEPARATOR . "_config.php";

                    $out .= "  require_once \"".$dir . DIRECTORY_SEPARATOR . $value. DIRECTORY_SEPARATOR . "_config.php\";
			  ";

                }
            }

        }
        file_put_contents( dirname(__FILE__) ."/core/_temp.php" , $out." ?>");
    }else{
        require_once "_temp.php";
    }



    echo $_POST["pass"];
    $pass = user::hashPass($_POST["pass"]);
    $mail = valid($_POST["mail"]);

                $mail = trim(strtolower($mail));

    $query = "INSERT  into tbUsers SET mail = '$mail',
                                      pass='$pass',
                                      name='$mail',
                                      photo='',
                                      last=NOW(),
                                      created=NOW(),
                                      ip='".dejIP()."',
                                      isAdmin='1',
                                      isActive='1',
                                      isDel=0  ;";

    new sql($query);



    new alert("green", "Hotovo! Rocket je nainstalován a Vy se můžete poprvé přihlásit do administrace");

    header("Location: /admin");

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
    <link rel="stylesheet" href="/admin/style/editor.css" type="text/css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <title>Rocket - Instalace</title>

    <link href="/admin/style/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="/admin/scripts/jquery-ui.css">
    <script src="/admin/scripts/jquery-ui.min.js"></script>
</head>
<body style="display: flex; align-items: center; ">


    <div class="login" style="width: 650px; margin: 80px auto;">
        
        <div class="in" style='padding: 10px;'>

            <img class="logo" src="/admin/img/logo.png" height="50px">

<style>
    label {padding: 0 0 5px 0; display: block;}
    p {padding: 0 0 5px 0; display: block; font-size: 10pt !important; text-align: justify;}
    input:-webkit-autofill {
        color: #fff !important;
    }
</style>

            <?php
                $hrs = date("H");
                if ($hrs > 4)
                    $msg = "Dobré ráno";
                if ($hrs > 9)
                    $msg = "Dobrý den";
                if ($hrs > 17)
                    $msg = "Dobrý večer";
                echo "<h1 style='text-align: left; margin: 0 0 10px 0;font-weight: 200;font-size: 18pt;'>$msg.</h1>";
                ?>
            <p>
                Jsme rádi že jste si vybrali Rocket, zkopírovali všechny soubory do výchozího adresáře Vašeho webu a nastavili jim oprávnění na 777. Nyní vytvořte prvního uživatele, vyplňte přístupy k databázi, případně upravte pokročilé možnosti nastavení.
            </p>
            <form  method="post" class="loginForm" action="/admin/">
                <input type="hidden" name="install">
                <h2 style="text-align: left; font-weight: 200;">Přihlašovací údaje</h2>
                <div style="float:left; width: 50%;text-align: left; padding: 0 10px 0 0;">
                    <label>E-mail</label>
                    <input type="text" autocomplete="off" class="a" placeholder="E-mail" name="mail" required>
                </div>
                <div style="float:left; width: 50%;text-align: left; padding: 0 0 0 0;">
                    <label>Heslo</label>
                    <input type="password" autocomplete="off"  class="a" placeholder="Heslo" name="pass" required>
                </div>
                <div class="clear"></div>


                <h2 style="text-align: left; font-weight: 200;">Přístup k databázi</h2>
                <div style="float:left; width: 25%;text-align: left; padding: 0 10px 0 0;">
                    <label>Server</label>
                    <input type="text" autocomplete="off" class="a" placeholder="" name="dbServer" value="localhost" required>
                </div>
                <div style="float:left; width: 25%;text-align: left; padding: 0 10px 0 0;" required>
                    <label>Uživatel</label>
                    <input type="text" autocomplete="off" class="a" placeholder="" name="dbUser" value="<?=$rocket["dbUser"]; ?>" onfocusout="$('#dbName').val($(this).val()+'_db');">
                </div>
                <div style="float:left; width: 25%;text-align: left; padding: 0 10px 0 0;" required>
                    <label>Heslo</label>
                    <input type="password" autocomplete="off" class="a" placeholder="" name="dbPass" value="<?=$rocket["dbPass"]; ?>">
                </div>
                <div style="float:left; width: 25%;text-align: left; padding: 0 0 0 0;" required>
                    <label>Databáze</label>
                    <input type="text" autocomplete="off"  class="a" placeholder="" name="dbName" id="dbName" value="<?=$rocket["dbName"]; ?>">
                </div>
                <div class="clear"></div>

                <h2 style="text-align: left; font-weight: 200;">Informace o webu</h2>
                <div style="float:left; width: 33.33%;text-align: left; padding: 0 10px 0 0;">
                    <label>Název webu</label>
                    <input type="text" autocomplete="off" class="a" placeholder="" name="name" required>
                </div>
                <div style="float:left; width: 33.33%;text-align: left; padding: 0 10px 0 0;">
                    <label>Doména</label>
                    <input type="text"  autocomplete="off" class="a" placeholder="bez http://" name="domain" value="<?php echo $_SERVER['SERVER_NAME']; ?>" required>
                </div>
                <div style="float:left; width: 33.33%;text-align: left; padding: 0 0 0 0;">
                    <label>Výchozí odesílatel</label>
                    <input type="text" autocomplete="off"  class="a" placeholder="" name="defmail" value="info@<?php echo $_SERVER['SERVER_NAME']; ?>" required>
                </div>
                <div class="clear"></div>

                <br>
                <span
                    style="color:grey; padding: 10px; cursor:pointer;"
                    onclick="if($('.more-option').height() == 0){ $(this).html('Skrýt pokročilé možnosti'); $('.more-option').css('height','350px'); }else{ $(this).html('Zobrazit pokročilé možnosti'); $('.more-option').css('height','0px'); } ">Zobrazit pokročilé možnosti</span>
                <div class="more-option a" style="height:0px; margin: 0 -10px; padding: 10px; overflow: hidden;">
                    <h2 style="text-align: left; font-weight: 200;">Pokročilé možnosti</h2>

                    <div style="float:left; width: 50%;text-align: left; padding: 0 10px 0 0;">
                        <label>Nalezené moduly:</label>
                    </div>
                    <div style="opacity: 0.3;float:left; width: 50%;text-align: left; padding: 0 10px 0 0;">
                        Další moduly najdete na <a href="install.tinyrocket.cz">webu TinyRocket</a>
                    </div>

                    <div style="float:left; width: 100%;text-align: left; padding: 0 10px 0 0;">

                        <?php

                        $dir = dirname(__FILE__).'/modules';
                        $cdir = scandir($dir);
                        foreach ($cdir as $key => $value) {

                            if (!in_array($value, array(".", ".."))) {

                                if (file_exists($dir . DIRECTORY_SEPARATOR . $value . DIRECTORY_SEPARATOR . "_config.php")) {

                                    echo "<div style='float:left; background:whitesmoke; border-radius: 2px; margin: 0 10px 10px 0; padding: 8px 10px;'>$value</div>";

                                }
                            }
                        }

                        ?> <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                    <div style="float:left; width: 50%;text-align: left; padding: 0 10px 0 0;">
                        <label>Převádět PNG na JPG</label>
                        <select name="convertPNGtoJPG" style="-webkit-appearance: none;">
                            <option value="true" selected>Ano</option>
                            <option value="false">Ne</option>
                        </select>
                    </div>
                    <div style="float:left; width: 50%;text-align: left; padding: 0 0 10px 0;">
                        <label>Přidávat vodoznak</label>
                        <select name="watermarkForFullSize" style="-webkit-appearance: none;">
                            <option value="true">Ano</option>
                            <option value="false" selected>Ne</option>
                        </select>
                    </div>

                    <div class="clear"></div>
                    <div style="float:left; width: 25%;text-align: left; padding: 0 10px 0 0;">
                        <label>Nejmenší obrázek (px)</label>
                        <input type="text" class="a" placeholder="" name="smallSize" value="248" required>
                    </div>
                    <div style="float:left; width: 25%;text-align: left; padding: 0 10px 0 0;">
                        <label>Střední obrázek (px)</label>
                        <input type="text" class="a" placeholder="" name="mediumSize" value="512" required>
                    </div>
                    <div style="float:left; width: 25%;text-align: left; padding: 0 10px 0 0;">
                        <label>Velký obrázek (px)</label>
                        <input type="text"  class="a" placeholder="" name="fullSize" value="1248" required>
                    </div>
                    <div style="float:left; width: 25%;text-align: left; padding: 0 0 0 0;">
                        <label>Největší obrázek (px)</label>
                        <input type="text"  class="a" placeholder="" name="bigSize" value="1920" required>
                    </div>
                    <div class="clear"></div>
                    <div style="float:left; width: 100%;text-align: left; padding: 0 0 0 0;">
                        <label>Povolené typy souborů (px)</label>
                        <input type="text" required class="a" placeholder='"txt", "jpg", ...' name="allowedExtensions" value='"gif", "jpeg", "jpg", "png", "pdf", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "zip", "rar", "exe", "srt", "txt"'>
                    </div>
                </div>

                <br>
                <cetner><input  type="submit" class="a btn" value="Dokončit nastavení"></cetner>
            </form>

            
             <div class="clear"></div>



        </div>
   
        <script>
            if ($.browser.webkit) {
                $('input[name="password"]').attr('autocomplete', 'off');
            }
        </script>
    </div>
</body>
</html>