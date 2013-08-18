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
ini_set('display_errors', '1');
error_reporting(E_ALL ^ E_NOTICE);



/**
 * Launching Session
 */
session_start();



/**
 * Default module name to load when no module is specified via URL
 */
define("__DEFAULT__", "Example");

 ?>