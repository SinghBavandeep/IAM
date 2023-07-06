<?php 
	global $controller;
	global $action;
    session_start();
    
    if (count($_GET)!=0 && !isset($_GET['controller'])) {
        //cas d'un appel à index.php avec des paramètres incorrects
        require('./view/erreur404.tpl');
    }
    else {
        if (count($_GET)==0) {
            $controller = 'utilisateur'; 
            $action = 'accueil'; //ou d'un appel à index.php sans paramètre...
        }
        
        if (isset($_GET['controller']) && isset($_GET['action'])) {
            $controller = $_GET['controller'];  //cas d'un appel à index.php 
            $action = $_GET['action']; //avec les 2 paramètres controller et action
        }
    }
    
    // echo 'controller : ' . $controller . '<br/>' . 'action : ' . $action . '<br/>' ;  //die();
    require('./controller/' . $controller . '.php');
    $action(); // On exécute la fonction dont le nom est dans la variable $action

?>