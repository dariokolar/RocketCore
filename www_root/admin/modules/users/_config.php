<?php

/*
 * USER Control for TinyRocket 3.0
 * MODULE
 * 
 */

// MAIN VAULES
$ModuleCode = "USER CONTROLER 3.0";

// INTERFACE
$ModuleName = "Uživatelé";
$ModuleFolder = "users";

$menu->addTop($ModuleFolder, $ModuleName);

// CLASSES
require_once dirname(__FILE__) . '/_user.class.php';

// TABLES

/**tbUsers**/
$tbUsers = new table("tbUsers");
$tbUsers->column("id", "int", 11, false, false, true, true, false);
$tbUsers->column("mail", "varchar", 160);
$tbUsers->column("pass", "varchar", 60);
$tbUsers->column("isAdmin", "int", 1);
$tbUsers->column("isActive", "int", 1);
$tbUsers->column("isDel", "int", 1);
$tbUsers->column("name", "varchar", 240);
$tbUsers->column("photo", "varchar", 1500);
$tbUsers->column("created", "datetime");
$tbUsers->column("last", "datetime");
$tbUsers->column("ip", "varchar", 20);
$tbUsers->column("note", "varchar", 480);
