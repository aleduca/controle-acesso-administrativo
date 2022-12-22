<?php

namespace app\controllers\portal;

use app\models\User;
use app\validate\Cadastro;

class CadastroController extends \app\controllers\ContainerController{

    public function index(){
        $this->view([
            'titulo'=> 'Cadastro de usuário'
        ],'portal.cadastro');
    }

    public function store(){

        $cadastro = new Cadastro;
        
        $cadastro->validate();

        if($cadastro->hasErrors()){
            flash($cadastro->getErrors());
            return redirect('/cadastro');
        }

        $cadastrado = (new User)->insert($cadastro->sanitized());
        
        if($cadastrado){
            flash(['cadastro' => 'Cadastrado com sucesso !!!']);
            return redirect('/cadastro');
        }

    }
}