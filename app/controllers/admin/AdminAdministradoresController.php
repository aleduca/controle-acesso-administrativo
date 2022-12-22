<?php

namespace app\controllers\admin;

use app\controllers\ContainerController;
use app\models\admin\Administrador;

class AdminAdministradoresController extends ContainerController {

	public function index() {

		$administrador = new Administrador;
		$administradores = $administrador->all();

		$this->view([
			'title' => 'Lista de administradores',
			'administradores' => $administradores,
		], 'admin.painel.administradores');

	}

	public function show() {

	}

	public function create() {

	}

	public function store() {

	}

	public function edit($id) {

		$this->view([
			'title' => 'Atualizar Administrador',
		], 'admin.painel.edit_administrador');
	}

	public function update($id) {
		dd('update');
	}

	public function destroy($id) {
		dd('deletar');
	}

}
