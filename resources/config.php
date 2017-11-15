<?php


session_start();
//session_destroy();
// NB: session_destroy is for debugging purpose, only.

defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

// defining the redirect for the front..
defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates\gfront");

// defining the redirect for the back.. 
defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates\back");




//$connection = new MongoClient();

// connection to database
//$db = $connection->storedb;


require_once("functions.php");

//require_once("cart.php");