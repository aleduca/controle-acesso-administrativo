<?php

namespace app\controllers\admin;

use app\controllers\ContainerController;
use app\models\admin\Administrador;

class PainelController extends ContainerController {

	public function index() {

		$administrador = new Administrador;
		$administradoresEncontrados = $administrador->all();

		$this->view([
			'title' => 'Lista de administradores',
			'administradores' => $administradoresEncontrados,
		], 'admin.painel.administradores');

	}

	public function show() {

	}

	public function create() {

	}

	public function store() {

	}

	public function edit($id) {

	}

	public function update($id) {

	}

	public function destroy($id) {

	}

}
