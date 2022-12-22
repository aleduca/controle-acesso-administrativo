<?php

namespace app\validate;

use app\validate\Sanitize;

abstract class Validate {

	protected $errors = [];

	protected function required($fields) {

		if (!is_array($fields)) {
			throw new Exception("Validação do required deve ser um array");
		}

		if (empty($fields)) {
			foreach ($_POST as $key => $value) {
				if (empty($_POST[$key])) {
					$this->errors[$key][0] = "Esse campo é obrigatório";
				}
			}
			return;
		}

		foreach ($fields as $key => $field) {
			if (empty($_POST[$field])) {
				$this->errors[$field][0] = "Esse campo é obrigatório";
			}
		}
	}

	protected function email($fields) {

		if (!is_array($fields)) {
			throw new Exception("Validação do email deve ser um array");
		}

		foreach ($fields as $key => $field) {
			if (!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {
				$this->errors[$field][1] = "Esse email é inválido";
			}
		}
	}

	protected function max($fields, $length) {
		if (!is_array($fields)) {
			throw new Exception("Validação do max deve ser um array");
		}

		foreach ($fields as $key => $field) {
			if (strlen($_POST[$field]) > $length) {
				$this->errors[$field][2] = "Esse campo pode ter no máximo {$length} caracteres";
			}
		}
	}

	protected function unique($fields, $model) {
		$model = new $model;
		foreach ($fields as $key => $field) {
			if ($model->find($field, $_POST[$field])) {
				$this->errors[$field][0] = 'Ja existe um registro cadastrado para esse campo';
			}
		}
	}

	public function sanitized() {
		return (new Sanitize)->sanitize();
	}

	public function getErrors() {
		return $this->errors;
	}

	public function hasErrors() {
		return !empty($this->errors);
	}

}