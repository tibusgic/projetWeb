<?php
require_once('/home/vendor/autoload.php');

use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;


echo login($_POST['username'], $_POST['password']);

function login($username, $password) {
  $db = new PDO('mysql:host=localhost;dbname=thibaultgicquel6201;charset=utf8mb4', 'thibaultgicquel6201', 'WOWjSaNlCy8C');
  $stmt = $db->prepare('SELECT * FROM person WHERE login = :login AND password = MD5(:password)');

                $stmt->bindParam(':login', $username);
                $stmt->bindParam(':password', $password);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($user) {
    $configuration = Configuration::forSymmetricSigner(
      new Sha256(),
      InMemory::plainText('polytech')
    );
    $now   = new DateTimeImmutable();
    $token = $configuration->builder()
      ->issuedBy('https://devbox.u-angers.fr')
      ->permittedFor('https://devbox.u-angers.fr')
      ->issuedAt($now)
      ->expiresAt($now->modify('+1 hour'))
      ->withClaim('ulogin', $username)
      ->withClaim('uId', $user['id'])
      ->withClaim('uNom', $user['nom'])
      ->withClaim('uPrenom', $user['prenom'])
      ->withClaim('uStatus', $user['status'])
      ->getToken($configuration->signer(), $configuration->signingKey());

//$token->headers(); // Retrieves the token headers
//$token->claims(); // Retrieves the token claims
//var_dump($token);
//echo $token->toString();

    return json_encode(
        ['result' => 1,
        'message' => 'Token generated successfully',
        'token' => '' . $token->toString(),]);
  } else {
    return json_encode(
        ['result' => 0,
        'message' => 'Invalid username and/or password']);
  }
}

