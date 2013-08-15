<?php 

abstract class Model{

	
	protected $parameters;
	protected $getParams;
        protected $event;



	function __construct($param, $get, $event){
		
		if(isset($param) && count($param)>0){
			$this->parameters = $param;
		}

		if(isset($get) && count($get)>0){
			$this->getParams = $get;
		}
                
                if(isset($event))
                    $this->event=$event;
	}


	public function getParameters(){
			return $this->parameters;
	}


	public function getGetParameters(){
		return $this->getParams;
	}
        
        
        public function getEvent(){
            return $this->event;
        }


	abstract function getModule();
}


?>