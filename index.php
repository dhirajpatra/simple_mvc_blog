<?php
/**
 * This is entry point of all call
 */
define ('DS', DIRECTORY_SEPARATOR);
define ('HOME', dirname(__FILE__));

ini_set ('display_errors', 1);
session_start();

// all main configurations
require_once HOME . DS . 'config.php';
// routing and bootstrapping
require_once HOME . DS . 'utilities' . DS . 'bootstrap.php';

/**
 * This is autoload method to load all require classes when they are not available at use
 * @param $class
 */
function __autoload($class)
{
	if (file_exists(HOME . DS . 'utilities' . DS . strtolower($class) . '.php'))
	{
		require_once HOME . DS . 'utilities' . DS . strtolower($class) . '.php';
	}
	else if (file_exists(HOME . DS . 'models' . DS . strtolower($class) . '.php'))
	{
		require_once HOME . DS . 'models' . DS . strtolower($class) . '.php';
	}
	else if (file_exists(HOME . DS . 'controllers' . DS . strtolower($class) . '.php'))
	{
		require_once HOME . DS . 'controllers'  . DS . strtolower($class) . '.php';
	}
} 