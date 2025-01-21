<?php
session_start();
require_once('include/config.php');

$action = 'login';
if(isset($_SESSION['user'])) {
        $action = 'dashboard';
}
if(isset($_GET['a'])) {
        $action = $_GET['a'];
}

switch($action) {
        case 'form-login':
                $stmt = $db->prepare('SELECT * FROM person WHERE login = :login AND password = :password');

                $stmt->bindParam(':login', $_POST['user']);
                $stmt->bindParam(':password', $_POST['pass']);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                        // Stocker les informations de l'utilisateur dans la session
                        $_SESSION['user'] = [
                            'id' => $user['id'],
                            'nom' => $user['nom'],
                            'prenom' => $user['prenom'],
                            'status' => $user['status']
                        ];
            
                        // Redirection en fonction du statut
                        switch ($user['status']) {
                            case 'Manager':
                                header('Location: manager.php');
                                break;
                            case 'waiter':
                                header('Location: waiter.php');
                                break;
                            case 'admin':
                                header('Location: employee.php');
                                break;
                            default:
                                header('Location: https://devbox.u-angers.fr/~thibaultgicquel6201/'); // Si le statut n'est pas reconnu
                        }
                        exit;
                    } else {
                        // Retourner à la page de connexion en cas d'erreur
                        $action = 'login';
                        $error = 'Identifiant ou mot de passe incorrect.';
                    }
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

$template = $twig->load($action.'.twig');
        echo $_SESSION['data'];
        echo 'test';
  echo $template->render(array(
  'data' => $_SESSION['data'],
  
  'collection' => $collection ?? [], // Les données ou un tableau vide si rien n'est trouvé
));

