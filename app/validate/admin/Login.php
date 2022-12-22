<?php

namespace app\validate\admin;

use app\validate\Validate;

class Login extends Validate {

	public function validate() {
		$this->required([]);
		$this->email(['email']);
	}

}