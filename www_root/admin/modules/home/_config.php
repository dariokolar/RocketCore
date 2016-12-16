<?php

/*
 * USER Control for TinyRocket 3.0
 * 
 * 
 */

// MAIN VAULES
$ModuleCode = "Home";

// INTERFACE
$ModuleName = "Přehledy";
$ModuleFolder = "home";

$menu->addTop($ModuleFolder, $ModuleName,1);

// CLASSES
require_once dirname(__FILE__) . '/_notes.class.php';
require_once dirname(__FILE__) . '/_analytics.class.php';



// TABLES
//   public function column($name, $type, $length = 11, $notNull = true, $default = false, $key = false, $autoIncrement = false, $fulltext = false){
$tb = new table("statsCountries");
$tb->column("id", "int", 11, false, false, true, true, false);
$tb->column("countryName", "varchar", 160, false, false, true);

$tb = new table("statsDevices");
$tb->column("id", "int", 11, false, false, true, true, false);
$tb->column("deviceName", "varchar", 160, false, false, true);

$tb = new table("statsIP");
$tb->column("id", "int", 11, false, false, true, true, false);
$tb->column("ip", "varchar", 24, false, false, true);

$tb = new table("statsPages");
$tb->column("id", "int", 11, false, false, true, true, false);
$tb->column("link", "varchar", 512, false, false, true);

$tb = new table("statsData");
$tb->column("id", "int", 11, false, false, true, true, false);
$tb->column("day", "int", 2, false, false, true);
$tb->column("month", "int", 2, false, false, true);
$tb->column("date", "datetime");
$tb->column("year", "int", 4, false, false, true);
$tb->column("visit", "int", 11, false, false, true);
$tb->column("page", "int", 11, false, false, true);
$tb->column("device", "int", 11, false, false, true);
$tb->column("duration", "int", 11, false, false, true);
$tb->column("country", "int", 11, false, false, true);

