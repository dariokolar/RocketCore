<h3>
    <?=ts("Fotogalerie");?>
</h3>


    <?php  foreach (gallery::all(0,4) as $galerie){   ?>

        <div class="galerie">

            <a href="/galerie/<?=$galerie["rew"]; ?>" title="<?=$galerie["name"]; ?>">
                <div class="coverimg" style="background-image: url(<?=photo($galerie["preview"], "small"); ?>);">

                <div class="inside">
                  <span>
                <?=dateformat($galerie["date"]); ?>
            </span>
                <h4>
                    <?=$galerie["name"]; ?>
                </h4>
</div>
                </div>
            </a>




        </div>

<?php } ?>


<br>
<br>
<h3>
    <?=ts("Kalendář"); ?>
</h3>
<div class="calendar">
    <script>
        loadKalendar(<?=date("n");?>, <?=date("Y");?>);
    </script>
        <span class="calendarThere">

            </span>


</div><!-- /box -->