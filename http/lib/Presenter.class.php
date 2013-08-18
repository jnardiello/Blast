<?php 

abstract class Presenter{
	/**
	 * Model reference
	 * @var Prova 
	 */
	protected $model;


	/**
	 * Simply getting a reference to the relative model object
	 * @param Prova $module The model object
	 */
	protected function __construct($module){
		$this->model = $module;
	}



	/**
	 * Render class will decide which template file needs to be loaded according to the current module and event
	 * @return Void simply load the correct template file for the provided event
	 */
	public function render(){

		/**
		 * $app is the current state of the app
		 * @var Model is a reference to Model instance.
		 */
		$app = $this->model;


		if($app->getEvent()){
			$eventFile = './modules/'.$app->getModule().'/template/'.$app->getEvent().'.php';
			if(file_exists($eventFile)){
				require_once($eventFile);
			}else{
				header("Location: http://localhost/error/404");
			}
		}else{

			if(file_exists('./modules/'.$app->getModule().'/template/'.$app->getModule().'.php')){
				require_once('./modules/'.$app->getModule().'/template/'.$app->getModule().'.php');
			}
		}
	
	}
}



?>