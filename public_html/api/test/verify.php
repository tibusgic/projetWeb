<?php
require_once('/home/vendor/autoload.php');

use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Validation\Constraint;

$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2RldmJveC51LWFuZ2Vycy5mciIsImF1ZCI6Imh0dHBzOi8vZGV2Ym94LnUtYW5nZXJzLmZyIiwiaWF0IjoxNjQ2MDYyNjk1Ljg2NjQ1OSwiZXhwIjoxNjQ2MDY2Mjk1Ljg2NjQ1OSwidWxvZ2luIjoicGllcnJlIn0.uOSVaN7xUktu6LqtZL7AGHulwzFzdD50M6mqp0pfD-8';

$configuration = Configuration::forSymmetricSigner(
  new Sha256(),
  InMemory::plainText('polytech')
);

$configuration->setValidationConstraints(
  new Constraint\LooseValidAt(
    new SystemClock(new DateTimeZone('UTC')),
    new DateInterval('PT30S')
  ),
  new Constraint\SignedWith($configuration->signer(), $configuration->signingKey()),
);

$t = $configuration->parser()->parse($token);
$constraints = $configuration->validationConstraints();
if ($configuration->validator()->validate($t, ...$constraints)) {
  echo "Token is valid, user is ".$t->claims()->get('ulogin');
} else {
  echo "Token is NOT valid.";
}

