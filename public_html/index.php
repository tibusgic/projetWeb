<?php
require_once('include/config.php');
use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Validation\Constraint;
use Lcobucci\JWT\Validation\Constraint\SignedWith;

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

$action = 'login';
if(isset($_SESSION['user'])) {
        $action = 'login';
}
if(isset($_GET['a'])) {
        $action = $_GET['a'];
}   




switch($action) {
        case 'form-login':

                $url = 'https://devbox.u-angers.fr/~thibaultgicquel6201/api/login/';
                $response = json_decode(httpPost($url, ['username' => $_POST['user'], 'password' => $_POST['pass']]));

                if($response->result === 1) {
                        echo $response->token;
                        $configuration = Configuration::forSymmetricSigner(
                        new Sha256(),
                        InMemory::plainText('polytech')
                        );
                
                        $configuration->setValidationConstraints(
                            new Constraint\LooseValidAt(                        // Token should not be expired
                                new SystemClock(new DateTimeZone('UTC')),
                                new DateInterval('PT30S')
                            ),
                            new Constraint\IssuedBy('https://devbox.u-angers.fr'),      // Check the issuer
                            new Constraint\PermittedFor('https://devbox.u-angers.fr'),  // Check the audience
                
                        new Constraint\SignedWith($configuration->signer(), $configuration->signingKey()),
                        );
                
                            $t = $configuration->parser()->parse($response->token);
                
                        $constraints = $configuration->validationConstraints();
                        if ($configuration->validator()->validate($t, ...$constraints)) {
                            echo "Token is valid, user is ".$t->claims()->get('ulogin');
                            $_SESSION['user'] = [
                                'id' => $t->claims()->get('uId'),
                                'nom' => $t->claims()->get('uNom'),
                                'prenom' => $t->claims()->get('uPrenom'),
                                'status' => $t->claims()->get('uStatus'),
                                'token' => $t
                            ];
                            header('Location: php/get2fa.php');
                                exit;
                            } else {
                            echo "Token is NOT valid.";
                            }
                    }
                    else {
                        echo 'Bad authentication';
                        $action = 'login';
                        $error = 'Identifiant ou mot de passe incorrect.';
                        }







/*

                $stmt = $db->prepare('SELECT * FROM person WHERE login = :login AND password = MD5(:password)');

                $stmt->bindParam(':login', $_POST['user']);
                $stmt->bindParam(':password', $_POST['pass']);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                        // Stocker les informations de l'utilisateur dans la session
                        $_SESSION['user'] = [
                            'id' => $user['id'],
                            'nom' => $user['nom'],
                            'prenom' => $user['prenom'],
                            'status' => $user['status']
                        ];

            
                        header('Location: php/get2fa.php');
                        exit;
                    } else {
                        // Retourner à la page de connexion en cas d'erreur
                        $action = 'login';
                        $error = 'Identifiant ou mot de passe incorrect.';
                    }*/
                    break;

        case 'logout':
                session_destroy();
                header('Location: https://devbox.u-angers.fr/~thibaultgicquel6201/');exit;
                exit();
        case 'dashboard':
                if (!isset($_SESSION['user'])) {
                        $action = 'login';
                }
                break;
}
$sideBar = 0;
// Charger le template correspondant avec Twig
$template = $twig->load($action . '.twig');
echo $template->render([
    'error' => $error ?? null,
    'user' => $_SESSION['user'] ?? null,
    'sideBar' => $sideBar,
]);