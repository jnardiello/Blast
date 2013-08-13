<?php

/**
 * @author Jacopo Nardiello <jacopo.nardiello@gmail.com>
 * 
 */
class Prova extends Model{

	protected $moduleName=__CLASS__;

	/**
	 * Events is an optional array defined within the model class for each module. Wraps exceptions in the current model and makes it possible for the presenter to load the correct (given a collection of templates and classes for the current module) template.
	 * @var array
	 * @access private
	 */
	static public $events = array("sit1","sit2","sit3");

	function __construct($param, $get){
		parent::__construct($param, $get);
	}
 

	/**
	 * Returning events for the current class
	 * @return Array Events array
	 */
	public function getEvents(){
		return $this->events;
	}





	/**
	 * getEvent() checks if there is any given event in the parameters passed via URL
	 * @return String Returns the event if any is found, false otherwise.
	 */
	public function getEvent(){

		
	}


	/**
	 * Return the module(model) loaded for the current URl request
	 * @return String current model name
	 */
	public function getModule(){
		return $this->moduleName;
	}

}




?>