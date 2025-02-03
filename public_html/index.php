<?php
require_once('include/config.php');

$action = 'login';
if(isset($_SESSION['user'])) {
        $action = 'login';
}
if(isset($_GET['a'])) {
        $action = $_GET['a'];
}   




switch($action) {
        case 'form-login':
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
$sideBar = 0;
// Charger le template correspondant avec Twig
$template = $twig->load($action . '.twig');
echo $template->render([
    'error' => $error ?? null,
    'user' => $_SESSION['user'] ?? null,
    'sideBar' => $sideBar,
]);