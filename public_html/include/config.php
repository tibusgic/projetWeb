<?php
require_once('/home/vendor/autoload.php');
require_once('/home/GoogleAuthenticator.php');

session_start();

$db = new PDO('mysql:host=localhost;dbname=thibaultgicquel6201;charset=utf8mb4', 'thibaultgicquel6201', 'WOWjSaNlCy8C');

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, array(
        'cache' => false
));

date_default_timezone_set('Europe/Paris');



