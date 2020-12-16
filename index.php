<?php

 echo 1000000;    
           


include_once(__DIR__ . '/config.php');      

//var_dump(\Bitkit\Core\Entities\Card::getAllLines());       

$card = new \Bitkit\Core\Entities\Card(2);

var_dump($card->getLine());  

 


