<?php
// Assurez-vous que la connexion à la base de données est bien établie
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = $_POST['pass'];
    $telephone = $_POST['telephone'] ?? null; // si le téléphone n'est pas renseigné, ce sera null
    $status = $_POST['status'];

    // Hachage du mot de passe
    $hashedPassword = md5($password);


    $opts = array(
    'http'=>array(
    'method'=>'POST',
    'header'=>'Content-type: application/x-www-form-urlencoded',
    )
    );
    $opts['http']['content'] = json_encode(array(
    'nom' => $nom,
    'prenom' => $prenom,
    'email'=> $email,
    'status'=> $status,
    'login' => $login,
    'password' => $hashedPassword,
    'telephone'=> $telephone
    ));

    $context = stream_context_create($opts);
    $st = file_get_contents('https://devbox.u-angers.fr/~thibaultgicquel6201/api/person/create.php', false, $context);

}
?>