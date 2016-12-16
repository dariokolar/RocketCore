<h3>
    <?=$rocket["name"]; ?>
</h3>

<div class="menu">

    <a class="a" href="/">Úvodní stránka</a>
    <a class="a" href="/aktuality">Aktuality</a>
    <a class="a" href="/fotogalerie">Fotogalerie</a>
    <a class="a" href="/akce">Kalendář akcí</a>

    <?php

    $pages = new sql("select * from tbPages where isDel = 0 and isActive = 1");
    foreach ($pages->all() as $p){
        ?>
            <a class="a" href="/<?=$p["rew"]; ?>" title="<?=$p["name"]; ?>"><?=$p["name"]; ?></a>
    <?   }     ?>
</div>
