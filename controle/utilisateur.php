<?php 

   // gère l'authentification
	function ident() 
	{
		$ident = isset($_POST['ident']) ? test_input($_POST['ident']) : '';
		$mdp = isset($_POST['mdp']) ? test_input($_POST['mdp']) : '';
		$msg = '';

		if (count($_POST)==0){
			$controle = "utilisateur"; $action = "ident";
			require('./vue/layout.tpl');
		}
		
		else{
			require('./modele/utilisateurBD.php');
			if (!verif_ident_input($ident, $mdp, $mdp_c) ||
				!verif_ident_client_BD($ident, $mdp_c, $Profil) &&
				!verif_ident_loueur_BD($ident, $mdp_c, $Profil)){
				$msg = 'Identifiant ou mot de passe incorrect';
				$controle = "utilisateur"; $action = "ident";
				require('./vue/layout.tpl');
			}

			else{
            // authentification réussit
				// die("Tous va bien!");
				$_SESSION['profil'] = $Profil;
				$url = './index.php?controle=utilisateur&action=accueil';
				header('Location:' . $url);
			}
		}
	}

   // gère l'inscription d'un nouveau client
	function inscr()
   {
      // Définition des variables
      $nom = isset($_POST['nom']) ? test_input($_POST['nom']) : '';
      $pseudo = isset($_POST['pseudo']) ? test_input($_POST['pseudo']) : '';
      $email = isset($_POST['email']) ? test_input($_POST['email']) : '';
      $mdp = isset($_POST['mdp']) ? test_input($_POST['mdp']) : '';
      $nomE = isset($_POST['nomE']) ? test_input($_POST['nomE']) : '';
      $adresseE = isset($_POST['adresseE']) ? test_input($_POST['adresseE']) : '';
      $msg = '';


      if (count($_POST)==0) {
         $controle = "utilisateur"; $action = "inscr";
         require('./vue/layout.tpl');
      }
      else {
         require('./modele/utilisateurBD.php');

         if (!verif_inscr_input($nom, $pseudo, $email, $mdp, $nomE, $adresseE, $mdp_c) || 
             !verif_inscr_BD_valide_email($email) || 
             !verif_inscr_BD_valide_pseudo($pseudo)) {
            $msg = 'Erreur de saisie, Reéssayez !';
            $controle = "utilisateur"; $action = "inscr";
            require('./vue/layout.tpl');
         }
         else {
            // Si l'entreprise n'existe pas dans la base de donné, alors on la crée.
            if (count(getId_entreprise_BD($nomE)) == 0) 
               create_entreprise_BD($nomE, $adresseE);

            $idE = getId_entreprise_BD($nomE)['id'];

            inscr_BD($nom, $pseudo, $email, $mdp_c, $idE);

            // inscription réussit, authentification automatique.
            if (verif_ident_client_BD($email, $mdp_c, $Profil)) {
               // die("OK tous c'est bien passé.");
               $_SESSION['profil'] = $Profil;
               $url = './index.php?controle=utilisateur&action=accueil';
               header('Location:' . $url);
            }
            // inscription échoué : non implémenté
            die("Quelque chos n'a pas fonctionnée.");
         }
      }
   }

   // gère la déconnexion 
   function deconnexion() 
   {
      session_destroy();
      $url = './index.php?controle=utilisateur&action=accueil';
      header('Location:' . $url);
   }

   // gère l'accueil
	function accueil() 
	{
      
      if (!isset($_SESSION['vehicules']) ||
          isset($_GET['param']) && $_GET['param'] == 'vehicule-home') {
         $url = './index.php?controle=vehicule&action=show';
         header('Location:' . $url);
      }

		$controle = 'accueil';
		$action = 'home';
		
		require ('./vue/layout.tpl');   
	}

   // Vérifie si tous les champs du formulaire d'authentification sont
   // correctement renseignés
	function verif_ident_input($ident, $mdp, &$mdp_c='') 
   {
		if (empty($ident) || empty($mdp))
			return false;
		$mdp_c = crypt($mdp, '$6$rounds=5000$anexamplestringforsalt$');
		return true;
	}

   // Vérifie si tous les champs du formulaire d'inscription sont
   // correctement renseignés
	function verif_inscr_input($nom, $pseudo, $email , $mdp, $nomE, $adresseE, &$mdp_c='') : bool
   {
      if (empty($nom) || empty($pseudo) || empty($mdp) || empty($email) || empty($nomE) || empty($adresseE))
         return false;
      if (!verif_alpha($nom))
         return false;
      if (!verif_input_size($pseudo, 3) || !verif_alpha($pseudo[0]) || !verif_alpha_num($pseudo))
         return false;
      if (!verif_email($email))
         return false;
      if (!verif_alpha_num($nomE) || !verif_alpha_num($adresseE))
         return false;
      $mdp_c = crypt($mdp, '$6$rounds=5000$anexamplestringforsalt$');
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

   function erreur()
   {
      $controle = 'erreur'; $action = 'flashMessage';
      require ('./vue/layout.tpl');
   }

?>
