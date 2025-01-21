<?php

require_once('../include/config.php');

// Vérification de la session
if (!isset($_SESSION['user']) || $_SESSION['user']['status'] !== 'manager') {
    header('Location: ../index.php');
    exit;
}

// Charger et afficher le template
$template = $twig->load('dashboard.twig');
echo $template->render([
    'error' => $error ?? null,
    'user' => $_SESSION['user'] ?? null,
]);