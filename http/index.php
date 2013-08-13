<?php 


include_once('config.php');

/**
 * Including the Classes Autoloader Routine
 */
include_once("inc/autoloader.php");



/**
 * Creating the routing core object. This is where all the logic about URL processing happens
 */
$router = new URLparser($_SERVER['REQUEST_URI']);

/**
 * Defining the module to load and relative parameters
 */

$model = $router->getModel;


if(count(URLparser::getParameters($_SERVER['REQUEST_URI']))>0)
	$parameters = URLparser::getParameters($_SERVER['REQUEST_URI']);


/**
 *	Including Classes
 * 
 * classFile checks if a Class for the module (Model) & view exist. If they exist then they are loaded. Otherwise we redirect to 404.
 */
$ModelFile = './modules/'.$model.'/'.$model.'.php';
$ViewFile = './modules/'.$model.'/view/'.$model.'View.php';


if(file_exists($ModelFile) && file_exists($ViewFile)){
	require_once($ModelFile);
	require_once($ViewFile);
}else
	header("Location: http://localhost/404");


/**
 * Creating the model for current state
 * @var Array parameters passed by the router
 */
$modelInstance = new $model($parameters, $_GET);

/**
 *	VIEW
 *
 */
$viewName=$model."View";
$viewInstance = new $viewName($modelInstance);



//Render of the Template
$viewInstance->render();


?>