<?php
//require_once 'Config.php';
function dump($obj, $die=1){
    echo '<pre>';
    var_dump($obj);
    echo '</pre><br>';
    if($die==1) die;
}
class Database {
    private static $instance=null;//подключение, показывает запускался ли конструктор на подключение к базе
    private $pdo, $query, $error=false, $results, $count;


    private function __construct() {
        try{
            $this->pdo = new PDO('mysql:host='.Config::get('mysql.host').';dbname='.Config::get('mysql.database'),Config::get('mysql.username'), Config::get('mysql.password'));
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
    
    public function action0($action, $table, $where = []){
        if (count($where)===3){
            $opers=['=','>','<','>=','<='];
            $value=$where[2];
            $oper=$where[1];
            $field=$where[0];
            if(in_array($oper,$opers)){
                $sql = "{$action} FROM {$table} WHERE {$field} {$oper} ?";
                dump($sql);
                if(!$this->query($sql, [$value])->error()){
                    return $this;
                    return "{$action} {$value} ok";
                } else  return "{$action} not happend";
            }

        }
    }


    public function count(){
        return $this->count;
    }
    
    public function error(){
        return $this->error;
    }

    public function action($action,$table, $where=[]){
        if(count($where)===3){
            $operators=['=','>','<','>=','<='];//возможные операторы, для защиты
            $field=$where[0];
            $operator=$where[1];
            $value=$where[2];

            if(in_array($operator, $operators)){
                $sql="{$action} FROM {$table} WHERE {$field} {$operator} ?";
                if(!$this->query($sql, [$value])->error()){
                    return $this;
                }
            }
        }
        return false;
    }

    public function delete($table, $where=[]){
        return $this->action('DELETE',$table, $where);
    }

    
    public function delete0($table, $where=[]){
        if(count($where)===3){
            $operators=['=','>','<','>=','<='];//возможные операторы, для защиты
            $field=$where[0];
            $operator=$where[1];
            $value=$where[2];
            
            if(in_array($operator, $operators)){
                $sql="DELETE FROM {$table} WHERE {$field} {$operator} ?";
                if(!$this->query($sql, [$value])->error()){
                    return $this;
                }
            }
        }
        return false;
    }
    
    public function get_first(){
        return $this->results()[0];
    }


    public function get($table, $where=[]){
        return $this->action('SELECT *',$table, $where);
    }

    public function get0($table, $where=[]){
        if(count($where)===3){
            $operators=['=','>','<','>=','<='];//возможные операторы, для защиты
            $field=$where[0];
            $operator=$where[1];
            $value=$where[2];

            if(in_array($operator, $operators)){
                $sql="SELECT * FROM {$table} WHERE {$field} {$operator} ?";
                // dump($sql);
                if(!$this->query($sql, [$value])->error()){//если квери не имеет ошибок....то  возвращаем объект полученый запросом
                    return $this;//возвращаем объект полученый запросом
                }
            }
        }
        return false;
    }

    public function insert($table, $fields=[]){
        $values = "";
        foreach ($fields as $field){
            $values .= "?,";
        }
        // $values =rtrim( $values, ',');
        $sql = "INSERT INTO {$table} (`" .implode('`, `', array_keys($fields))."`) VALUES (" . rtrim( $values, ','). ")";
        // dump($sql);

        if(!$this->query($sql, $fields)->error()){
            return true;
        }
        return false;
        
    }
    
    public function query($sql, $params=[]) {
        // dump($params);
        $this->error = false;
        $this->query = $this->pdo->prepare($sql);//prepare подготавливает запрос удаляя из него символы коьорые похожи на sql-инъекцию
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
    
    public function update($table, $id, $fields=[]){
        $set = "";
        foreach ($fields as $key=>$field){
            $set .= "{$key} = ?,";
        }
        $set = rtrim($set, ",");
        // $fields[]=$id;
        // dump($fields);
        $sql = "UPDATE {$table} SET {$set} WHERE id={$id}";
        // $sql = "UPDATE {$table} SET {$set} WHERE id=?";

        if(!$this->query($sql, $fields)->error()){
            return true;
        }
        return false;
        
    }
   
}
