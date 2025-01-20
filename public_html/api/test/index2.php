<html><head></head><body>
<?php
require_once('/home/vendor/autoload.php');

use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Validation\Constraint;
#use Lcobucci\JWT\Validation\Constraint\SignedWith;

function httpPost($url, $data = [], $headers = []) {
  $options = [
    'http' => [
      'method' => 'POST',
        'header' => array_merge(['Content-type: application/x-www-form-urlencoded'], $headers),
        'content' => http_build_query($data),
       ],
  ];
  $context = stream_context_create($options);
  return file_get_contents($url, false, $context);
}

  if(isset($_POST['username'])) {
    $url = 'https://devbox.u-angers.fr/~agodon/api/login/';
    //$url .= '?username='.$_POST['username'].'&password='.$_POST['password'];
    //$response = json_decode(file_get_contents($url));
    $response = json_decode(httpPost($url, ['username' => $_POST['username'], 'password' => $_POST['password']]));
    //echo httpPost($url, ['username' => $_POST['username'], 'password' => $_POST['password']]);

    if($response->result === 1) {
    echo $response->token;
    $configuration = Configuration::forSymmetricSigner(
      new Sha256(),
      InMemory::plainText('polytech')
    );

$configuration->setValidationConstraints(
/*
    new Constraint\LooseValidAt(                        // Token should not be expired
        new SystemClock(new DateTimeZone('UTC')),
        new DateInterval('PT30S')
    ),
    new Constraint\IssuedBy('https://devbox.u-angers.fr'),      // Check the issuer
    new Constraint\PermittedFor('https://devbox.u-angers.fr'),  // Check the audience
*/
new Constraint\SignedWith($configuration->signer(), $configuration->signingKey()),
);

      $t = $configuration->parser()->parse($response->token);
      //$t = $configuration->parser()->parse('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2RldmJveC51LWFuZ2Vycy5mciIsImF1ZCI6Imh0dHBzOi8vZGV2Ym94LnUtYW5nZXJzLmZyIiwiaWF0IjoxNjQ2MDQ1NDQwLjE0OTk1NCwiZXhwIjoxNjQ2MDQ5MDQwLjE0OTk1NCwidWxvZ2luIjoiZXJpYyJ9.noKRJrF7OE5hBVw6yWUh7p-lxyA3kPuBS3f8fsP2Huc');

$constraints = $configuration->validationConstraints();
if (! $configuration->validator()->validate($t, ...$constraints)) {
   throw new RuntimeException('No way!');
}

echo $t->claims()->get('ulogin');
//var_dump($t);
    } else {
      echo 'Bad authentication';
    }
  } else {
?>
  <form method="post">
  <input type="text" name="username"><br/>
  <input type="password" name="password"><br/>
  <input type="submit" value="Se connecter"><br/>
  </form>
<?php } ?>
</body></html>
