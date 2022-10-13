<?php
    session_start();

class Session {
    public static function put($name, $value){
        return $_SESSION[$name] = $value;
    }

    public static function exists($name){
        return (isset($_SESSION[$name])) ? true : false;
    }

    public static function delete($name){
        if(self::exists($name)){
            unset($_SESSION[$name]);
        }
    }
    public static function flash($alert, $message=''){
        if(self::exists($alert) && self::get($alert) !== ''){//если алерт уже существует и мессаж в нем не пустой, то алерт выводится и удаляется
            $session = self::get($alert);
            self::delete($alert);
            return $session;
        } else {
            self::put($alert, $message);//если алерт не существует, то он создается с мэссажем
        }
    }

    public static function get($name){
        return $_SESSION[$name];
    }
}

