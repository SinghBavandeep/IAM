<?php
// Gère l'authentification
function ident()
{
    $ident = isset($_POST['ident']) ? test_input($_POST['ident']) : '';
    $password = isset($_POST['password']) ? test_input($_POST['password']) : '';
    $msg = '';

    if (count($_POST) == 0) {
        $controller = "user";
        $action = "ident";
        require('./view/layout.tpl');
    } else {
        require('./model/userBD.php');
        if (!verif_ident_input($ident, $password) ||
            (!verif_ident_customer_BD($ident, $password, $profile) &&
                !verif_ident_admin_BD($ident, $password, $profile))) {
            $msg = 'Login or password incorrect';
            $controller = "user";
            $action = "ident";
            require('./view/layout.tpl');
        } else {
            // Authentification réussie
            $_SESSION['profile'] = $profile;
            $url = './index.php?controller=user&action=home';
            header('Location:' . $url);
        }
    }
}

// Gère l'inscription d'un nouveau client
function inscr()
{
    // Définition des variables
    $name = isset($_POST['name']) ? test_input($_POST['name']) : '';
    $username = isset($_POST['username']) ? test_input($_POST['username']) : '';
    $email = isset($_POST['email']) ? test_input($_POST['email']) : '';
    $password = isset($_POST['password']) ? test_input($_POST['password']) : '';
    $address = isset($_POST['address']) ? test_input($_POST['address']) : '';
    $msg = '';

    if (count($_POST) == 0) {
        $controller = "user";
        $action = "inscr";
        require('./view/layout.tpl');
    } else {
        require('./model/userBD.php');

        if (!verif_inscr_input($name, $username, $email, $password, $address) ||
            !verif_inscr_BD_valid_email($email) ||
            !verif_inscr_BD_valid_username($username)) {
            $msg = 'Input error, Retry!';
            $controller = "user";
            $action = "inscr";
            require('./view/layout.tpl');
        } else {
            inscr_BD($name, $username, $email, $password, $address);

            // Inscription réussie, authentification automatique.
            if (verif_ident_customer_BD($email, $password, $profile)) {
                $_SESSION['profile'] = $profile;
                $url = './index.php?controller=user&action=home';
                header('Location:' . $url);
            } else {
                // Inscription échouée : non implémenté
                die("Something went wrong.");
            }
        }
    }
}

function account()
{
    if (isset($_SESSION['profile']['username'])) {
        $controller = 'user';
        $action = 'account';

        require('./view/layout.tpl');
    } else {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        $url = './index.php?controller=user&action=ident';
        header('Location:' . $url);
    }
}

function AdminPanel()
{
    if (isset($_SESSION['profile']['username'])) {
        $controller = 'user';
        $action = 'adminpanel';

        require('./view/layout.tpl');
    } else {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        $url = './index.php?controller=user&action=adminpanel';
        header('Location:' . $url);
    }
}
function AddAS()
{
    if (isset($_SESSION['profile']['username'])) {
        $controller = 'user';
        $action = 'AddAS';

        require('./view/layout.tpl');
    } else {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        $url = './index.php?controller=user&action=AddAS';
        header('Location:' . $url);
    }
}
function color()
{
    if (isset($_SESSION['profile']['username'])) {
        $controller = 'user';
        $action = 'color';

        require('./view/layout.tpl');
    } else {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        $url = './index.php?controller=user&action=color';
        header('Location:' . $url);
    }
}
function about()
{
    if (isset($_SESSION['profile']['username'])) {
        $controller = 'user';
        $action = 'about';

        require('./view/layout.tpl');
    } else {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        $url = './index.php?controller=user&action=about';
        header('Location:' . $url);
    }
}
function news()
{
    if (isset($_SESSION['profile']['username'])) {
        $controller = 'user';
        $action = 'news';

        require('./view/layout.tpl');
    } else {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        $url = './index.php?controller=user&action=news';
        header('Location:' . $url);
    }
}
function features()
{
    if (isset($_SESSION['profile']['username'])) {
        $controller = 'user';
        $action = 'features';

        require('./view/layout.tpl');
    } else {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        $url = './index.php?controller=user&action=features';
        header('Location:' . $url);
    }
}
function chipping()
{
    if (isset($_SESSION['profile']['username'])) {
        $controller = 'user';
        $action = 'chipping';

        require('./view/layout.tpl');
    } else {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        $url = './index.php?controller=user&action=chipping';
        header('Location:' . $url);
    }
}


// Gère la mise à jour des informations du profil de l'utilisateur
function update()
{
    $name = isset($_POST['name']) ? test_input($_POST['name']) : '';
    $username = isset($_POST['username']) ? test_input($_POST['username']) : '';
    $email = isset($_POST['email']) ? test_input($_POST['email']) : '';
    $password = isset($_POST['password']) ? test_input($_POST['password']) : '';
    $address = isset($_POST['address']) ? test_input($_POST['address']) : '';
    $photo = isset($_POST['photo']) ? test_input($_POST['photo']) : '';
    $msg = '';

    if (count($_POST) == 0) {
        $controller = "user";
        $action = "account";
        require('./view/layout.tpl');
    } else {
        require('./model/userBD.php');

        if (!verif_update_input($name, $username, $email, $address, $photo)) {
            $msg = 'Input error, Retry!';
            $controller = "user";
            $action = "account";
            require('./view/layout.tpl');
        } else {
            // Vérification des champs et conservation des anciennes valeurs
            if (empty($password)) {
                $password = $_SESSION['profile']['password'];
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT);
            }

            if (empty($photo)) {
                $photo = $_SESSION['profile']['photo'];
            }

            if (update_BD($name, $username, $email, $password, $address, $photo)) {
                // Mise à jour réussie
                $_SESSION['profile']['name'] = $name;
                $_SESSION['profile']['username'] = $username;
                $_SESSION['profile']['email'] = $email;
                $_SESSION['profile']['address'] = $address;
                $_SESSION['profile']['photo'] = $photo;
                $msg = 'Update successful!';
            } else {
                $msg = 'Update failed!';
            }

            $controller = "user";
            $action = "account";
            require('./view/layout.tpl');
        }
    }
}

// Gère la déconnexion
function deconnexion()
{
    session_destroy();
    $url = './index.php?controller=user&action=home';
    header('Location:' . $url);
}

// Gère la page d'accueil
function home()
{
    if (!isset($_SESSION['vehicles']) ||
        isset($_GET['param']) && $_GET['param'] == 'vehicle-home') {
        $url = './index.php?controller=vehicle&action=show';
        header('Location:' . $url);
    }

    $controller = 'home';
    $action = 'home';

    require('./view/layout.tpl');
}

// Vérifie si tous les champs du formulaire d'authentification sont correctement renseignés
function verif_ident_input($ident, $password)
{
    if (empty($ident) || empty($password)) {
        return false;
    }
    return true;
}

// Vérifie si tous les champs du formulaire d'inscription sont correctement renseignés
function verif_inscr_input($name, $username, $email, $password, $address)
{
    if (empty($name) || empty($username) || empty($password) || empty($email) || empty($address)) {
        return false;
    }
    return true;
}

// Vérifie si une chaîne est alphabétique
function verif_alpha($str)
{
    return preg_match("/^[a-zA-Z]+$/", $str);
}

// Vérifie si une chaîne est alphanumérique
function verif_alpha_num($str)
{
    return preg_match("/^[a-zA-Z0-9 ]+$/", $str);
}

// Vérifie si l'adresse e-mail est bien formée
function verif_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Vérifie si la longueur de la chaîne est supérieure à une taille fixée
function verif_input_size($str, $size)
{
    return strlen($str) >= $size;
}

// Fonction test_input
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Vérifie si tous les champs du formulaire de mise à jour sont correctement renseignés
function verif_update_input($name, $username, $email, $password, $address, &$password_c = '') {
    if (empty($name) && empty($username) && empty($email) && empty($address) && empty($password)) {
        return false;
    }

    if (!empty($name) && !verif_alpha($name)) {
        return false;
    }

    if (!empty($username) && (!verif_input_size($username, 3) || !verif_alpha($username[0]) || !verif_alpha_num($username))) {
        return false;
    }

    if (!empty($email) && !verif_email($email)) {
        return false;
    }

    // Vous pouvez ajouter des validations supplémentaires pour le mot de passe ou d'autres champs si nécessaire

    if (!empty($password)) {
        $password_c = password_hash($password, PASSWORD_DEFAULT);
    }

    return true;
}


function error()
{
    $controller = 'error';
    $action = 'flashMessage';
    require('./view/layout.tpl');
}
?>
