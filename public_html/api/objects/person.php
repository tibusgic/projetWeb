<?php
class Person {
  private $conn = NULL;
  private $table_name = "person";
 
  public $id;
  public $nom;
  public $prenom;
  public $email;
  public $status;
  public $login;
  public $password;
  public $date_creation;
  public $telephone;
 
  public function __construct($db){
    $this->conn = $db;
  }

  function create(){

    $query = "INSERT INTO ".$this->table_name." SET
      nom=:nom, prenom=:prenom, email=:email, status=:status, login=:login, password=:password, date_creation=:date_creation, telephone=:telephone";
    

    $stmt = $this->conn->prepare($query);

    $this->nom = htmlspecialchars(strip_tags($this->nom));
    $this->prenom = htmlspecialchars(strip_tags($this->prenom));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->status = htmlspecialchars(strip_tags($this->status));
    $this->login = htmlspecialchars(strip_tags($this->login));
    $this->password = htmlspecialchars(strip_tags($this->password));
    $this->date_creation = htmlspecialchars(strip_tags($this->date_creation));
    $this->telephone = htmlspecialchars(strip_tags($this->telephone));


    $stmt->bindParam(":nom", $this->nom);
    $stmt->bindParam(":prenom", $this->prenom);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":login", $this->login);
    $stmt->bindParam(":password", $this->password);
    $stmt->bindParam(":date_creation", $this->date_creation);
    $stmt->bindParam(":telephone", $this->telephone);

    if($stmt->execute()){
        return true;
    }

    return false;
  }

  function read() {
    $query = "SELECT id, nom, prenom, email, status, login, password, date_creation, telephone FROM ".$this->table_name;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }


}
