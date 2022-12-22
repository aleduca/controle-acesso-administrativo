<?php

namespace app\controllers\admin;

use app\classes\Login;
use app\models\admin\Administrador;
use app\validate\admin\Login as LoginValidate;

class AdminLoginController extends \app\controllers\ContainerController {

	public function store() {

		$loginValidate = new LoginValidate;
		$loginValidate->validate();

		if ($loginValidate->hasErrors()) {
			flash($loginValidate->getErrors(), 'danger');
			return redirect('/admin');
		}

		$login = new Login;
		$logado = $login->login(new Administrador, $loginValidate->sanitized());

		if (!$logado) {
			flash(['erro' => 'Erro ao logar'], 'danger');
			return redirect('/admin');
		}

		return redirect('/painel');
	}

}