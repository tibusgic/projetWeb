<?php
function getInfo2fa($db, $userId){
    $stmt = $db->prepare('SELECT * FROM google_auth WHERE user_id=:user_id');
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    $info = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($info) {
        $ga = new PHPGangsta_GoogleAuthenticator();
        $info['qr_code_url'] = $ga->getQRCodeGoogleUrl('Test', $info['auth_code']);
    }
    return $info;
}

function creat2fa($db, $userId){
    $ga = new PHPGangsta_GoogleAuthenticator();
    $secret = $ga->createSecret();
    $stmt = $db->prepare('INSERT INTO google_auth (user_id, auth_code, isActive) VALUES (:user_id, :auth_code, 1)');
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':auth_code', $secret);
    $stmt->execute();
    return getInfo2fa($db, $userId);
}

function update2fa($db, $userId, $enable) {
    $info = getInfo2fa($db, $userId);

    if (!$info) {
        // Si aucune entrée pour cet utilisateur, on crée un 2FA
        creat2fa($db, $userId);
    } else {
        // Mise à jour si l'entrée existe déjà
        if ($enable) {
            $stmt = $db->prepare('UPDATE google_auth SET isActive = 1 WHERE user_id = :user_id');
        } else {
            $stmt = $db->prepare('UPDATE google_auth SET isActive = 0 WHERE user_id = :user_id');
        }
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }
}


$userId = $_SESSION['user']['id'];
// Vérification si une soumission du formulaire a eu lieu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enable_2fa'])) {
    $enable2FA = (int)$_POST['enable_2fa']; // Convertir en entier (1 ou 0)
    update2fa($db, $userId, $enable2FA);

    // Rediriger après mise à jour pour éviter la double soumission
    header("Location: manager.php?page=settings");
    exit();
}

// Charger les infos initiales du 2FA
$Info2fa = getInfo2fa($db, $userId);