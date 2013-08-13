<?php 

abstract class Model{

	
	protected $parameters;
	protected $getParams;


	function __construct($param, $get){
		
		if(isset($param) && count($param)>0){
			$this->parameters = $param;
		}

		if(isset($get) && count($get)>0){
			$this->getParams = $get;
		}
	}



	public function getParameters(){
			return $this->parameters;
	}


	public function getGetParameters(){
		return $this->getParams;
	}


	abstract function getModule();
	abstract function getEvent();

}


?>