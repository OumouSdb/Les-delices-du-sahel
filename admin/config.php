<?php
  
  class Database{
  
      private static $dbHost = "localhost";
      private static $dbname = "lesdelicesdusahel";
      private static $dbUser = "root";
      private static $dbUserPasword = "";
      private static $connection = null;
      
      public static function connect(){
      
      try{
             self::$connection = new PDO("mysql:host=" .self::$dbHost. ";dbname=" . self::$dbname,self::$dbUser,self::$dbUserPasword);
              
              }catch(PDOException $e){
                  die($e->getMessage());
              }
      return self::$connection;
      }
      public static function disconnect(){
          self::$connection = null;
       }
  
  
  }
  
  Database::connect();
  
  
  ?>