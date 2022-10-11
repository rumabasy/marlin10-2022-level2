<?php

class Config {
    public static function get($path = null){
        if ($path){
            $config =  $GLOBALS['config'];
            $path = explode('.',$path);
//            dump($path);
            foreach ($path as $item) {
                if(isset($config[$item])){
                    $config =$config[$item];
//                    dump($config,4);
                }
            }
//            dump($config,4);
            return $config;

        }
        return FALSE;
    }
}
