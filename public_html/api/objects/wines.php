<?php
class Wine {
  private $conn = NULL;
  private $table_name = "wines";
 
  public $id;
  public $domaine_name;
  public $appellation;
  public $region;
  public $country_of_origin;
  public $grape_varieties;
  public $wine_type;
  public $vintage;
  public $alcohol_content;
  public $classification;
  public $certifications;
  public $bottle_size;
  public $cork_type;
  public $serving_temperature;
  public $aging_potential;
  public $path_img;
  public $add_date;
  public $stock_limit;
 
  public function __construct($db){
    $this->conn = $db;
  }

  function create(){

    // Requête SQL pour insérer un nouveau vin dans la table
    $query = "INSERT INTO ".$this->table_name." SET
      domaine_name=:domaine_name, appellation=:appellation, region=:region, 
      country_of_origin=:country_of_origin, grape_varieties=:grape_varieties, wine_type=:wine_type,
      vintage=:vintage, alcohol_content=:alcohol_content, classification=:classification, 
      certifications=:certifications, bottle_size=:bottle_size, cork_type=:cork_type, 
      serving_temperature=:serving_temperature, aging_potential=:aging_potential, 
      path_img=:path_img, add_date=:add_date, stock_limit=:stock_limit";
    
    $stmt = $this->conn->prepare($query);

    $this->domaine_name = htmlspecialchars(strip_tags($this->domaine_name));
    $this->appellation = htmlspecialchars(strip_tags($this->appellation));
    $this->region = htmlspecialchars(strip_tags($this->region));
    $this->country_of_origin = htmlspecialchars(strip_tags($this->country_of_origin));
    $this->grape_varieties = htmlspecialchars(strip_tags($this->grape_varieties));
    $this->wine_type = htmlspecialchars(strip_tags($this->wine_type));
    $this->vintage = htmlspecialchars(strip_tags($this->vintage));
    $this->alcohol_content = htmlspecialchars(strip_tags($this->alcohol_content));
    $this->classification = htmlspecialchars(strip_tags($this->classification));
    $this->certifications = htmlspecialchars(strip_tags($this->certifications));
    $this->bottle_size = htmlspecialchars(strip_tags($this->bottle_size));
    $this->cork_type = htmlspecialchars(strip_tags($this->cork_type));
    $this->serving_temperature = htmlspecialchars(strip_tags($this->serving_temperature));
    $this->aging_potential = htmlspecialchars(strip_tags($this->aging_potential));
    $this->path_img = htmlspecialchars(strip_tags($this->path_img));
    $this->add_date = htmlspecialchars(strip_tags($this->add_date));
    $this->stock_limit = htmlspecialchars(strip_tags($this->stock_limit));

    $stmt->bindParam(":domaine_name", $this->domaine_name);
    $stmt->bindParam(":appellation", $this->appellation);
    $stmt->bindParam(":region", $this->region);
    $stmt->bindParam(":country_of_origin", $this->country_of_origin);
    $stmt->bindParam(":grape_varieties", $this->grape_varieties);
    $stmt->bindParam(":wine_type", $this->wine_type);
    $stmt->bindParam(":vintage", $this->vintage);
    $stmt->bindParam(":alcohol_content", $this->alcohol_content);
    $stmt->bindParam(":classification", $this->classification);
    $stmt->bindParam(":certifications", $this->certifications);
    $stmt->bindParam(":bottle_size", $this->bottle_size);
    $stmt->bindParam(":cork_type", $this->cork_type);
    $stmt->bindParam(":serving_temperature", $this->serving_temperature);
    $stmt->bindParam(":aging_potential", $this->aging_potential);
    $stmt->bindParam(":path_img", $this->path_img);
    $stmt->bindParam(":add_date", $this->add_date);
    $stmt->bindParam(":stock_limit", $this->stock_limit);

    if($stmt->execute()){
        return true;
    }

    return false;
  }

  function read() {
    $query = "SELECT id, domaine_name, appellation, region, country_of_origin, grape_varieties, 
              wine_type, vintage, alcohol_content, classification, certifications, bottle_size, 
              cork_type, serving_temperature, aging_potential, path_img, add_date, stock_limit 
              FROM ".$this->table_name;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }
}
