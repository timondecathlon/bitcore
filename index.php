<?php


ini_set('error_reporting', E_ALL);  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);  

 echo 1000000;    
           


include_once(__DIR__ . '/config.php');      

//var_dump(\Bitkit\Core\Entities\Card::getAllLines());       

$card = new \Bitkit\Core\Entities\Card(2);

//var_dump($card->getLine());  

$factory = new \Bitkit\Core\Patterns\Factory();

$posts = $factory::createClass('core_cards'); 


var_dump($posts::getAllLines()); 


