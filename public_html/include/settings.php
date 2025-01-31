<?php
function getInfo2fa($db, $userId){
    $stmt = $db->prepare('SELECT * FROM google_auth WHERE id=:user_id');
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
    if ($enable) {
        // Activer 2FA et générer un code secret si inexistant
        $ga = new PHPGangsta_GoogleAuthenticator();
        $secret = $ga->createSecret();

        $stmt = $db->prepare('UPDATE google_auth SET auth_code = :auth_code, isActive = 1 WHERE id = :user_id');
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':auth_code', $secret, PDO::PARAM_STR);
        $stmt->execute();
    } else {
        // Désactiver le 2FA
        $stmt = $db->prepare('UPDATE google_auth SET isActive = 0 WHERE id = :user_id');
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }
}

$userId = $_SESSION['user']['id'];

$Info2fa = getInfo2fa($db, $userId);

if (!$Info2fa) {
    $Info2fa = creat2fa($db, $userId);
}