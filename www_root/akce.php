<!DOCTYPE html>
<html>
<head>

  <?php

  if(isset($rew)){
      $aktualita = akce::dejByRew($rew);
  }
  if(!empty($aktualita)){
      $meta["title"] = "Rocket - {$aktualita["title"]}";
  }else{
      $meta["title"] = "Rocket - Aktuality";
  }
  $meta["description"] = "";
  $meta["keywords"] = "";
  require_once dirname(__FILE__) . '/layout/head.php';

  ?>

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


        <?php

        if(!empty($aktualita)){
            ?>

            <h3>
                Kalendář akcí
            </h3>


            <div class="content">

                <h1><?=dateformat($aktualita["datum"]); ?>, <?=$aktualita["title"]; ?></h1>
<br>

                <?php if(!empty($aktualita["photo"])){ ?>
                    <a href="<?=$aktualita["photo"]; ?>" class="fancybox">
                        <img src="<?=$aktualita["photo"]; ?>" class="perexImg" alt="" title=""  />
                    </a>

                    <script type="text/javascript">

                        $(".fancybox").fancybox({
                            helpers : {   title: {     type: 'over',position: 'bottom'       }   },
                            padding : 0,
                            beforeShow: function() {
                                $(".fancybox-image").on("click", function() {
                                    $.fancybox.close();
                                });
                            }
                        });

                    </script>


                <? } ?>
                <p class="termin"><strong><?=dateformat($aktualita["datum"]); ?></strong></p>
                <div class="perex">
                    <?=$aktualita["perex"]; ?>
                </div><!-- /perex -->

                <?=$aktualita["text"]; ?>
               <span class="small">
                Datum zveřejnění: <span class="blue"><?=dateformat($aktualita["datum"]); ?></span>, Autor:  <span class="blue"><?=$aktualita["autor"]; ?></span>
</span>

                <!-- /OBSAH -->
            </div><!-- /content -->

            <div class="clear"></div>
            <br>
            <a class="btn" href="/akce">Zpět na všechny akce</a>


            <?php
        }else{
            ?>



            <?php if(isset($_GET["day"])){
                $den = valid($_GET["day"]);
                $sql = " and datum BETWEEN '$den 00:00:00' AND '$den 23:59:59' ";
                $pagerhref = "/akce?day=".$den;
                ?>


                <a class="right btn" href="?probehle">Proběhlé</a>
                <a class="right btn" href="?aktualni">Aktuální</a>
                <a class="right btn active" href="?day=$den"><?=dateformat("$den"); ?></a>
            <? }elseif(isset($_GET["probehle"])){
                $sql = " and datum < NOW() ";
                $pagerhref = "/akce?probehle";
                ?>
                <a class="right btn active" href="?probehle">Proběhlé</a>
                <a class="right btn" href="?aktualni">Aktuální</a>

            <? }else{
                $sql = " and ( datum >= NOW() or  DATE(datum) >= CURDATE()) ";
                $pagerhref = "/akce?aktualni";
                ?>
                <a class="right btn" href="?probehle">Proběhlé</a>
                <a class="right btn active" href="?aktualni">Aktuální</a>


            <?php } ?>

            <h3>
                Kalendář akcí
            </h3>


            <div class="clear"></div>


                <?php



                $queryC = "SELECT count(id) as celkem FROM tbAkce where isDel = 0 $sql order by datum desc";

                $tmp = new sql($queryC);
                $count = $tmp->first();
                $count = $count["celkem"];




                $maxzaznam = 10;
                if(!isset($_GET["page"])){ $_GET["page"] = 1; }
                $page = intval($_GET["page"]);
                $maxpage = ceil($count/$maxzaznam);


                $limit = (($page-1)*$maxzaznam).",".$maxzaznam;


                $query = "SELECT * FROM tbAkce where isDel = 0 $sql order by datum  desc LIMIT $limit";

                $data = new sql($query);
                foreach ($data->all() as $aktualita) {

                    ?>
                    <div class="content aktualita">
                        <div class="col-3">
                            <a href="/akce/<?=$aktualita["rew"]; ?>" title="<?=$aktualita["title"]; ?>">
                                <div class="coverimg" style="background-image: url(<?=photo($aktualita["photo"], "small"); ?>);"></div>
                            </a>
                        </div>
                        <div class="col-9">
                            <h2><?=dateformat($aktualita["datum"]); ?>, <?=$aktualita["title"]; ?></h2>
                            <p>
                                <?=shortText($aktualita["perex"], 100); ?>
                            </p>
                            <a class="a" href="/akce/<?=$aktualita["rew"]; ?>" title="<?=$aktualita["title"]; ?>">Zobrazit více</a>
                        </div>

                        <div class="clear"></div>


                    </div>

                <? } ?>



                <div class="navig">
                    <p>

     <span>
    <?php if($page > 4){ ?>
        <a href="<?=$pagerhref; ?>?page=1">1</a><a href="<?=$pagerhref; ?>?page=2">2</a>
    <? }elseif($page > 3){ ?>
        <a href="<?=$pagerhref; ?>?page=1">1</a>
    <? } ?>
    </span>
    <span>
        <?php
        if($page > 2){
            ?><a href="<?=$pagerhref; ?>?page=<?=$page-2; ?>"><?=$page-2; ?></a><a href="<?=$pagerhref; ?>?page=<?=$page-1; ?>"><?=$page-1; ?></a><?php
        }elseif($page > 1){
            ?><a href="<?=$pagerhref; ?>?page=<?=$page-1; ?>"><?=$page-1; ?></a><?php
        }
        ?><strong><?=$page; ?></strong><?php
        if($page < $maxpage-1){
            ?><a href="<?=$pagerhref; ?>?page=<?=$page+1; ?>"><?=$page+1; ?></a><a href="<?=$pagerhref; ?>?page=<?=$page+2; ?>"><?=$page+2; ?></a><?php
        }elseif($page < $maxpage){
            ?><a href="<?=$pagerhref; ?>?page=<?=$page+1; ?>"><?=$page+1; ?></a><?php
        }
        ?>
    </span>
     <span>
    <?php if($page < $maxpage-3){ ?>
        <a href="<?=$pagerhref; ?>?page=<?=$maxpage-1; ?>"><?=$maxpage-1; ?></a><a href="<?=$pagerhref; ?>?page=<?=$maxpage; ?>"><?=$maxpage; ?></a>
    <? }elseif($page < $maxpage-2){ ?>
        <a href="<?=$pagerhref; ?>?page=<?=$maxpage; ?>"><?=$maxpage; ?></a>
    <? }
    ?>
    </span>
                    </p>
                    <p>

                    </p>
                </div><!-- /navig -->

        <?php } ?>







        <div class="clear"></div>
    </div>

    <div class="right col-3">
        <?php  require_once dirname(__FILE__) . '/layout/right.php'; ?>
    </div>
    <div class="clear"></div>

</div>
<div class="clear"></div>
<div class="main">

    <?php  require_once dirname(__FILE__) . '/layout/bottom.php'; ?>

</div>




</body>
</html>
