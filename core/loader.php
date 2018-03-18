<?php
defined("DOCROOT") or die("nein");

include CLASSES_PATH."Config.php";
include CLASSES_PATH."Router.php";

$router = Router::instance();
$router->addRoute( new Route( URLROOT, [
    "controller"=>"main",
    "action"=>"index"
] ) );

$router->addRoute( new Route( URLROOT."books", [
    "controller"=>"books",
    "action"=>"index"
] ) );

$router->run();