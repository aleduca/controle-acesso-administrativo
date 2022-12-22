<?php

require "../bootstrap.php";

use app\classes\Permissions;
use core\Controller;
use core\Method;
use core\Parameters;

$controllerFound = new Controller;
$controller = $controllerFound->load();

$method = new Method;
$method = $method->load($controller);

$parameters = new Parameters;
$parameters = $parameters->load();

try {

	$controllerReflection = new \ReflectionClass($controller);
	if ($controllerReflection->getNamespaceName() == 'app\controllers\admin') {
		$permission = new Permissions($controllerFound->getController(), $method);
		$permission->permission();
	}

	$controller->$method($parameters);
} catch (\Throwable $e) {
	dd($e->getMessage() . $e->getFile() . $e->getline());
}