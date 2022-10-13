<?php

class User {
    private $db;

    public function __construct(){
        $this->db = Database::getInstance();
    }
    public function create($fields = []){
        $this->db->insert('userz', $fields);
    }
    public function login($email = null, $password = null){
        
           }
        }
        return false;
    }
    public function find($email = null){
        
        return false;
    }
    public function data(){
        return $this->data;
    }

}