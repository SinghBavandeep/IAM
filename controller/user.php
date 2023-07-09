<?php 

   // gère l'authentification
	function ident() 
	{
		$ident = isset($_POST['ident']) ? test_input($_POST['ident']) : '';
		$password = isset($_POST['password']) ? test_input($_POST['password']) : '';
		$msg = '';

		if (count($_POST)==0){
			$controller = "user"; $action = "ident";
			require('./view/layout.tpl');
		}
		
		else{
			require('./model/userBD.php');
			if (!verif_ident_input($ident, $password, $password_c) ||
				!verif_ident_customer_BD($ident, $password, $profile) &&
				!verif_ident_admin_BD($ident, $password, $profile)){
				$msg = 'Login or password incorrect';
				$controller = "user"; $action = "ident";
				require('./view/layout.tpl');
			}

			else{
            // authentification réussit
				// die("Tous va bien!");
				$_SESSION['profile'] = $profile;
				$url = './index.php?controller=user&action=home';
				header('Location:' . $url);
			}
		}
	}

   // gère l'inscription d'un nouveau client
	function inscr()
   {
      // Définition des variables
      $name = isset($_POST['name']) ? test_input($_POST['name']) : '';
      $username = isset($_POST['username']) ? test_input($_POST['username']) : '';
      $email = isset($_POST['email']) ? test_input($_POST['email']) : '';
      $password = isset($_POST['password']) ? test_input($_POST['password']) : '';
      $adress = isset($_POST['adress']) ? test_input($_POST['adress']) : '';
      $msg = '';


      if (count($_POST)==0) {
         $controller = "user"; $action = "inscr";
         require('./view/layout.tpl');
      }
      else {
         require('./model/userBD.php');

         if (!verif_inscr_input($name, $username, $email, $password, $adress, $password_c) ||
             !verif_inscr_BD_valid_email($email) ||
             !verif_inscr_BD_valid_username($username)) {
            $msg = 'Input error, Retry!';
            $controller = "user"; $action = "inscr";
            require('./view/layout.tpl');
         }
         else {

            inscr_BD($name, $username, $email, $password_c);

            // inscription réussit, authentification automatique.
            if (verif_ident_customer_BD($email, $password_c, $profile)) {
               // die("OK tous c'est bien passé.");
               $_SESSION['profile'] = $profile;
               $url = './index.php?controller=user&action=home';
               header('Location:' . $url);
            }
            // inscription échoué : non implémenté
            die("Something got wrong.");
         }
      }
   }

   function modify(){

   }

   // gère la déconnexion 
   function deconnexion() 
   {
      session_destroy();
      $url = './index.php?controller=user&action=home';
      header('Location:' . $url);
   }

   // gère l'home
	function home() 
	{
      
      if (!isset($_SESSION['vehicles']) ||
          isset($_GET['param']) && $_GET['param'] == 'vehicle-home') {
         $url = './index.php?controller=vehicle&action=show';
         header('Location:' . $url);
      }

		$controller = 'home';
		$action = 'home';

        require ('./view/layout.tpl');


    }

function account()
{
    if (isset($_SESSION['profile']['username'])) {
        $controller = 'user';
        $action = 'account';

        require ('./view/layout.tpl');
    }

}

   // Vérifie si tous les champs du formulaire d'authentification sont
   // correctement renseignés
	function verif_ident_input($ident, $password, &$password_c='')
   {
		if (empty($ident) || empty($password))
			return false;
		$password_c = crypt($password, '$6$rounds=5000$anexamplestringforsalt$');
		return true;
	}

   // Vérifie si tous les champs du formulaire d'inscription sont
   // correctement renseignés
	function verif_inscr_input($name, $username, $email , $password, $adress, &$password_c='') : bool
   {
      if (empty($name) || empty($username) || empty($password) || empty($email) || empty($adress))
         return false;
      if (!verif_alpha($name))
         return false;
      if (!verif_input_size($username, 3) || !verif_alpha($username[0]) || !verif_alpha_num($username))
         return false;
      if (!verif_email($email))
         return false;
      if (!verif_alpha_num($adress))
         return false;
      $password_c = crypt($password, '$6$rounds=5000$anexamplestringforsalt$');
      return true;
   }


   // Vérifie si une chaîne est alphabétique
	function verif_alpha(string $str) : bool
   {
		return preg_match("/^[a-zA-Z]+$/", $str);
	}

   // Vérifie si une chaîne est alpha-numérique
	function verif_alpha_num(string $str) : bool
   {
		return preg_match("/^[a-zA-Z0-9 ]+$/", $str);
	}

   // Vérifie si l'adresse e-mail est bien formée.
	function verif_email(string $email) : bool
   {
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

   // Vérifie si la longueur de la chaîne est supérieure à une taille fixée.
	function verif_input_size(string $str, int $size) : bool
   {
		return strlen($str) >= $size;
	}

   // Fonction test_input
	function test_input(string $data) : string
   {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

   function error()
   {
      $controller = 'error'; $action = 'flashMessage';
      require ('./view/layout.tpl');
   }

?>
