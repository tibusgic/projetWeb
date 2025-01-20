<?php
require_once('/home/vendor/autoload.php');

use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;

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
  ->withHeader('useless', 'dummy')
  ->withClaim('ulogin', 'pierre')
  ->getToken($configuration->signer(), $configuration->signingKey());

echo $token->toString();

