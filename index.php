<?php
session_start();
//FRONT CONTROLLER

//general settings
ini_set('display_errors', 0);
error_reporting(E_ALL);


//files connection
define("ROOT", dirname(__FILE__));
require_once(ROOT.'/components/Router.php');

//database connection
require_once (ROOT.'/components/dbConection.php');

//launch Rourer
$obj = new Router();
$obj->run();