<?php

$stmt = $db->prepare('SELECT * FROM wines');
    $stmt->execute();
    $winesList = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>