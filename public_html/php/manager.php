<?php
session_start();

// Assurez-vous que Twig est correctement initialisé
require_once 'https://devbox.u-angers.fr/~thibaultgicquel6201/public_html/include/config.php'; // Inclure l'autoloader de Composer


// Vérification de la session
if (!isset($_SESSION['user']) || $_SESSION['user']['status'] !== 'manager') {
    header('Location: index.php');
    exit;
}

// Charger le template et afficher
$template = $twig->load('dashboard.twig');
echo $template->render([
    'error' => $error ?? null,
    'user' => $_SESSION['user'] ?? null,
]);