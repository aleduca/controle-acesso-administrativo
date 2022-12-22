<?php

namespace app\models\admin;

use app\models\Model;

class Administrador extends Model {

	public $logado = 'admin_logado';
	public $data = 'admin_data';
	protected $table = 'administradores';

}