<?php

class Validation {
    private $passed = false, $errors = [], $db = null;

    public function __construct(){
        $this>db = Database::getInstance();
    }

    public function check($source, $items = []){

    }

    public function addError($error){
        $this->errors[] = $error;
    }
    public function errors($error){
        $this->errors;
    }
    public function passed($error){
        return $this->passed;
    }
}
