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
            404
        </h3>
        <div class="content">



            <h1>404</h1>
            <center>
                Tohle je 404 Rocketu
            </center>
            <br>
            <br>
            <center>
                Stránka <?php echo selfURL(); ?> neexistuje.
            </center>
            <br>
            <br>
        </div>

        <div class="clear"></div>
    </div>

    <div class="right col-3">
        <?php  require_once dirname(__FILE__) . '/layout/right.php'; ?>
    </div>
    <div class="clear"></div>

</div>
<div class="clear"></div>
<div class="main">
    <div class="clear"></div>

    <?php  require_once dirname(__FILE__) . '/layout/bottom.php'; ?>

</div>

</body>
</html>



