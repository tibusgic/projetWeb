<?php
require_once('/home/vendor/autoload.php');
require_once('/home/GoogleAuthenticator.php');

// Démarrer la session si nécessaire
if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

$db = new PDO('mysql:host=localhost;dbname=thibaultgicquel6201;charset=utf8mb4', 'thibaultgicquel6201', 'WOWjSaNlCy8C');

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader, array(
        'cache' => false
));

date_default_timezone_set('Europe/Paris');



