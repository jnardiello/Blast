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
            if(!empty($this->event))
                return $this->event;
            else
                return false;
        }


        /**
         * 
         * There are 2 different possible situations. The first case occurs when no events are setted. In this case the $events array is not defined (or is empty) and the method getEvents() doesn't exist.
         * In this particular case, as the $this->getModel is used to find from which folder to load view and model, the current class name has to be returned.
         * 
         * In case an event is defined and occurs, the parent (main model name) class name is the correct one to return, or the loading path in Presenter.class.php will be broken and won't find the needed files.
         * 
         * 
         * Ci sono due casi, il primo in cui non ho settati eventi (Array vuoto, oppure metodo getEvents() non definito. 
         * In questo caso torno la classe corrente - che è il modello, verrà poi usato per trovare la cartella dei file. Il secondo caso, in cui ho un evento. 
         * Se ho un evento la classe evento estende la classe modello, se la ritorno il modello si rompe! Devo quindi tornare il parent
         * 
         */
        function getModule(){
            if(!$this->getEvent())
                return get_class($this);
            else
                return get_parent_class($this);
        }
        
}


?>