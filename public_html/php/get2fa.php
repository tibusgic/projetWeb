<?php
ini_set('session.cookie_path', '/');
require_once('../include/config.php');

$action = "2fa";

$userCode = $_POST['code'] ?? null;

// Enregistrer le secret dans la base de données pour cet utilisateur
$userId = $_SESSION['user']['id']; // récupérer l'ID de l'utilisateur connecté
$stmt = $db->prepare('SELECT * FROM google_auth WHERE id=:user_id');
$stmt->bindParam(':user_id', $userId);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($res){
    if ($res['isActive']){
        $checkResult = $ga->verifyCode($res["auth_code"], $userCode, 2);
        echo "Result is: ".$checkResult;
        if ($checkResult){
            header('Location: manager.php');
            exit;
        }
    }
    else {
        header('Location: manager.php');
        exit;
    }
}
else {
    header('Location: manager.php');
    exit;
}



// Charger le template correspondant avec Twig
$template = $twig->load($action . '.twig');
echo $template->render([
    'error' => $error ?? null,
    'user' => $_SESSION['user'] ?? null,
]);
