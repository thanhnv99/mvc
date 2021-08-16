<?php

define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

// require(ROOT . 'Config/core.php');
// require(ROOT . 'router.php');
// require(ROOT . 'request.php');
// require(ROOT . 'dispatcher.php');

//Thêm file autoload vào index để tự động load các class
require __DIR__ . './../vendor/autoload.php';

//Thêm class Dispatcher
use mvc\Dispatcher;

//gọi chức năng disptach của class Dispatcher
$dispatch = new Dispatcher();
$dispatch->dispatch();

?>