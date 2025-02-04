<?php
$directory = "../img/wines"; // Remplace par le chemin réel du dossier
$images = [];

// Vérifier si le dossier existe
if (is_dir($directory)) {
    // Scanner le dossier
    $files = scandir($directory);
    
    // Filtrer uniquement les fichiers d'images (jpg, png, gif, webp, etc.)
    foreach ($files as $file) {
        if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $images[] = $file;
        }
    }
}