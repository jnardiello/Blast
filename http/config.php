<?php

/**
 * MySql connection data
 */

$db = [
	"host" => "localhost",
	"username" => "root",
	"port" => "3306",
	"pwd" => "root"
];


/**
 * Error reporting set-up
 */
error_reporting(E_ALL);



/**
 * Launching Session
 */
session_start();



/**
 * Default module name to load when no module is specified via URL
 */
define("__DEFAULT__", "Prova");

 ?>