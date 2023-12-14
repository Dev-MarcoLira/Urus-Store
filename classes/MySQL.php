<?php
    
	class MySql{

        private static $pdo;

        public static function connect(){

            if(self::$pdo === null){
                try{
                    self::$pdo = new PDO('mysql:host='.HOST.';dbname='.DATABASE,USER,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                    
                    self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                    self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }catch(Exception $e){
                    return false;
                }
            }

            return self::$pdo;
        }

        public static function select($columns, $table, $query){
        	
        	if(!($connection = MySQL::connect()))
                return false;

        	$sql = "SELECT $columns FROM $table $query";
			
			try{
			
                $query = $connection->query($sql);

                return $query;
            }catch(PDOException){
                return false;
            }
        }

        public static function insert($table, $columns, $values){
        	
        	if(!($connection = MySQL::connect()))
                return false;

        	$sql = "INSERT INTO $table ($columns) VALUES ($values)";
			
            try{
			
                $query = $connection->prepare($sql);
                $query->execute();

                return true;
                
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
            
        }

        public static function getLastInsertId($table, $columns, $values){
            if(!($connection = MySQL::connect()))
                return false;

        	$sql = "INSERT INTO $table ($columns) VALUES ($values)";
			
            try{
			
                $query = $connection->prepare($sql);
                $query->execute();

                return $connection->lastInsertId();
                
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }

        public static function getConnection(){

            return self::connect();

        }

        public static function update($table, $columns, $query){
            
            if(!($connection = MySQL::connect()))
                return false;

            $sql = "UPDATE $table $columns $query";
            
            try{
            
                $query = $connection->prepare($sql);
                $query->execute();

                return true;
            }catch(PDOException $e){
                return false;
            }
        }

        public static function delete($table, $query){

            if(!($connection = MySQL::connect()))
                return false;

            $sql = "DELETE FROM $table $query";
            
            try{

                $query = $connection->prepare($sql);
                $query->execute();

                return true;
            }catch(PDOException $e){

                return false;
            }

        }

        public static function freeSelect($sql){

            if(!($connection = MySQL::connect()))
                return false;

            try{

                $query = $connection->query($sql);

                return $query;

            }catch(PDOException $e){

                return false;
            }
        }

    }

?>