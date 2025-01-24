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

    // Requête préparée pour éviter les injections SQL
    $stmt = $db->prepare("INSERT INTO `person` (`nom`, `prenom`, `email`, `status`, `login`, `password`, `date_creation`, `telephone`) 
                        VALUES (:nom, :prenom, :email, :status, :login, :password, NOW(), :telephone)");

    // Lier les paramètres
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':telephone', $telephone);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Membre ajouté avec succès!";
    } else {
        echo "Erreur lors de l'ajout du membre.";
    }
}
?>