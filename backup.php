<?php

namespace app\classes;

use app\models\admin\Administrador;
use app\models\admin\Permission;
use app\traits\PermissionBlock;

class Permissions {

	use PermissionBlock;

	private $controller;
	private $method;
	private $user;
	private $actionsToDie = [
		'store', 'update', 'destroy',
	];
	private $exclude = [
		'AdminLoginController', 'AdminController', 'AdminBloqueadoController',
	];

	public function __construct($controller, $method) {
		$this->controller = $controller;
		$this->method = $method;
		$this->user = getUser(new Administrador);
	}

	public function permission() {

		if (isset($this->user) and $this->user->master == 1) {
			return;
		}

		$controller = $this->controllersName();

		if (!isset($this->permissionUser()[$controller]) and !in_array($this->controller, $this->exclude)) {
			$this->actionIfBlocked();
		}

		if (!in_array($this->controller, $this->exclude)) {
			$this->actionIfBlocked();
		}

	}

	private function permissionUser() {

		if (!$this->user) {
			return;
		}

		$permission = new Permission;
		$permissionsEncontradas = $permission->userPermissions($this->user->id);

		$controllersAndMethods = [];

		foreach ($permissionsEncontradas as $permission) {
			$controllersAndMethods[$permission->controller][] = $permission->action;
		}

		return $controllersAndMethods;

	}

	private function controllersName() {

		$controller = $this->controller;

		if (strstr($this->controller, 'Admin')) {
			$controller = substr($this->controller, strlen('Admin'), strlen($this->controller));
		}

		return $controller;

	}

	private function actionIfBlocked() {

		if (!$this->methodInDatabase() and $this->inMethodToDie()) {
			$this->blockDie('Sem acesso');
		}

		if (!$this->methodInDatabase() and !$this->inMethodToDie()) {
			return $this->blockRedirect('/adminBloqueado');
		}

	}

    private function methodInDatabase() {
        $methods = $this->permissionUser()[$this->controllersName()] ?? [];
        return in_array($this->method, $methods);
    }

    private function inMethodToDie() {
        return in_array($this->method, $this->actionsToDie);
    }

    private function blockDie($message) {
        throw new NotAccessException($message);
    }

    private function blockRedirect($redirect) {
        return redirect($redirect);
    }

}


<?php

namespace app\traits;

trait PermissionBlock {

    private function methodInDatabase() {
        $methods = $this->permissionUser()[$this->controllersName()] ?? [];
        return in_array($this->method, $methods);
    }

    private function inMethodToDie() {
        return in_array($this->method, $this->actionsToDie);
    }

    private function blockDie($message) {
        throw new NotAccessException($message);
    }

    private function blockRedirect($redirect) {
        return redirect($redirect);
    }
}