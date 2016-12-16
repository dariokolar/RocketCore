<?php

//
// TinyRocket 4
// Core
//  _____            _        _     _  _   
// |  __ \          | |      | |   | || |  
// | |__) |___   ___| | _____| |_  | || |_
// |  _  // _ \ / __| |/ / _ \ __| |__   _|
// | | \ \ (_) | (__|   <  __/ |_     | |  
// |_|  \_\___/ \___|_|\_\___|\__|    |_|
//
// Build 2016/4/21
//

 $runInstall = true;

// Database (MySQL Access)
$rocket["dbServer"] = 'localhost';
$rocket["dbUser"] = '';
$rocket["dbPass"] = '';
$rocket["dbName"] = '';

// Default sender
$rocket["mail"] = "info@dev.tinyrocket.cz";

// Server
$rocket["name"] = 'Rocket Dev';
$rocket["adminLogo"] = '/admin/img/dev.png';
$rocket["domain"] = 'dev.tinyrocket.cz';

// Rocket
$rocket["versionName"] = "Rocket Core";
$rocket["version"] = "4.1";
$rocket["bottom"] = "&nbsp; | &nbsp; <a href='http://tinyrocket.cz'>TinyRocket</a> by <a href='http://flytown.cz'>FlyTown</a> &nbsp; | &nbsp; PHP ".phpversion()."	";



// Upload options
$rocket["convertPNGtoJPG"] = true;
$rocket["watermarkForFullSize"] = false;
$rocket["watermarkFile"] = dirname(__FILE__) . '/../img/dev.png';
$rocket["fullSize"] = "1248"; //px;
$rocket["mediumSize"] = "512"; //px;
$rocket["smallSize"] = "248"; //px;
$rocket["bigSize"] = "1920"; //px;
$rocket["allowedExtensions"]  = array("gif", "jpeg", "jpg", "png", "pdf", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "zip", "rar", "exe", "srt", "txt");
$rocket["fotoExtensions"] = array("gif", "jpeg", "jpg", "png");

/*
 * Copy optional modules to /modules folder
 */

    