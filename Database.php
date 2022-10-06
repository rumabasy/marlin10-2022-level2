<?php

class Database {
    private static $instance=null;
    private $pdo;


    private function __construct() {
        try{
            $this->pdo = new PDO('mysql:host=localhost;dbname=marlin', 'root', '');
//            echo 'Ok';
        } catch (PDOException $exception){
            die($exception->getMessage());
        }    
    }

    public static function getInstance(){
        if(!isset(self::$instance)){            
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function query($sql) {
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $result=$query->fetchAll(PDO::FETCH_OBJ);
        return $result ;
    }
    
    
}
