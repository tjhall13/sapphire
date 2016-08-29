# Sapphire
## About
Sapphire is a simple php web appication framework. It is based on Slim for routing and request/response handling. The MVC design is influnced on Ruby on Rails to provide a familiar "out of the box" feel to php applications that RoR enjoys.

## Directory Structure
Below is the files and directories you should be concerned with for basic development.

routes.php  
app/  
|--controllers/  
|--models/  
|--views/

### routes.php
`routes.php` contains the routing information for the application. It will define basepaths that the application will route actions to controller methods.
The application will automatically mount `create`, `show`, `update`, and `delete` controller methods to the `POST /`, `GET /{id}`, `POST /{id}`, and `DELETE /{id}` paths for you.

#### Example
```
<?php

route('/test', 'App\Controllers\TestController', function() {
	$this->get('', 'App\Controllers\TestController:index');
	$this->get('/{id}/action', 'App\Controllers\TestController:action');
});
```
### app/controllers/
`app/contollers/` contains the application controllers. Each will have public methods that map router actions to named methods on the controller action.  
See `app/controllers/README.md`.
### app/models/
`app/models/` contains the application models. These will be used as the resource a controller finds if the action is on a specific `{id}`. A different model is created for each controller.    
See `app/models/README.md`.
### app/views/
`app/views/` contains the application views. These will be used to render controller actions. A differenct directory is created for each controller.  
See `app/views/README.md`.
