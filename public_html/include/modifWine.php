<?php
require_once('config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function maFonctionPHP($db, $id, $domaine_name, $appellation, $region, $country_of_origin, $grape_varieties, $wine_type, $vintage, $alcohol_content, $classification, $certifications, $bottle_size, $cork_type, $serving_temperature, $aging_potential, $path_img, $stock_limit) {

        $sql = 'UPDATE wines SET 
        domaine_name = :domaine_name, 
        appellation = :appellation, 
        region = :region, 
        country_of_origin = :country_of_origin, 
        grape_varieties = :grape_varieties, 
        wine_type = :wine_type, 
        vintage = :vintage, 
        alcohol_content = :alcohol_content, 
        classification = :classification, 
        certifications = :certifications, 
        bottle_size = :bottle_size, 
        cork_type = :cork_type, 
        serving_temperature = :serving_temperature, 
        aging_potential = :aging_potential, 
        path_img = :path_img,
        stock_limit = :stock_limit
        WHERE id = :id';

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':domaine_name', $domaine_name);
        $stmt->bindParam(':appellation', $appellation);
        $stmt->bindParam(':region', $region);
        $stmt->bindParam(':country_of_origin', $country_of_origin);
        $stmt->bindParam(':grape_varieties', $grape_varieties);
        $stmt->bindParam(':wine_type', $wine_type);
        $stmt->bindParam(':vintage', $vintage);
        $stmt->bindParam(':alcohol_content', $alcohol_content);
        $stmt->bindParam(':classification', $classification);
        $stmt->bindParam(':certifications', $certifications);
        $stmt->bindParam(':bottle_size', $bottle_size);
        $stmt->bindParam(':cork_type', $cork_type);
        $stmt->bindParam(':serving_temperature', $serving_temperature);
        $stmt->bindParam(':aging_potential', $aging_potential);
        $stmt->bindParam(':path_img', $path_img);
        $stmt->bindParam(':stock_limit', $stock_limit);

        $stmt->execute();

        return $stmt;
    }


    $id = $_POST['id'] ?? null;
    $domaine_name = $_POST['domaine_name'] ?? null;
    $appellation = $_POST['appellation'] ?? null;
    $region = $_POST['region'] ?? null;
    $country_of_origin = $_POST['country_of_origin'] ?? null;
    $grape_varieties = $_POST['grape_varieties'] ?? null;
    $wine_type = $_POST['wine_type'] ?? null;
    $vintage = $_POST['vintage'] ?? null;
    $alcohol_content = $_POST['alcohol_content'] ?? null;
    $classification = $_POST['classification'] ?? null;
    $certifications = $_POST['certifications'] ?? null;
    $bottle_size = $_POST['bottle_size'] ?? null;
    $cork_type = $_POST['cork_type'] ?? null;
    $serving_temperature = $_POST['serving_temperature'] ?? null;
    $aging_potential = $_POST['aging_potential'] ?? null;
    $stock_limit = $_POST['stock_limit'] ?? null;

    $path_img = $_POST['path_img'] ?? null; // Récupérer l'image existante
    if (!empty($_FILES['path_img']['name'])) {
        $upload_dir = '../img/wines/'; // Dossier où enregistrer l'image
        $file_name = basename($_FILES['path_img']['name']);
        $target_file = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['path_img']['tmp_name'], $target_file)) {
            $path_img = $file_name;
        }
    }

    $response = maFonctionPHP(
        $db,
        $id,
        $domaine_name,
        $appellation,
        $region,
        $country_of_origin,
        $grape_varieties,
        $wine_type,
        $vintage,
        $alcohol_content,
        $classification,
        $certifications,
        $bottle_size,
        $cork_type,
        $serving_temperature,
        $aging_potential,
        $path_img,
        $stock_limit
    );

    echo json_encode(['message' => $response]);
}

?>