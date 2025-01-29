<?php
require_once('config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function maFonctionPHP($db, $id, $domaine_name, $appellation, $region, $country_of_origin, $grape_varieties, $wine_type, $vintage, $alcohol_content, $classification, $certifications, $bottle_size, $cork_type, $serving_temperature, $aging_potential, $path_img) {

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
        path_img = :path_img 
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

        $stmt->execute();

        return $stmt;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $response = maFonctionPHP(
        $db,
        $data['id'],
        $data['domaine_name'] ?? null,
        $data['appellation'] ?? null,
        $data['region'] ?? null,
        $data['country_of_origin'] ?? null,
        $data['grape_varieties'] ?? null,
        $data['wine_type'] ?? null,
        $data['vintage'] ?? null,
        $data['alcohol_content'] ?? null,
        $data['classification'] ?? null,
        $data['certifications'] ?? null,
        $data['bottle_size'] ?? null,
        $data['cork_type'] ?? null,
        $data['serving_temperature'] ?? null,
        $data['aging_potential'] ?? null,
        $data['path_img'] ?? null
    );

    echo json_encode(['message' => $response]);
}

?>