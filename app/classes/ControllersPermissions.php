<?php

namespace app\classes;

use app\models\admin\Permission;

class ControllersPermissions {

	/**
	 * @var array
	 */
	private $methods = [
		'index', 'show', 'edit', 'update', 'create', 'store', 'destroy',
	];

	/**
	 * @var array
	 */
	private $exclude = [
		'AdminController.php', 'AdminLoginController.php', 'AdminBloqueadoController.php',
	];

	/**
	 * @var array
	 */
	private $controllersName = [];

	/**
	 * @return mixed
	 */
	private function folderControllers() {
		$files = new \DirectoryIterator('../app/controllers/admin');

		$controllers = [];

		foreach ($files as $file) {
			if (!$file->isDot() and !in_array($file->getFileName(), $this->exclude)) {
				$controllers[] = $file->getFileName();
			}
		}

		return $controllers;
	}

	/**
	 * @return mixed
	 */
	private function controllers() {

		$controllers = $this->folderControllers();

		$controllers = array_map(function ($controller) {
			list($filename, $extension) = explode('.', $controller);

			if (strstr($filename, 'Admin')) {
				return substr($filename, strlen('Admin'), strlen($filename));
			}
			return $filename;
		}, $controllers);

		return $controllers;

	}

	/**
	 * @param  $user
	 * @return mixed
	 */
	public function permissions($user) {

		$controllers = $this->controllers();

		foreach ($controllers as $controller) {
			$this->controllersAndPermissions($controller, $user);
		}

		return $this->controllersName;

	}

	/**
	 * @param $controller
	 * @param $user
	 */
	private function controllersAndPermissions($controller, $user) {
		$permission = new Permission;
		$permissionsEncontradas = $permission->userPermissions($user);

		if (!$permissionsEncontradas) {
			$this->permissionsNotFound($controller);
		} else {
			$this->permissionsFound($permissionsEncontradas, $controller);
		}
	}

	/**
	 * @param $controller
	 */
	private function permissionsNotFound($controller) {
		foreach ($this->methods as $method) {
			if (!isset($this->controllersName[$controller][$method])) {
				$this->controllersName[$controller][$method] = 'danger';
			}
		}
	}

	/**
	 * @param $permissions
	 * @param $controller
	 */
	private function permissionsFound($permissions, $controller) {

		foreach ($permissions as $permission) {
			if ($permission->controller == $controller) {
				$this->controllersName[$controller][$permission->action] = 'success';
			}

			foreach ($this->methods as $method) {
				if (!isset($this->controllersName[$controller][$method])) {
					$this->controllersName[$controller][$method] = 'danger';
				}
			}
		}
	}
}