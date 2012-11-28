<?php

class DBank {

     private static $_instance;

     public function &pdo_connection(){
        if(!self::$_instance){
            try {
                self::$_instance = new PDO(DSN,USERNAME,PASSWORD);
                self::$_instance->setAttribute(PDO::ATTR_PERSISTENT, true);
                self::$_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//echo 'Connected to database';
            }
            catch(PDOException $est) {
                die("pdo connection error! ". $est->getMessage() ."<br/>");
            }
        }
        return self::$_instance;
    }
}
?>