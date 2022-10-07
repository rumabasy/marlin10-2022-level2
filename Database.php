<?php

class Database {
    private static $instance=null;//подключение, показывает запускался ли конструктор на подключение к базе
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
        if(!isset(self::$instance)){    //если не было подключения то запускает конструктор этого класса и делает его        
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function query($sql) {
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $result=$query->fetchAll(PDO::FETCH_OBJ);//FETCH_OBJ потомучто мы используем ООП и мы работаем с объектами класса
        // возвращаем массив из объектов
        return $result ;
    }
    
    
}
