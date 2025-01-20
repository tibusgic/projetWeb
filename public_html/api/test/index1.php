<html><head></head><body>
<?php
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
    //$response = json_decode(httpPost($url, ['username' => $_POST['username'], 'password' => $_POST['password']]));
    echo httpPost($url, ['username' => $_POST['username'], 'password' => $_POST['password']]);

    if($response->result === 1) echo $response->token; else echo 'Bad authentication';
  } else {
?>
  <form method="post">
  <input type="text" name="username"><br/>
  <input type="password" name="password"><br/>
  <input type="submit" value="Se connecter"><br/>
  </form>
<?php } ?>
</body></html>
