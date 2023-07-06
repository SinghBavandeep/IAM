<?php 
	global $controle;
	global $action;
    session_start();
    
    if (count($_GET)!=0 && !isset($_GET['controle'])) {
        //cas d'un appel à index.php avec des paramètres incorrects
        require('./vue/erreur404.tpl');
    }
    else {
        if (count($_GET)==0) {
            $controle = 'utilisateur'; 
            $action = 'accueil'; //ou d'un appel à index.php sans paramètre...
        }
        
        if (isset($_GET['controle']) && isset($_GET['action'])) {
            $controle = $_GET['controle'];  //cas d'un appel à index.php 
            $action = $_GET['action']; //avec les 2 paramètres controle et action
        }
    }
    
    // echo 'controle : ' . $controle . '<br/>' . 'action : ' . $action . '<br/>' ;  //die();
    require('./controle/' . $controle . '.php');
    $action(); // On exécute la fonction dont le nom est dans la variable $action

?>