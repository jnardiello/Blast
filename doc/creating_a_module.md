#Creating a Module

##Module Anatomy
###Structure
A module has a fixed folder tree and rigid naming conventions. Every Module has the following structure:  
`/moduleName` - The root folder. Contains only the main Model Class (modelName.php)  
`/moduleName/events` - SubModels classes. Will be loaded when an event, as defined in the main Model Class, is shot.  
`/moduleName/template` - PHP Templating classes. Essentially HTML code with access to the current view state (fields and methods).  
`/moduleName/view` - All the views for the current Module. Main model Class has its own view, as each event.  

###Consistent Naming  
1. The Main Module Class has to be named exactly as the first module parameter passed via URI  
2. `/events/` has to be named as each event. All events for the current module have to be included in the `events array` inside the Main Module. Es: If an event `event1` is included in the Main Model Class, the `events` folder has to contain `event1.php`.  
3. `/template/` have to be named, as for the events folder, according to the model/events name.
4. `/views/`, each view has to be named `modelOrEventNameView`. Exactly as for templating and events, in addition simply append `View`.

##Roles

###Quick reference to model and view loading

The Controller will get Main Module Name, Events and Parameters. If no event is passed, the controller will load the Main Model Class and related View. If any event is passed, the Controller will load the Event Model Class and Event View.

The Model, once created (keep in mind: it can be both the Main Model or an Event Model), is passed by reference to the view which can access all its public methods.

###Models and Events
####Definition
**The main role of Models (both Main and Events Models) is to provide all the business logic to the views.**

####Models
Models or Main Model Classes are the basic class loaded when no event is provided. It is usually called when a similar URI is passed:  
`http://host/modelName`  

####Events
Models Events are specific tasked models and their role is to define the behaviour of the module in specific cases. For example: While the login model has been passed for Auth of a user, if there is any error we can easily call `http://host/login/bad` returning an error to our user. **Each Event Model/Class is a subClass of the Main Class Model and extends it.**

####Notes
While this difference between Events and Main Models could be easily avoided and all the code could be included in a Model file, this would have significantly increased complexity for future maintainance.  

###Views
####Definition
**Views interrogate Models to get all the required data. Their duty is to format all the data and prepare it for rendering**

####Accessing Models
Views, on creation, gets a reference to the current Model. They can therefore access all the public methods of the current Model.

Code:  
`$appModel->methodName()`  

####Views and Events
When an Event is shot, the Controller wil load the related Model and View. Each Event has a different View Class in charge of prepare for rendering specific event data.

####Templating
Accessing Views public Fields and Methods from the `/template/` can be done using the `$app` keyword.  
How to load a method: `$app->methodName();`  
How to load a field: `$app->fieldName;` 
