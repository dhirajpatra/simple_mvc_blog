<?php
/**
 * bootstrapping process and routing as well
 */
$controller = "index";
$action = "index";
$query = null;

// when call from apache with virtual host
if (isset($_GET['load']))
{
	$params = array();
	$params = explode("/", $_GET['load']);

	$controller = ucwords($params[0]);
	
	if (isset($params[1]) && !empty($params[1]))
	{
		$action = $params[1];
	}
	
	if (isset($params[2]) && !empty($params[2]))
	{
		$query = $params[2];
	}

} else {
	// Grabs the URI and breaks it apart
	$requestUri = str_replace($_SERVER['HTTP_HOST'], '', $_SERVER['REQUEST_URI']);

    if ($requestUri != '' && $requestUri != '/') {
        $params = array();
        $params = explode("/", $requestUri);
        //print_r($params); exit;
        $controller = $params[2] != '' ? ucwords($params[2]) : 'index';

        if (isset($params[3]) && !empty($params[3]))
        {
            $action = $params[3];
        }

        if (isset($params[4]) && !empty($params[4]))
        {
            $query = $params[4];
        }
    }
	
}

// loading required controller and model
$modelName = $controller;
$controller .= 'Controller';
$load = new $controller($modelName, $action);

if (method_exists($load, $action))
{ 
    $load->{$action}($query);
}
else 
{
	die('Invalid method. Please check the URL.');
}