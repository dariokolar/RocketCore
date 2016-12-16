<?php

/*
 * Add-on for TinyRocket 3.0
 * Modul pro správu regionů pro hotely
 * Pracuje společně s modulem hotels
 * 
 */


// INTERFACE
$ModuleName = "Fotogalerie";
$ModuleFolder = "gallery";

$menu->addTop($ModuleFolder, $ModuleName);

// CLASSES
require_once dirname(__FILE__) . '/_gallery.class.php';



// TABLES
//   public function column($name, $type, $length = 11, $notNull = true, $default = false, $key = false, $autoIncrement = false, $fulltext = false){
$mainTable = new table("tbGallery");
$mainTable->column("id", "int", "11", false, false, true, true, false);
$mainTable->column("name", "varchar", "300", true, false, false, false, true);
$mainTable->column("photo", "varchar", "3000");
$mainTable->column("isDel", "int", "2");
$mainTable->column("date", "datetime");
$mainTable->column("isActive", "int", "2");
$mainTable->column("rew", "varchar", "500");

$langTable = new table("tbGalleryPhotos");
$langTable->column("id", "int", "11", false, false, true, true, false);
$langTable->column("source", "int");
$langTable->column("file", "int");
$langTable->column("link", "int");
$langTable->column("ownOrder", "int");
$langTable->column("note", "longtext");
$langTable->column("isDel", "int", "2");