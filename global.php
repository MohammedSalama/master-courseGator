<?php 


require_once("functions.php");

//variables
$root = __DIR__;
$url = "http://localhost/coursegator/";

//classes
require_once("$root/classes/Request.php");
require_once("$root/classes/Session.php");
require_once("$root/classes/Db.php");




//objects

$request = new Request;
$session = new Session;
$db = new Db("localhost" , "root" , "" , "coursegator");




?>