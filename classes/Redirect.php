<?php

class Redirect {
    public static function to($location = null){
        if($location){
            if(is_numeric($location)){
                // dump($location);
                switch ($location){
                    case 404:
                        header('HTTP/1.0 404 Not Found.');
                        include 'includes/errors/404.php';
                        exit;
                    break;
                    case 403:
                        header('HTTP/1.0 403 Forbidden Error.');//изменение хидера в http
                        include 'includes/errors/403.php';
                        exit;
                    break;
                }
            }
            header('Location: '.$location);//перенаправление
        }
    }
}