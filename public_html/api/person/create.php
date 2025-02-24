<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../objects/person.php';
$db = new PDO('mysql:host=localhost;dbname=thibaultgicquel6201;charset=utf8mb4', 'thibaultgicquel6201', 'WOWjSaNlCy8C');
 
$person = new Person($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
$person->nom = $data->nom;
$person->prenom = $data->prenom;
$person->email = $data->email;
$person->status = $data->status;
$person->login = $data->login;
$person->password = $data->password;
$person->telephone = $data->telephone;

 
if($person->create()){
    echo '{';
        echo '"message": "Person was created."';
    echo '}';
}
 
else{
    echo '{';
        echo '"message": "Unable to create person."';
    echo '}';
}
