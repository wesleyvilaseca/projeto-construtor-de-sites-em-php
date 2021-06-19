<?php
session_start();
require __DIR__."/app/util/util.php";
require __DIR__."/config/config.php";
require __DIR__."/app/core/Core.php";
require __DIR__."/vendor/autoload.php";
//error_reporting(0);

$core = new Core;
$core->run();
