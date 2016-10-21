<?php

$app = 'app';
$verdor = 'vendor';
$storage = 'storage';
define('EXT', '.php');
error_reporting(E_ALL | E_STRICT);
define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);
if (!is_dir($app) AND is_dir(DOCROOT.$app))
	$app = DOCROOT.$app;
if (!is_dir($verdor) AND is_dir(DOCROOT.$verdor))
	$verdor = DOCROOT.$verdor;
if (!is_dir($storage) AND is_dir(DOCROOT.$storage))
	$storage = DOCROOT.$storage;
define('APPPATH', realpath($app).DIRECTORY_SEPARATOR);
define('VENDORPATH', realpath($verdor).DIRECTORY_SEPARATOR);
define('STORAGEPATH', realpath($storage).DIRECTORY_SEPARATOR);
// Clean up the configuration vars
unset($app, $verdor,$storage);
/**
 * Define the start time of the application, used for profiling.
 */
if (!defined('J2TEAM_START_TIME')) {
	define('J2TEAM_START_TIME', microtime(TRUE));
}
/**
 * Define the memory usage at the start of the application, used for profiling.
 */
if (!defined('J2TEAM_START_MEMORY')){
	define('J2TEAM_START_MEMORY', memory_get_usage());
}
require APPPATH . 'bootstrap' . EXT;

$app->run();
