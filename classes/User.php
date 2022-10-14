<?php

class User {
    private $db, $data, $session_name, $isLoggedIn;

    public function __construct($user=null){
        $this->db = Database::getInstance();
        $this->session_name = Config::get('session.user_session');

        if(!$user){
            if(Session::exists($this->session_name)){
                $user = Session::get($this->session_name);//id

                if($this->find($user)){
                    $this->isLoggedIn = true;
                } else {
                    //logout
                }
                
            }
        }
    }
    public function create($fields = []){
        $this->db->insert('userz', $fields);
    }
    
    public function data(){
        return $this->data;
    }

    public function find($value = null){
        if(is_numeric($value)){
            $this->data = $this->db->get('userz', ['id', '=', $value])->get_first();

        } else {
            $this->data = $this->db->get('userz', ['email', '=', $value])->get_first();

        }
        
        if($this->data){
            return true;
        }
        return false;
    }

    public function isLoggedIn (){
        return  $this->isLoggedIn ;
    }
    public function login($email = null, $password = null){
            if($email){
                $user = $this->find($email);
                if($user){
                    if(password_verify($password, $this->data()->password)){
                        Session::put($this->session_name, $this->data()->id);
                        return true;
                    }
                    // var_dump($u); die;
                    return false;

                }
            }
            return false;
        
    }


}