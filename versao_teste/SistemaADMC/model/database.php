<?php

class dataBase{
    
    public static $_instance;
    
    public static function getHandler(){
        
        $host = DB_HOST;
        $dbname = DB_NAME;
        $charset = CHARSET;
        $user = DB_USER;
        $password = DB_PASSWORD;
        
        if ( !isset( self::$_instance ) ) {
            self::$_instance = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset",$user, $password);
        }
        return self::$_instance;
    }
}
?>