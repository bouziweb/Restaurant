<?php

   class Database
   {
       
       
      private static $dbHoste="localhost";
      private static $dbName="burger_bouzi";
      private static $dbUser="root";
      private static $dbUserPassword="root";
      private static $connection=null;
   

 

         public static function connect()
           {

                   try 
                {
                     self::$connection = new PDO("mysql:host=" .self::$dbHoste. ";dbname=" .self::$dbName,self::$dbUser,self::$dbUserPassword);
                }

                catch(PDOExeption $e)
                {
                    die($e->getMessage());
                }
               return self::$connection;

          }
       

       public static function disconnect()
               
           {
               self::$connection=null;
           }

       
   }

   Database::connect();




?>
