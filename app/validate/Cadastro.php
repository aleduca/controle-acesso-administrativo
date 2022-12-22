<?php

namespace app\validate;

use app\models\User;

class Cadastro extends Validate{

    public function validate(){
        $this->required(['name','email','password']);
        $this->email(['email']);
        $this->max(['name'],20);
        $this->unique(['email'], User::class);
    }

}