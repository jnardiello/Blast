<?php

/**
 *	Autoloading function for lib/*.class.php
 * 
 *  @author Jacopo Nardiello <jacopo.nardiello@gmail.com>
 *  @param Class $class The class name to be loaded
 */

spl_autoload_register(function ($class) {
    include 'lib/' . $class . '.class.php';
});

?>