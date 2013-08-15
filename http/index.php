<?php 

/**
 * Including basic configuration and autoloading files
 */
include_once('config.php');
include_once("inc/autoloader.php");



/**
 * Creating the routing core object. This is where all the logic about URL processing happens
 */
$router = new URLparser($_SERVER['REQUEST_URI']);
$model= $router->getModel();



/**
 *	Including Classes
 * 
 * classFile checks if a Class for the module (Model) & view exist. If they exist then they are loaded. Otherwise we redirect to 404.
 */

$ModelFile = "./modules/$model/$model.php";
$ViewFile = "./modules/$model/view/".$model."View.php";


require_once($ModelFile);
require_once($ViewFile);



/**
 * 
 * Once model has been extracted, confirmed AND loaded we can set event and parameters. 
 * When the $router has been created a parameters field was created within the object, yet we can't use it.
 * We first need to set the event. The setEvent() method will rebuild the $parameters field excluding the setted event.
 * 
 * Also, we can't call setEvent() and setParameters() before as they require the $model to be identified and correctly loaded.
 * To be more precise: setEvent() calls a static field from the $model class, therefore to work correctly it needs the $model class to be instantiated.
 * 
 */
if($router->setEvent($router->getParameters(), $model::getEvents()))
    $event = $router->getEvent();


if($router->getParameters())
    $parameters = $router->getParameters();



/**
 * Creating the model for current state
 * @var Array parameters passed by the router
 */
$modelInstance = new $model($parameters, $_GET, $event);



/**
 *	VIEW
 *
 */
$viewName=$model."View";
$viewInstance = new $viewName($modelInstance);



//Render of the Template
$viewInstance->render();

?>