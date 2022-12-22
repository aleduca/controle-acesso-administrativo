<?php

namespace core;

use app\classes\Uri;

class Controller {

	private $uri;
	private $namespace;
	private $controller;
	private $folders = [
		'app\controllers\portal', 'app\controllers\admin',
	];

	public function __construct() {
		$this->uri = Uri::uri();
	}

	public function load() {
		if ($this->isHome()) {
			return $this->controllerHome();
		}
		return $this->controllerNotHome();
	}

	private function isHome() {
		return ($this->uri == '/');
	}

	private function controllerHome() {
		if (!$this->controllerExist('HomeController')) {
			throw new \Exception("Controller HomeController não existe");
		}
		return $this->instanciateController();
	}

	private function controllerNotHome() {

		$controller = $this->getControllerNotHome();

		if (!$this->controllerExist($controller)) {
			throw new \Exception("O controller {$controller} não existe");
		}

		return $this->instanciateController();
	}

	private function getControllerNotHome() {
		if (substr_count($this->uri, '/') > 1) {
			list($controller) = array_values(array_filter(explode('/', $this->uri)));
			return ucfirst($controller) . 'Controller';
		}
		return ucfirst(ltrim($this->uri, '/')) . 'Controller';

	}

	private function controllerExist($controller) {
		$controllerExist = false;

		foreach ($this->folders as $folder) {
			if (class_exists($folder . '\\' . $controller)) {
				$controllerExist = true;
				$this->namespace = $folder;
				$this->controller = $controller;
			}
		}

		return $controllerExist;
	}

	private function instanciateController() {
		$controller = $this->namespace . '\\' . $this->controller;
		return new $controller();
	}

	public function getController() {
		return $this->controller;
	}

}