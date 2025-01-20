<?php
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
   case 'GET':
      include('read.php');
      break;
   case 'PUT':
      break;
   case 'POST':
      include('create.php');
      break;
   case 'DELETE':
      break;
}
