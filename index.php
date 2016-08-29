<?php

require 'vendor/autoload.php';

function __application_autoload($class) {
	$names = explode('\\', $class);

	$paths = [];
	foreach($names as $name) {
		$refs = preg_split('/(?=[A-Z])/', $name, -1, PREG_SPLIT_NO_EMPTY);
		foreach($refs as $i => $ref) {
			$refs[$i] = strtolower($ref);
		}
		$paths[] = implode('_', $refs);
	}

	$filename = array_pop($paths);
	$paths[] = $filename . '.php';

	$pathname = implode('/', $paths);

	require_once($pathname);
}

spl_autoload_register('__application_autoload');

$app = new \Slim\App();

$container = $app->getContainer();
$container['view'] = function($container) {
	return new \Slim\Views\PhpRenderer('app/views/');
};

function route($path, $ControllerClass, $routing = NULL) {
	global $app;
	$container = $app->getContainer();

	$container[$ControllerClass] = function($container) use ($ControllerClass) {
		return new $ControllerClass($container);
	};

	$app->group($path, function() use ($ControllerClass, $routing) {
		$this->post('', $ControllerClass . ':create');

		$this->group('/{id}', function() use ($ControllerClass, $routing) {
			$this->get('', $ControllerClass . ':show');
			$this->post('', $ControllerClass . ':update');
			$this->delete('', $ControllerClass . ':delete');
		});

		if($routing) {
			$closure = $routing->bindTo($this);
			$closure();
		}
	})->add($ControllerClass);
}

include_once('./routes.php');

$app->run();

