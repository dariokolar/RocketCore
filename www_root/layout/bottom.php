<br>
<br>
<br>
<div class="main">

<div class="foot">
    <p class="small">
        © 2014 <?php if (date("Y", (strtotime("now"))) != "2014"){ echo " - ".date("Y", (strtotime("now")));};?>
        &nbsp; | &nbsp;
        Release <?php echo $rocket["version"]; ?>
        <?php echo $rocket["bottom"]; ?>
    </p>
</div>
    </div>

<?php trackThisPage(); //toto spouštíme na stránkách které chceme evidovat ve statistikách ?>