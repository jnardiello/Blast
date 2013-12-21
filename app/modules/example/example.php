<?php

/**
 * @author Jacopo Nardiello <jacopo.nardiello@gmail.com>
 * 
 */
class Example extends Model{


	/**
	 * Events is an optional array defined within the model class for each module. Wraps exceptions in the current model and makes it possible for the presenter to load the correct (given a collection of templates and classes for the current module) template.
	 * @var array
	 * @access private
	 */
	private static $events = array("es1","es2","es3");

	function __construct($param, $get, $event){
		parent::__construct($param, $get, $event);
	}
 
        /**
	 * Returning events for the current class
	 * @return Array Events array
	 */
	static public function getEvents(){
		return self::$events;
	}

}




?>