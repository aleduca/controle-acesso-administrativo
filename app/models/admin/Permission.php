<?php

namespace app\models\admin;

use app\models\Model;

class Permission extends Model {

	protected $table = 'permission';

	public function userPermissions($user) {
		$sql = "select * from {$this->table} where admin = :admin";
		$select = $this->connection->prepare($sql);
		$select->bindValue('admin', $user);
		$select->execute();

		return $select->fetchAll();
	}

	public function findPermission($method, $controller, $idAdmin) {
		$sql = "select * from {$this->table} where admin=:admin and controller = :controller and action=:action";
		$select = $this->connection->prepare($sql);
		$select->bindValue('admin', $idAdmin);
		$select->bindValue('controller', $controller);
		$select->bindValue('action', $method);
		$select->execute();

		return $select->rowCount();
	}

	public function deletePermission($method, $controller, $idAdmin) {
		$sql = "delete from {$this->table} where admin=:admin and controller=:controller and action=:action";
		$delete = $this->connection->prepare($sql);
		$delete->bindValue('admin', $idAdmin);
		$delete->bindValue('controller', $controller);
		$delete->bindValue('action', $method);

		$delete->execute();

		return $delete->rowCount();
	}

}