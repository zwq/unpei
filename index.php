<?php
header("Content-type:text/html;charset=utf-8");
error_reporting(E_ALL & ~(E_STRICT | E_NOTICE));
//error_reporting(0);
//ini_set('display_errors','Off');
//ini_set('error_log', dirname(__FILE__) . '/runtime/front/php_error.log');
// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
//$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
date_default_timezone_set('Asia/Shanghai');

require_once($yii);
$local=require('./protected/config/main-local.php');
$base=require('./protected/config/main.php');
//$sphinx=require('./protected/config/main-sphinx.php');
$config=CMap::mergeArray($base, $local);
//$config = $base;
Yii::createWebApplication($config)->run();