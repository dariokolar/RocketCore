<?php

/*
 * USER Control for TinyRocket 3.0
 * 
 * 
 */

// MAIN VAULES
$ModuleCode = "Settings 4.0";

// INTERFACE
$ModuleName = '<i class="fa fa-folder-open"></i> Soubory';
$ModuleFolder = "files";

$menu->addBottom($ModuleFolder, $ModuleName, 2);

// CLASSES

/*
 *
 Pozor!
 Správce souborů je nedílnou součástí RocketCore, pro skrytí zakomentujte zobrazení v menu, NEMAŽTE!

 * */



$tb = new table("tbFiles");
$tb->column("id", "int", 11, false, false, true, true, false);
$tb->column("user", "int", 11, false, false, true);
$tb->column("name", "varchar", 250);
$tb->column("link", "varchar", 1000);
$tb->column("extension", "varchar", 8);
$tb->column("size", "varchar", 20);
$tb->column("type", "varchar", 20);
$tb->column("exif", "longtext");
$tb->column("date", "datetime");
$tb->column("hidden", "int", 11, false, false, true);
$tb->column("isDel", "int", 11, false, false, true);