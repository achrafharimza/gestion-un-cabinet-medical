<?php

class Database{
private $host       =   'localhost';
private $dbname     =   'brief6';
private $username   =   'root';
private $password    =   'youssef';
private $conn;


public function connect(){
    
    try{
        $this->conn     =   new PDO('mysql:host='.$this->host . ';dbname=' . $this->dbname ,$this->username,$this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Connection Error : " . $e->getMessage();
    }
    return $this->conn;
}


}