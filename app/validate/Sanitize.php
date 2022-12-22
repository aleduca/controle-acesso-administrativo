<?php

namespace app\validate;

class Sanitize{

    protected $sanitized = [];

    public function sanitize(){
    
        $posts = $_POST;

        foreach ($posts as $name => $value) {
            $this->sanitized[$name] = filter_var($_POST[$name],FILTER_SANITIZE_STRING);
        }

        return (object)$this->sanitized;

    }

}