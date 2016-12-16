<?php
session_start();


 setcookie("TinyRocket_LastUser", $zaznam["id"], strtotime( '-1 days' ), '/');






header("Location: {$_SESSION["lastUrl"]}");