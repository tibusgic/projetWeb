<?php
require_once('include/config.php');

$action = 'login';
if(isset($_SESSION['data']['user_login'])) {
        $action = 'show';
}
if(isset($_GET['a'])) {
        $action = $_GET['a'];
}

switch($action) {
        case 'form-login':
                $stmt = $db->prepare('SELECT COUNT(*) as nb FROM students WHERE login = :login AND pass = SHA2(CONCAT(SHA1(login),:pass), 512)');

                $stmt->bindParam(':login', $_POST['user']);
                $stmt->bindParam(':pass', $_POST['pass']);
                $stmt->execute();
                $row = $stmt->fetch();
                if($row['nb'] != 1) {
                        $action = 'login';
                } else {
                        $_SESSION['data']['user_login'] = $_POST['user'];
                        header('Location: https://devbox.u-angers.fr/~thibaultgicquel6201/');exit;
                }
                break;
        case 'logout':
                unset($_SESSION['data']);
                header('Location: https://devbox.u-angers.fr/~thibaultgicquel6201/');exit;
                break;
        case 'show':
                if(isset($_SESSION['data']['user_login'])) {
                        // Requête pour récupérer les notes des étudiants
                        $stmt = $db->prepare(
                                'SELECT 
                                s.firstname, 
                                s.lastname, 
                                sub.subjectname, 
                                n.note 
                                FROM notes n
                                INNER JOIN students s ON n.id_student = s.id
                                INNER JOIN subjects sub ON n.id_subject = sub.id
                                WHERE s.login = :login'
                        );
                        $stmt->bindParam(':login', $_SESSION['data']['user_login']);
                        $stmt->execute();
                        $collection = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
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

