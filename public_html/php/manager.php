<?php
ini_set('session.cookie_path', '/');
require_once('../include/config.php');


// Vérification de l'état de la session ou des informations de connexion
if (!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
    // Redirection vers l'accueil si la session est invalide ou absente
    header('Location: https://devbox.u-angers.fr/~thibaultgicquel6201/');
    exit(); // Assurez-vous d'arrêter le script après une redirection
}

// Affichage des informations utilisateur
//echo "Bienvenue, Manager " . htmlspecialchars($_SESSION['user']['prenom']) . " " . htmlspecialchars($_SESSION['user']['nom']) . "!";
$activePage = $_GET['page'] ?? 'dashboard'; // Par défaut, 'dashboard' est actif

//charger les donnee des membres
if ($activePage === 'members') {
    include('../include/addMember.php');
    $stmt = $db->prepare('SELECT * FROM person');
    $stmt->execute();
    $personList = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
elseif($activePage === 'wines'){
    include('../include/getAllWines.php');
}


// Charger et afficher le template
$template = $twig->load('dashboard.twig');
echo $template->render([
    'activePage' => $activePage,
    'error' => $error ?? null,
    'user' => $_SESSION['user'] ?? null,
    'personList' => $personList ?? null,
    'winesList' => $winesList ?? null,
]);

?>