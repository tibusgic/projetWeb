<?php
ini_set('session.cookie_path', '/');
require_once('../include/config.php');

$action = "2fa";

// Vérifier si un code a été soumis
$userCode = $_POST['code'] ?? null;
if (!$userCode) {
    $error = "Veuillez entrer un code de vérification.";

    $userId = $_SESSION['user']['id'] ?? null;
    $stmt = $db->prepare('SELECT * FROM google_auth WHERE user_id = :user_id');
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC); // Récupérer une seule ligne
    if ($res && $res['isActive'] == 0) {
        $_SESSION['2fa_verified'] = true; // Contournement si 2FA désactivé
        header('Location: manager.php');
        exit;
    }
} else {
    // Récupérer l'ID utilisateur
    $userId = $_SESSION['user']['id'] ?? null;

    if (!$userId) {
        $error = "Utilisateur non connecté.";
    } else {
        // Récupérer les infos 2FA de l'utilisateur
        $stmt = $db->prepare('SELECT * FROM google_auth WHERE user_id = :user_id');
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC); // Récupérer une seule ligne

        if ($res && $res['isActive'] == 1) {
            $ga = new PHPGangsta_GoogleAuthenticator();
            $checkResult = $ga->verifyCode($res["auth_code"], $userCode, 2);

            if ($checkResult) {
                // Authentification réussie
                $_SESSION['2fa_verified'] = true;
                header('Location: manager.php');
                exit;
            } else {
                $error = "Code incorrect. Veuillez réessayer.";
            }
        } else {
            // L'utilisateur n'a pas activé 2FA ou il n'existe pas dans la table
            $_SESSION['2fa_verified'] = true; // Contournement si 2FA désactivé
            header('Location: manager.php');
            exit;
        }
    }
}


// Charger le template correspondant avec Twig
$template = $twig->load($action . '.twig');
echo $template->render([
    'error' => $error ?? null,
    'user' => $_SESSION['user'] ?? null,
]);
