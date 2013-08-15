<?php 

/**
 * Class representing the current URL and returning model, parameters and events given the current model.
 *
 * @author Jacopo Nardiello <jacopo.nardiello@gmail.com>
 * 
 */
class URLParser{

	private $model;
	private $parameters;
	private $realEvent;

	/**
	 * Consutructor for the URL Parser. It defines Parameters, Model and Event for the current URL
	 * @param String $url The current URL
	 */
	public function __construct($url){
		if($this->noEmptySpaces($url)){
			$this->setModel($url);

                        //Note: while parameters internal to the object are setted here, they need to be rebuilt with setEvent() to be considered valid
			$this->setParameters($url);
                        
                         
		}else{
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			header("Location: http://$host$uri/error/404");
			//header("Location: http://localhost/test/URLParser.test.php?error=true;");   -> Line for testing

		}
	}


	private function noEmptySpaces($url){
		$path=explode("/", $this->getPath($url));
		foreach($path as $component){
			if($component==" "){
				return false;
			}
		}
		return true;
	}

	/**
	 * Static function accepting and URL as parameter and returning the parsed equivalent
	 * @param  String $parseThisUrl URL to be parsed
	 * @return Array Array with the parsed URL
	 */
	private function getPath($parseThisUrl){
		$parsedUrl= parse_url($parseThisUrl);
                return $parsedUrl[path];
	}


	/////
	//
	// MODEL CHECKER + SETTER
	// 
	/////
	/**
	 * Setter for the current method provided via URL. If no module is specified, the __DEFAULT__ module will be loaded, as defined in config.php. If a wrong module is provided, 404 is loaded.
	 * @return String Current method provided via URL
	 */
	private function setModel($url){
                $tempClass=explode("/", $this->getPath($url));
		$currentClass = $tempClass[1];

		if(empty($currentClass)){
			$this->model=__DEFAULT__;
		}else{
			if(file_exists("./modules/$currentClass/$currentClass.php")){
				$this->model = $currentClass;
			}else{
				$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                             
				header("Location: http://$host$uri/error/404");
				//header("Location: http://localhost/test/URLParser.test.php?error=true");   -> Line for testing
			}
		}	
	}


	/////
	// 
	// EVENT CHECKER + EVENT SETTER	
	// 
	// /////
	/**
	 * Function finding if a parameters passed via URL is an event for the given class
	 * @param  String  $param  String representing the parameter
	 * @param  Array  $events Array of strings representing events as defined in the current model
	 * @return boolean         Returns true if the param is an event, false otherwise
	 */
	private function isEvent($param, $events){
		foreach($events as $event){
			if($param==$event)
				return true;
		}

		return false;
	}

	/**
	 * This setter takes parameters passed via url and events for the current module class. If any parameter is an event, it is setted and true is returned. Only one event can be setted, the first one. Additional events after the first one are just dropped.
	 * @param Array $parameters Parameters passed via URI
	 * @param Array $events Events array as defined in the current model class    
	 * @return Boolean True if an event is defined and setted, false otherwise
	 */
	public function setEvent($parameters, $events){
		$tempParams = Array();
		$tempEvent = Array();
                if(!empty($parameters)){
                    //Recording Event and rebuilding parameters array
                    foreach($parameters as $param){
                            if($this->isEvent($param, $events)){
                                    array_push($tempEvent, $param);
                            }else{
                                    array_push($tempParams, $param);
                            }
                    }

                    $this->parameters = $tempParams;

                    if(count($tempEvent)>0){
                            $this->realEvent=$tempEvent[0];
                            return true;
                    }else{
                            return false;
                    }
                }else{
                    return false;
                }
	}



	/////
	//
	// PARAMETERS
	// 
	/////
	/**
	 * Setter for all the parameters provided via URL which are not events
	 * @return Array Array containing all the parameters
	 */
	private function setParameters($url){
			$components = explode("/", $this->getPath($url));
			if(count(array_slice($components,2))>0){
				$this->parameters = array_slice($components,2);
				return true;
			}
			return false;
	}



	/////
	//
	// Communication classes [GETTERS]
	// 
	/////
	/**
	 * If $this->parameters has been defined, the method returns it. False otherwise.
	 * @return Array Parameters Array
	 */
	function getParameters(){
		if(isset($this->parameters))
			return $this->parameters;
		else
			return false;
	}

        /**
         * Getter for the event for the current model/URI, if any has been defined. False otherwise.
         * @return String Return string if any event has been defined, false otherwise
         */
	function getEvent(){
		if(!empty($this->realEvent))
			return $this->realEvent;
		else
			return false;
	}

        
        /**
         * Getter model for the current router
         * @return String current model provided by URI
         */
	function getModel(){
			return $this->model;
	}
}

?>