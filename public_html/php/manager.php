<?php
ini_set('session.cookie_path', '/');
require_once('../include/config.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Affichage des informations utilisateur
echo "Bienvenue, Manager " . htmlspecialchars($_SESSION['user']['prenom']) . " " . htmlspecialchars($_SESSION['user']['nom']) . "!";

// Charger et afficher le template
$template = $twig->load('dashboard.twig');
echo $template->render([
    'error' => $error ?? null,
    'user' => $_SESSION['user'] ?? null,
]);