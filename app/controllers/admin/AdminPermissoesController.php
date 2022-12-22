<?php

namespace app\controllers\admin;

use app\classes\ControllersPermissions;
use app\controllers\ContainerController;
use app\models\admin\Administrador;
use app\models\admin\Permission;

class AdminPermissoesController extends ContainerController {

	public function index() {

	}

	/**
	 * @param $request
	 */
	public function show($request) {

		$administrador = new Administrador;
		$administradorEncontrado = $administrador->find('id', $request->parameter);

		$controllerPermission = new ControllersPermissions;
		$controllers = $controllerPermission->permissions($request->parameter);

		dd($controllers);

		$this->view([
			'title' => 'Lista de permissões',
			'administrador' => $administradorEncontrado,
			'controllers' => $controllers,
		], 'admin.painel.permissoes');

	}

	public function create() {

	}

	public function store() {

	}

	/**
	 * @param $id
	 */
	public function edit($id) {

	}

	/**
	 * @param $id
	 */
	public function update($id) {
		list($method, $controller, $idAdmin) = explode(',', $_POST['data']);

		$permission = new Permission;
		$permissionEncontrada = $permission->findPermission($method, $controller, $idAdmin);

		if (!$permissionEncontrada) {
			$atualizado = $permission->insert([
				'admin' => $idAdmin,
				'controller' => $controller,
				'action' => $method,
			]);
		} else {
			$atualizado = $permission->deletePermission($method, $controller, $idAdmin);
		}

		if ($atualizado) {
			echo 'atualizado';
		}

	}

	/**
	 * @param $id
	 */
	public function destroy($id) {

	}

}
