<?php

/*
 * Add-on for TinyRocket 3.0
 * Modul pro správu jazykových mutací - slovník
 * 
 * Zkontrolujte oprávnění složky a souborů - zapisuje slovníkové soubory .txt
 * 
 */

// MAIN VAULES
$ModuleCode = "Dictionary v1.2";

// INTERFACE
$ModuleName = "<i class='fa fa-language'></i> Jazykové mutace";
$ModuleFolder = "dictionary";

$menu->addBottom($ModuleFolder, $ModuleName, 3);

// CLASSES


// CLASSES
require_once dirname(__FILE__) . '/_lang.class.php';
require_once dirname(__FILE__) . '/_translation.class.php';


// TABLES
//   public function column($name, $type, $length = 11, $notNull = true, $default = false, $key = false, $autoIncrement = false, $fulltext = false){
$mainTable = new table("tbLangs");
$mainTable->column("id", "int", "11", false, false, true, true, false);
$mainTable->column("name", "varchar", "300", true, false, false, false, true);
$mainTable->column("icon", "varchar", "1000");
$mainTable->column("short", "varchar", "10", true, false, false, false, true);
$mainTable->column("isDel", "int", "2");
$mainTable->column("isActive", "int", "2");
