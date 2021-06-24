<?php

class RDV {

    private $conn;
    private $table = 'rdv';
    public $Id_rdv;
    public $Reference;
    public $Motif;
    public $Date;
    public $Num_Creneau;
 

    public function __construct($db) {
      $this->conn = $db;
    }
  
    public function AddRdv(){
        try
        {
      $query  = ' INSERT INTO `rdv`( `Reference`,`Motif`, `Date`, `Num_creneau` ) VALUES (:Reference , :Motif, :Date, :Num_creneau);'; 
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':Reference',$this->Reference);
      $stmt->bindParam(':Motif',$this->Motif);
      $stmt->bindParam(':Date',$this->Date);
      $stmt->bindParam(':Num_creneau',$this->Num_creneau);
      $stmt->execute();
      return true;
       }
          catch(Exception $e)
       {
       echo 'Exception reçue : ',  $e->getMessage(), "\n";
         return false;
    }  
    }
      public function ReadRdv() {

        $query = 'SELECT * from rdv r, creneau c  where r.Reference = :Reference AND c.Num_creneau=r.Num_creneau ';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Reference',$this->Reference);
        $stmt->execute();
        return $stmt;
      }
     public function delete(){

        $query  = "DELETE FROM ". $this->table." WHERE Id_rdv = :Id_rdv";
        $stmt   = $this->conn->prepare($query);
        $this->Id_rdv = htmlspecialchars(strip_tags($this->Id_rdv));
         $stmt->bindParam(':Id_rdv',$this->Id_rdv);
        if($stmt->execute()){
          return true;
        }else{
        printf('Erreur de suppresion: %s.\n',$stmt->error);
        return false;
        } 
    }
    public function ReadCreneau($D)
{
  
  $query ="SELECT * FROM creneau WHERE  Num_creneau NOT IN(SELECT c.Num_creneau FROM creneau c, rdv r where c.Num_creneau=r.Num_creneau AND r.Date= '$D')";
  $stmt = $this->conn->prepare($query);
  
  $stmt->execute();
  return $stmt;
}
      



}