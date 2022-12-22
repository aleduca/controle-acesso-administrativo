<?php

namespace app\controllers\portal;

class ProdutoController extends \app\controllers\ContainerController{

    public function show($product){
        
        $this->view([
            'produto' => 'Monitor'
        ],'portal.produtos');

    }

}