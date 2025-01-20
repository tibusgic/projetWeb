<?php

//$token = $_GET['token'];
$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsInVzZWxlc3MiOiJkdW1teSJ9.eyJpc3MiOiJodHRwczovL2RldmJveC51LWFuZ2Vycy5mciIsImF1ZCI6Imh0dHBzOi8vZGV2Ym94LnUtYW5nZXJzLmZyIiwiaWF0IjoxNjQ2MTE2NDYyLjEyNDM3NywiZXhwIjoxNjQ2MTIwMDYyLjEyNDM3NywidWxvZ2luIjoicGllcnJlIn0.lIxkCN41duzPKZSyuAvet1QJAdUj9mcRiVrAWln9fJ4';

$url = 'https://devbox.u-angers.fr/~agodon/api/test/service.php';
echo httpPost($url, [], ["Authorization: Bearer <{$token}>",]);


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

