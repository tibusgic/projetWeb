<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../objects/person.php';
$db = new PDO('mysql:host=localhost;dbname=thibaultgicquel6201;charset=utf8mb4', 'thibaultgicquel6201', 'WOWjSaNlCy8C'); 
$person = new Person($db);
$stmt = $person->read();
$num = $stmt->rowCount();
 
if($num > 0) {
    $person_arr=array();
    $person_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $person_item=array(
            "id" => $id,
            "nom" => $nom,
            "prenom" => $prenom,
            "email" => $email,
            "status" => $status,
            "login" => $login,
            "password" => $password,
            "date_creation" => $date_creation,
            "telephone" => $telephone
        );
 
        array_push($person_arr["records"], $person_item);
    }
 
    echo json_encode($person_arr);
}
 
else{
    echo json_encode(
        array("message" => "No person found.")
    );
}
