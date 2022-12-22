<?php

namespace app\classes;

use app\classes\TypeFlashMessage;

class Flash {

	private $errors;
	private $messages = [];

	public function add($errors, $type) {

		if (!is_array($errors)) {
			throw new \Exception("Passe um array para o método get da classe flash");
		}

		foreach ($errors as $key => $error) {
			$_SESSION[$key]['message'] = $error;
			$_SESSION[$key]['type'] = $type;
		}

	}

	public function get($key) {

		if (!isset($_SESSION[$key])) {
			return;
		}

		if (is_array($_SESSION[$key])) {
			ksort($_SESSION[$key]);
			foreach ($_SESSION[$key] as $type => $message) {
				$this->messages[$key][$type] = $message;
			}
		}

		unset($_SESSION[$key]);

		return $this->showMessage($key);
	}

	private function showMessage($key) {
		if (isset($this->messages[$key]['message'])) {

			if (!is_array($this->messages[$key]['message'])) {
				return $this->typeMessage($this->messages[$key]['message'], $this->messages[$key]['type']);
			}

			foreach ($this->messages[$key]['message'] as $message) {
				$getMessage = $message ?? '';
				return $this->typeMessage($getMessage, $this->messages[$key]['type']);
			}
		}
	}

	private function typeMessage($getMessage, $type) {
		if ($getMessage != '') {
			return TypeFlashMessage::showMessage($getMessage, $type);
		}
	}

}