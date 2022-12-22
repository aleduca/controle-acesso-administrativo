<?php

namespace core;

use app\classes\Uri;

class Method{

    private $uri;

    public function __construct(){
        $this->uri = Uri::uri();
    }

    public function load($controller){
        $method = $this->getMethod();

        if(!$this->methodExist($controller, $method)){
            throw new \Exception("Método {$method} não existe");
        }

        return $method;
    }

    private function methodExist($controller,$method){
        return \method_exists($controller,$method);
    }

    private function getMethod(){
        if(\substr_count($this->uri, '/') > 1){
            list($controller,$method) = array_values(array_filter(explode('/',$this->uri)));
            return $method;
        }

        return 'index';
    }

}