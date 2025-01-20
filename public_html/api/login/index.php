<?php
require_once('/home/vendor/autoload.php');

use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;


echo login($_POST['username'], $_POST['password']);

function login($username, $password) {
  if ($password === 'niala') {
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

