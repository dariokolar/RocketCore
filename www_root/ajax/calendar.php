<?php

$month = intval($_POST["month"]);
$year = intval($_POST["year"]);



$monthBefore = $month-1;
if($monthBefore < 1){
    $monthBefore = 12;
    $yearBefore = $year-1;
}else{
    $yearBefore = $year;
}

 


$monthNext = $month+1;
if($monthNext > 12){
    $monthNext = 1;
    $yearNext = $year+1;
}else{
    $yearNext = $year;
}

$tmpMonth = substr("0".$month, -2);

$query = "SELECT * FROM tbAkce where isDel = 0 and datum > '$year-$tmpMonth-01 00:00:00' and datum < '$year-$tmpMonth-".cal_days_in_month(CAL_GREGORIAN, $month, $year)." 23:59:59' ";

$akce = array();

$sql = new sql($query);
foreach ($sql->all() as $a) {
    $misto = "";
    $dateDo = "";
    if($a["datumDo"] != "0000-00-00 00:00:00"){
        $a = " - ".dateformat($a["datumDo"]);
    }
    if(!empty($a["misto"])){
        $misto = ", ".$a["misto"];
    }
    $akce["".dateformat($a["datum"], "j").""] .= "<p><span class=\"date\">".dateformat($a["datum"]).$dateDo.$misto."</span><br />
                        <a href=\"/akce/{$a["rew"]}\"><strong>{$a["title"]}</strong></a></p>";
}



?>
<span class="prevM" onclick="loadKalendar(<?=$monthBefore; ?>, <?=$yearBefore; ?>);"><i class="fa fa-angle-left"></i></span>


<span class="nextM" onclick="loadKalendar(<?=$monthNext; ?>, <?=$yearNext; ?>);"><i class="fa  fa-angle-right"></i></span>


<h4><?=mesicCesky($month, true); ?> <?=$year; ?></h4>

<table>
    <thead>
    <tr>
        <th>Po</th>
        <th>Út</th>
        <th>St</th>
        <th>Čt</th>
        <th>Pá</th>
        <th>So</th>
        <th>Ne</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $startDay = dateformat("$year-$tmpMonth-01 00:00:00", "N");
    $celkemDni = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    $curDay = 1;
    $dayInWeek = 1;

    $started = false;

    while($curDay < $celkemDni){

        if($dayInWeek == 1){
            echo "<tr>";
        }
        if($started == false) {
            if ($dayInWeek == $startDay) {
                $started = true;
            }
        }

        if($started == false) {
            echo "<td></td>";
        }else{
            if(!empty($akce["$curDay"])){
                echo "<td  class=\"active\">
                <a href=\"/akce/?day=$year-$tmpMonth-$curDay\">$curDay</a>
                <div class=\"popup\">
        {$akce["$curDay"]}
                    <span class=\"arrow\"><span></span><span></span></span>
                </div>
    </td>";
            }else{

                echo "<td>$curDay</td>";
            }
            $curDay++;
        }


        if($dayInWeek == 7){
            echo "<tr>";
        }
        $dayInWeek++;
        if($dayInWeek > 7){
            $dayInWeek = 1 ;
        }
    }



    ?>
    </tbody>
</table>