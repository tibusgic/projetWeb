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
      nom=:nom, prenom=:prenom, email=:email, status=:status, login=:login, password=:password, date_creation=:date_creation, telephone=:telephone)";
    $stmt = $this->conn->prepare($query);

    $this->firstname = htmlspecialchars(strip_tags($this->firstname));
    $this->lastname = htmlspecialchars(strip_tags($this->lastname));
    $this->login = htmlspecialchars(strip_tags($this->login));
    $stmt->bindParam(":firstname", $this->firstname);
    $stmt->bindParam(":lastname", $this->lastname);
    $stmt->bindParam(":login", $this->login);
    $stmt->bindParam(":pass", $this->pass);
    if($stmt->execute()){
        return true;
    }
    return false;
  }

  function read() {
    $query = "SELECT id, firstname, lastname, login, pass FROM ".$this->table_name;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }


}
