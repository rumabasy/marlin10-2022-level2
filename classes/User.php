<?php

class User {
    private $db, $data, $session_name, $isLoggedIn;

    public function __construct($user=null){
        $this->db = Database::getInstance();
        $this->session_name = Config::get('session.user_session');
        // exit;
        if(!$user){
            if(Session::exists($this->session_name)){
                $user = Session::get($this->session_name);//id

                if($this->find($user)){
                    $this->isLoggedIn = true;
                } else {
                    //logout
                }
                
            }
        } else {
            $this->find($user);
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
    public function login($email = null, $password = null, $remember = false){
        if(!$email && !$password && $this->exists()){
            Session::put($this->session_name, $this->data()->id);
        } else {
                $user = $this->find($email);

                if($user){
                    if(password_verify($password, $this->data()->password)){
                        Session::put($this->session_name, $this->data()->id);

                        if($remember){
                            $hash = hash('sha256', uniqid());
                            $hashCheck = $this->db->get('user_sessions', ['user_id','=', $this->data()->id]);

                            if(!$hashCheck->count()){
                                $this->db->insert('user_sessions', [
                                    'user_id' => $this->data()->id,
                                    'hash' => $hash
                                ]);
                            } else {
                                $hash = $hashCheck->get_first()->hash;
                            }

                            Cookie::put($this->cookieName, $hash, Config::get('cookie.cookie_expiry'));
                        }
                        return true;
                    }
                    // var_dump($u); die;
                    return false;

                }
            }
            return false;
        
    }

    public function logout(){
           return Session::delete($this->session_name);            
    }


}