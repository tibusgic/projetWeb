<?php
session_start();
echo $_SESSION['user']['status'];
if (!isset($_SESSION['user']) || $_SESSION['user']['status'] !== 'manager') {
    header('Location: index.php');
    exit;
}
echo "Bienvenue, Manager " . $_SESSION['user']['prenom'] . " " . $_SESSION['user']['nom'] . "!";
?>