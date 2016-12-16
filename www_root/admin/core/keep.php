<?php
if (isset($_GET["stats"])){
require_once 'load.php';
echo analytics::realtime();
}else{
    echo "OK";
}