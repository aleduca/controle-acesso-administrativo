<?php

namespace app\traits;

trait PermissionBlock {

	protected function methodInDatabase() {
		$methods = $this->permissionUser()[$this->controllersName()] ?? [];
		return in_array($this->method, $methods);
	}

	protected function inMethodToDie() {
		return in_array($this->method, $this->actionsToDie);
	}

}