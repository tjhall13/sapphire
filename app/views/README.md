# app/views/
A view directory contains all the relevant templates for each action. An action has a single template of the name `action.html.tpl` in the directory which is rendered by the `action` controller method. Each template has access to local variables defined in the `$args` variable by the controller. Any template for a controller action for a specific resource will have a variable `$resource` available.

## Example
test/  
|--index.html.tpl  
|--show.html.tpl  
|--action.html.tpl  

### index.html.tpl
```
<?php
// Index Template
?>
<html>
	<head>
		<title>Index</title>
	</head>
	<body>
		<ul>
			<?php foreach($resource as $test) { ?>
				<li><?= $test->getID(); ?>: <?= $test->getValue(); ?></li>
			<?php } ?>
		</ul>
	</body>
</html>
```
### show.html.tpl
```
<?php
// Show Template
?>
<html>
	<head>
		<title><?= $resource->getValue(); ?></title>
	</head>
	<body>
		<h1>Showing value for <?= $resource->getID(); ?>.</h1>
		<p>value: <?= $value; ?></p>
	</body>
</html>
```
### action.html.tpl
```
<?php
// Action template
?>
<html>
	<body>
		<h1>Action for <?= $resource->getID(); ?></h1>
	</body>
</html>
```
