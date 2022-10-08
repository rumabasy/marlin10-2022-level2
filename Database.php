<?php
function dump($obj, $die=1){
    echo '<pre>';
    var_dump($obj);
    echo '</pre>';
    if($die==1) die;
}
class Database {
    private static $instance=null;//подключение, показывает запускался ли конструктор на подключение к базе
    private $pdo, $query, $error=false, $results, $count;


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
    
    public function count(){
        return $this->count;
    }
    
    public function error(){
        return $this->error;
    }

    public function query($sql, $params=[]) {
        // dump($params);
        $this->error = false;
        $this->query = $this->pdo->prepare($sql);
        if(count($params)){
            $i=1;
            foreach ($params as $par) {
                $this->query->bindValue($i, $par);//встроенная функция 1значит что $params[0]подставляется вместо первого вопроса в запросе
                //с каждым $i связывается свой $par
                $i++;
            }
        }
        if(!$this->query->execute()){
            $this->error = true;
        } else {
            $this->results=$this->query->fetchAll(PDO::FETCH_OBJ);//FETCH_OBJ потомучто мы используем ООП и мы работаем с объектами класса
            $this->count = $this->query->rowCount();//встроенная функция считает число строк в массиве
        }
        return $this ; //так возвращается весь текущий экземпляр объекта, все его параметры
        // возвращаем массив из объектов
    }
    
    public function results(){
        return $this->results;
    }
    
   
}
