# URLParser Class
## Description
URLParser class is the Framework router. Its main purpose is to accept as argument an URL, which is provided by the controller, and take whatever action to provide a viable and appropriate usable structure.

## Ideal URL Structure
Given the following schema:  
`http://host/path`  
The ideal path has the following schema:  
`/module/event/parameter1/parameter../parameterN`  

It has to be ponted out that:  
- **module** has always to be passed as first element in the url.  
- **event** can be only one at a time and in any position in the url, even if it's highly recommended to palce it as second element.  
- **Parameters** can be any number.

### Special Situations
URLParser not only assigns module, event and parameters (if any) but also ensures that all the values are valid.  
1. `http://host.com/` - When no values other than the host are passed, URLParser will load the `__DEFAULT__` class as defined in config.php  
2. `http://host.com/nonValidModel/etc..` - In this case URLParser will notice that the model passed doesn't exist and will redirect to `error/404`.  
3. `http://host.com/ /whitespace/etc..` - If there is an attempt to pass white spaces, URLParser will redirect to `error/404`.  

## Constructor: Parameters and Process
###Parameters
1. **$url**, [String], a string representing the current url

###Constructor Process
1. Check if the url provided has any empty space. Empty spaces aren't possible at all. If any empty space is detected, URLParser will redirect to `error/404`. If not empty space is provided we begin to process the url and to extract data.
2. First we assign the Model
3. We then assign Parameters
4. Then we extract event if there's any and we then rebuild the parameters removing the event from the list


##Methods
###Generic
1. **private** *noEmptySpaces*($url)
2. **private** *getPath*($url)
3. **private** *isEvent*($param, $events)

###Setters
1. **private** *setModel*($url)
2. **public** *setEvent*($parameters, $events)
3. **private** *setParameters*($url)

###Getters
1. **public** *getModel*(), return the provided Model
2. **public** *getEvent*(), return the provided Event. If no event was defined, returns *false*.
3. **public** *getParameters*(), return parameters array. If no parameters were defined returns *false*.


##Additional notes
An event is a special string passed as a parameter in the url. It can match a pre-defined value from the **static Event array** present in each module and it's used to distinguish between specific and various situations from the same module.

Here is how the event array is defined in a foo class:  
`public static $events=array("foo","lol","troll", "eureka");`

