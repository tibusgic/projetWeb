<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../objects/wines.php';
$db = new PDO('mysql:host=localhost;dbname=thibaultgicquel6201;charset=utf8mb4', 'thibaultgicquel6201', 'WOWjSaNlCy8C');

$wine = new Wine($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// Vérifie que l'ID du vin est fourni
if (isset($data->id) && !empty($data->id)) {
    // Affecter les valeurs des propriétés de l'objet Wine
    $wine->id = $data->id;
    $wine->domaine_name = $data->domaine_name;
    $wine->appellation = $data->appellation;
    $wine->region = $data->region;
    $wine->country_of_origin = $data->country_of_origin;
    $wine->grape_varieties = $data->grape_varieties;
    $wine->wine_type = $data->wine_type;
    $wine->vintage = $data->vintage;
    $wine->alcohol_content = $data->alcohol_content;
    $wine->classification = $data->classification;
    $wine->certifications = $data->certifications;
    $wine->bottle_size = $data->bottle_size;
    $wine->cork_type = $data->cork_type;
    $wine->serving_temperature = $data->serving_temperature;
    $wine->aging_potential = $data->aging_potential;
    $wine->path_img = $data->path_img;
    $wine->add_date = $data->add_date;
    $wine->stock_limit = $data->stock_limit;

    // Appeler la méthode modif() pour mettre à jour les données du vin
    if ($wine->modif()) {
        echo json_encode(
            array("message" => "Wine was updated successfully.")
        );
    } else {
        echo json_encode(
            array("message" => "Unable to update wine.")
        );
    }
} else {
    echo json_encode(
        array("message" => "ID is missing. Wine cannot be updated.")
    );
}
?>
