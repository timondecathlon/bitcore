<?php

//Корень проекта там где лежит  global_pass.php
define('PROJECT_ROOT', __DIR__);

//подключаем отображение ошибок
//include_once(PROJECT_ROOT.'/errors.php');

//Формируем URL
$isHttps = !empty($_SERVER['HTTPS']) && 'off' !== strtolower($_SERVER['HTTPS']);
($isHttps) ? $protocol = 'https' : $protocol = 'http';
$parts = explode($_SERVER['HTTP_HOST'],__DIR__);
$folder = array_pop($parts);
define('PROJECT_URL',$protocol.'://'.$_SERVER['HTTP_HOST'].$folder);


define("UPLOAD_DIR",PROJECT_ROOT.'/uploads/');  

echo PROJECT_URL;
echo '<br>';
echo PROJECT_ROOT;
echo '<br>';
echo UPLOAD_DIR;
echo '<br>';


//Записываем пассы в константы
define("DB_HOST", 'localhost');
define("DB_NAME", '');
define("DB_USER", '');
define("DB_PASSWORD", '');


//для использования классов
require_once(PROJECT_ROOT.'/system/classes/autoload.php');

//require_once(PROJECT_ROOT.'/functions/index.php');

//Для процедурки
//$pdo = \Bitkit\Core\Database\Connect::getInstance()->getConnection();