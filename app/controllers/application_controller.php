<?php

namespace App\Controllers;

abstract class ApplicationController {
	abstract public function create();
	abstract public function show();
	abstract public function update();
	abstract public function delete();

	protected $environment;
	protected $resource;
	protected $view;
	protected $args;

	public function __construct($container) {
		$this->environment = $container->environment;
		$this->view = $container->view;
		$this->args = [ ];
	}

	public function __invoke($request, $response, $next) {
		$route = $request->getAttribute('route');
		$params = $request->getAttribute('route')->getArguments();

		if(isset($params['id'])) {
			$this->resource = call_user_func([static::$ResourceClass, 'find'], $params['id']);
		}

		$this->args['resource'] = &$this->resource;

		$next($request, $response);

		$path = static::$ResourceTemplate . '/' . $route->getCallable()[1] . '.html.tpl';
		$this->view->render($response, $path, $this->args);

		return $response;
	}
}
