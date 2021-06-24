<?php

class Client {

    private $conn;
    private $table = 'client';
    public $Reference;
    public $cin;
    public $nom;
    public $prenom;
    public $profession;
    public $tele;


    public function __construct($db) {
      $this->conn = $db;
    }
    public function CinExists(){
  
      $sql = 'SELECT cin FROM ' .$this->table.' WHERE cin=  :cin';
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':cin',$this->cin);
      $stmt->execute();
       $count = $stmt->rowCount();
       return $count;

  }
  function generateRandomString($length = 5) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $Reference = 'AC-HA_';
     for ($i = 0; $i < $length; $i++) {
        $Reference .= $characters[rand(0, $charactersLength - 1)];
    }
    return $Reference;
}
    public function Signup(){
        try
        {
      $query  = 'INSERT INTO ' .$this->table.'(`Reference`, `Nom`, `Prenom`, `Age`, `Telephone`,`cin`) VALUES ( :Reference, :nom, :prenom, :Age ,:Telephone, :cin);'; 
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':Reference',$this->Reference);
      $stmt->bindParam(':nom',$this->nom);
      $stmt->bindParam(':prenom',$this->prenom);
      $stmt->bindParam(':Age',$this->Age);
      $stmt->bindParam(':Telephone',$this->tele);
      $stmt->bindParam(':cin',$this->cin);
      $stmt->execute();
      return true;
       }
          catch(Exception $e)
       {
       echo 'Exception reçue : ',  $e->getMessage(), "\n";
         return false;
    }  
    }

   
    public function Signin(){

      $query  = 'SELECT * FROM '.$this->table.' WHERE Reference=:Reference';       
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':Reference',$this->Reference);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row))
       {
        return true;
      } 
      else {
       return false;
    }    
    }
   

}