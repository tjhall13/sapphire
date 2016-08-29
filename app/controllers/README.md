# app/controllers/
The controller maps each request router action to a controller method. Each request, a new controller is created with the following member variables:
* `$environement` variable holding server environment information
* `$resource` variable holding the relevant resource found by id if the action is after a resource `{id}` in the route
* `$view` a view variable with the render function. (Mostly used interally but can be used to render particular files)
* `$args` a key-value array to hold local variables for the view to access when rendering. `$resource` is automatically added to the `$args` as `resource` before rendering.

The controller must be in the `App\Controllers` namespace and extend `ApplicationController`. This will implement the required interface for the routing to take place. The methods `create`, `show`, `update`, and `delete` are abstract and must be implemented by the controller.

The controller must also have two static variables.
* `$ResourceClass` this is the model class to find resources with.
* `$ResourceTemplate` this is the directory name in `views/` that contains the action templates.

## ApplicationController
The abstract ApplicationController does most of the routing work by initializing the variables, finding the appropriate resource for a `{id}`, and calling the correct template for the action. DO NOT modify without expecting the application to break.

## Example
```
<?php

namespace App\Controllers;

class TestController extends ApplicationController {
	public static $ResourceClass = \App\Models\Test::class;
	public static $ResourceTemplate = 'test';

	public function index() {
		$this->resource = \App\Models\Test::all();
	}
	public function create() {
	}
	public function show() {
		$this->args['value'] = $this->resource->getValue();
	}
	public function action() {
	}
	public function update() {
	}
	public function delete() {
	}
}
```
