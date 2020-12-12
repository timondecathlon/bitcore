<?php


include_once(__DIR__ . '/config.php');      

var_dump(Card::getAllLines());     

$card = new \Bitkit\Core\Entities\Card(2);

var_dump($card->getData()); 
 


