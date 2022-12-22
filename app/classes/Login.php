<?php

namespace app\classes;

use app\classes\Password;
use app\models\Model;

class Login {

	public function login(Model $model, $data) {

		$userEncontrado = $model->find('email', $data->email);

		if (!$userEncontrado) {
			return false;
		}

		if (Password::verify($data->password, $userEncontrado->password)) {
			$_SESSION[$model->logado] = true;
			$_SESSION[$model->data] = $userEncontrado;
			return true;
		}
		return false;

	}
}