#Index Main Controller

## Description
Blast has only one main controller: **index.php**.  
  
The main purpose of the controller is to coordinate:  
1. URLParser class in order to *build a valid URI structure*  
2. To *instantiate the Model Class* which defines the whole behaviour of the current module  
3. To *instantiate the View Class*  
4. *Render the view* passing the Model Object as parameter

###Notes: 
Model Class and View Class are both dynamically loaded using the URL parameters.  


##Variable Definitions
The controller will first define variables:  
1. `$model`  
2. `$event`  
3. `$parameters`  
It is critical that variables are defined in this specific order as `$model` is necessary to properly load the relevant classes, `$event` has to be shooted second as it will compare `$events` from the model class (static) and the current parameters which were built by the URLParser constructor and *then* **will rebuild the internal $parameters field within the URLParser** taking into account assigned events.  

##Objects definitions
We then create an instance of the model  

`$modelInstance = new $model($parameters, $_GET, $event);`
  
Then we build up the view passing a reference to the object as a parameter  

`$viewInstance = new $viewName($modelInstance);`  

Then we render everything
  
`$viewInstance->render();`