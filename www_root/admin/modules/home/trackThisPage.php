<?php
session_start();

require_once dirname(__FILE__) . '/../../core/load.php';


$page = intval($_POST["page"]);
$device = intval($_POST["device"]);
$country = intval($_POST["country"]);
$visit = intval($_POST["visit"]);


/*
$page = analytics::trackUrl($url);
$device = analytics::trackDevice($_POST["device"]);
//$device = $url = mysql_real_escape_string(strip_tags($_POST["device"]));
$country = analytics::trackCountry();
 * 
 */


analytics::track($visit, $page, $device, $country, $visit);

new sql("DELETE FROM statsData where  date < ( NOW( ) - INTERVAL 30  MONTH ");


?>

