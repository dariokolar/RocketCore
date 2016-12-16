<!DOCTYPE html>
<html>
<head>

  <?php
  $meta["title"] = "RocketEdit";
  $meta["description"] = "";
  $meta["keywords"] = "";
  require_once dirname(__FILE__) . '/layout/head.php'; ?>


</head>
<body>

<div class="main">


    <?php  require_once dirname(__FILE__) . '/layout/top.php'; ?>

</div>
<div class="main">
    <div class="left col-2">


        <?php  require_once dirname(__FILE__) . '/layout/left.php'; ?>
    </div>

    <div class="center col-7">

        <h3>
              Úvodní stránka
        </h3>
        <div class="content">

            <h1>Rocket Core</h1>
            <center>
                Vítejte na úvodní stránce webu spravovaného pomocí TinyRocket
            </center>



            <center><br>Informace najdete na help.tinyrocket.cz<br></center>




        </div>


        <div class="clear"></div>
        <a class="btn right" href="/aktuality">Zobrazit všechny</a>
        <h3>
          Aktuality</h3>


            <?php $aktuality = new sql("select * from tbAktuality where isDel = 0 order by datum desc limit 0,3");
            foreach ($aktuality->all() as $aktualita){
                ?>



        <div class="content aktualita">
<div class="col-3">
    <a href="/aktuality/<?=$aktualita["rew"]; ?>" title="<?=$aktualita["title"]; ?>">
        <div class="coverimg" style="background-image: url(<?=photo($aktualita["photo"], "small"); ?>);"></div>
        </a>
</div>
<div class="col-9">
    <h2><?=$aktualita["title"]; ?></h2>
    <p>
        <?=shortText($aktualita["perex"], 100); ?>
    </p>
    <a class="a" href="/aktuality/<?=$aktualita["rew"]; ?>" title="<?=$aktualita["title"]; ?>">Zobrazit více</a>
</div>

            <div class="clear"></div>


        </div>
            <?   }     ?>


        <div class="clear"></div>
    </div>

    <div class="right col-3">
        <?php  require_once dirname(__FILE__) . '/layout/right.php'; ?>
    </div>
    <div class="clear"></div>

    </div>

<div class="clear"></div>


    <?php  require_once dirname(__FILE__) . '/layout/bottom.php'; ?>



</body>
</html>
