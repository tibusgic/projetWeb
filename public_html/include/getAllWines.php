<?php
/*
$stmt = $db->prepare('SELECT * FROM wines');
    $stmt->execute();
    $winesList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    */

    $winesListJson = file_get_contents('https://devbox.u-angers.fr/~thibaultgicquel6201/api/wine/read.php');
    $winesListObj = json_decode($winesListJson);

    if (isset($winesListObj->records) && is_array($winesListObj->records)) {
        $winesList = $winesListObj->records;
    } else {
        $winesList = []; // Valeur par défaut
    }


?>