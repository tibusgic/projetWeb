<?php
// Assurez-vous que la connexion à la base de données est bien établie
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $domaine_name = $_POST['domaine_name'];
    $appellation = $_POST['appellation'];
    $region = $_POST['region'];
    $country_of_origin = $_POST['country_of_origin'];
    $grape_varieties = $_POST['grape_varieties'];
    $wine_type = $_POST['wine_type'];
    $vintage = $_POST['vintage'];
    $alcohol_content = $_POST['alcohol_content'];
    $classification = $_POST['classification'];
    $certifications = $_POST['certifications'];
    $bottle_size = $_POST['bottle_size'];
    $cork_type = $_POST['cork_type'];
    $serving_temperature = $_POST['serving_temperature'];
    $aging_potential = $_POST['aging_potential'];
    $path_img = $_POST['path_img'];
    $add_date = $_POST['add_date'];
    $stock_limit = $_POST['stock_limit'];


    $opts = array(
        'http'=>array(
        'method'=>'POST',
        'header'=>'Content-type: application/x-www-form-urlencoded',
        )
        );
    $opts['http']['content'] = json_encode(array(
        'domaine_name' => $domaine_name,
        'appellation' => $appellation,
        'region' => $region,
        'country_of_origin' => $country_of_origin,
        'grape_varieties' => $grape_varieties,
        'wine_type' => $wine_type,
        'vintage' => $vintage,
        'alcohol_content' => $alcohol_content,
        'classification' => $classification,
        'certifications' => $certifications,
        'bottle_size' => $bottle_size,
        'cork_type' => $cork_type,
        'serving_temperature' => $serving_temperature,
        'aging_potential' => $aging_potential,
        'path_img' => $path_img,
        'add_date' => $add_date,
        'stock_limit' => $stock_limit
        ));

    $context = stream_context_create($opts);
    $st = file_get_contents('https://devbox.u-angers.fr/~thibaultgicquel6201/api/wine/create.php', false, $context);

}
?>