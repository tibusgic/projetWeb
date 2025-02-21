<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../objects/wines.php';

try {
    $db = new PDO('mysql:host=localhost;dbname=thibaultgicquel6201;charset=utf8mb4', 'thibaultgicquel6201', 'WOWjSaNlCy8C');
    $wine = new Wine($db);

    $stmt = $wine->read();
    $num = $stmt->rowCount();

    if ($num > 0) {
        $wine_arr = array();
        $wine_arr["records"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $wine_item = array(
                "id" => $id,
                "domaine_name" => $domaine_name,
                "appellation" => $appellation,
                "region" => $region,
                "country_of_origin" => $country_of_origin,
                "grape_varieties" => $grape_varieties,
                "wine_type" => $wine_type,
                "vintage" => $vintage,
                "alcohol_content" => $alcohol_content,
                "classification" => $classification,
                "certifications" => $certifications,
                "bottle_size" => $bottle_size,
                "cork_type" => $cork_type,
                "serving_temperature" => $serving_temperature,
                "aging_potential" => $aging_potential,
                "path_img" => $path_img,
                "add_date" => $add_date,
                "stock_limit" => $stock_limit
            );

            array_push($wine_arr["records"], $wine_item);
        }

        echo json_encode($wine_arr);
    } else {
        echo json_encode(array("message" => "No wines found."));
    }
} catch (PDOException $e) {
    echo json_encode(array("error" => "Database connection failed: " . $e->getMessage()));
}
?>
