<?php
require_once('/home/vendor/autoload.php');

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

#$db = new PDO('mysql:host=localhost;dbname=agodon;charset=utf8mb4', 'agodon', 'AlgX33');

echo login($_GET['username'], $_GET['password']);

function login($username, $password) {
  if ($username === 'alain' && $password === 'niala') {
    //$signer = new \Lcobucci\JWT\Signer\Hmac\Sha256();
    $signer = new Sha256();
    $token = (new Builder())
      ->setIssuer('Alain Godon')
      ->setAudience('https://devbox.u-angers.fr')
      ->setIssuedAt(time())
      ->setExpiration(time() + 3600)
      ->set('ulogin', $username)
      ->setHeader('alg', 'HS256')
      ->setHeader('typ', 'JWT')
      ->sign($signer, PRIVKEY)
      ->getToken();
    return json_encode(
        ['result' => 1,
        'message' => 'Token generated successfully',
        'token' => '' . $token,]);
  } else {
    return json_encode(
        ['result' => 0,
        'message' => 'Invalid username and/or password']);
  }


}
