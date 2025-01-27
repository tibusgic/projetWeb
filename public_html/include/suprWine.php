<?php
require_once('config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function maFonctionPHP($db, $id) {

        $stmt = $db->prepare('DELETE FROM wines WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();


        return $stmt;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $response = maFonctionPHP($db, $data['id']);

    echo json_encode(['message' => $response]);
}

?>