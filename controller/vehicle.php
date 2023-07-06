<?php 
/*controleur c2.php :
  fonctions-action de gestion (c2) 
*/

function show() 
{	
  require('./model/vehicleBD.php');
  $_SESSION['vehicules'] = getVehicule_BD(1, 'loueur', null);
  $url = './index.php?controller=user&action=accueil';
  header('Location:' . $url);
}

function get() 
{
  if (!isset($_SESSION['profil'])) {
    $url = './index.php?controller=user&action=ident';
    header('Location:' . $url);
  }
  else {
    require('./model/vehicleBD.php');
    // Affiche les vehicules en cours de location 

    if (isset($_GET['param']) && $_GET['param'] == 'vehicle-rent')
      $rent = true;
    else 
      $rent = false;

    // Affiche vehicle en stock 
    if (isset($_GET['param']) && $_GET['param'] == 'vehicle-home') {
      $id = "1"; $role = 'loueur';
    }
    // Affiche s vehicle en stock 
    else {
      $id = $_SESSION['profil']['id']; $role = $_SESSION['profil']['role'];
    }

    $_SESSION['vehicules'] = getVehicule_BD($id, $role, $rent);
    $controller = 'vehicle'; $action = 'card';
    require('./vue/layout.tpl');

    if ($_SESSION['profil']['role'] == 'loueur') {
      // fonction pour le loueur
    }
    else {
      // fonction pour le client
    }
  }
}


function add()
{
  // Définition des variables
  $nom = isset($_POST['nom']) ? test_input($_POST['nom']) : '';
  $type = isset($_POST['type']) ? test_input($_POST['type']) : '';
  $caract = isset($_POST['caract']) ? test_input($_POST['caract']) : '';
  $details = isset($_POST['details']) ? test_input($_POST['details']) : '';
  $prixJ = isset($_POST['prixJ']) ? test_input($_POST['prixJ']) : '';
  $prixM = isset($_POST['prixM']) ? test_input($_POST['prixM']) : '';
  $img = isset($_POST['img']) ? test_input($_POST['img']) : '';
  
  
  $msg = '';

  if (count($_POST)==0) {
    $controller = "vehicle"; $action = "add";
    require('./vue/layout.tpl');
  }
  else {
    require('./model/vehicleBD.php');
    
    if (!verif_ajout_input($nom, $type, $caract, $details, $prixJ, $prixM, $img)) {
        $msg = 'Erreur de saisie, veillez renseigner tous les champs s\'il vous plaît!';
        $controller = "vehicle"; $action = "add";
        require('./vue/layout.tpl');
    }
    else  ajouter_vehicule_BD($nom, $type, $caract, $details, $prixJ, $prixM, $img);
  }

  $controller = 'vehicle'; $action = 'add';
  $url = "./index.php?controller=vehicle&action=get&param=vehicle-stock";
  header('Location:' . $url);
}

// Vérifie si tous les champs du formulaire d'inscription sont
// correctement renseignés
function verif_ajout_input($nom, $type, $caract, $details, $prixJ, $prixM, $img) //: bool
{
  if (empty($nom) || empty($type) || empty($caract) || empty($details) || empty($prixJ) || empty($prixM) || empty($img) )
    return false;
  if (!verif_alpha_num($nom))
    return false;
  if (!verif_alpha_num($type) || !verif_alpha_num($caract))
    return false;
  if (!verif_num($prixJ) || !verif_num($prixM))
    return false;
  if (intval($prixJ) <= 0 || intval($prixM) < intval($prixJ))
    return false;

  return true;
}

function supprimer()
{   
  $idv = $_GET['param'];

  require('./model/vehiculeBD.php');

  supprimer_vehicule_BD($idv);

  $controller = 'vehicle'; $action = 'add';
  $url = "./index.php?controller=vehicle&action=get&param=vehicle-stock";
  header('Location:' . $url);
}

// Vérifie si une chaîne est alphabétique
function verif_alpha(string $str) : bool
{
  return preg_match("/^[a-zA-Z]+$/", $str);
}

// Vérifie si une chaîne est numérique
function verif_num(string $str) : bool
{
  return preg_match("/^[0-9 .]+$/", $str);
}

// Vérifie si une chaîne est alpha-numérique
function verif_alpha_num(string $str) : bool
{
  return preg_match("/^[a-zA-Z0-9. ]+$/", $str);
}

// Fonction test_input
function test_input(string $data) : string
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


function selection_flotte()
{
  if(!isset($_SESSION['profil'])) {
    $url = './index.php?controller=user&action=ident';
    header('Location:' . $url);
  }

  $id = $_SESSION['profil']['id'];
  $idv = $_GET['param'];

  require('./model/vehiculeBD.php');

  selection_flotte_BD($id, $idv);

  $controller = 'vehicle'; $action = 'get'; $param = 'vehicle-home';
  $url = "./index.php?controller=$controller&action=$action&param=$param";
  header('Location:' . $url);
}

function deselection_flotte()
{
  $idv = $_GET['param'];

    require('./model/vehiculeBD.php');

  deselection_flotte_BD($idv);

  $controller = 'vehicle'; $action = 'get';
  $url = "./index.php?controller=vehicle&action=get";
  header('Location:' . $url);
}


function modifier_dates()
{
  $idv = $_GET['param'];
  $debutL = isset($_POST['debut']) ? test_input($_POST['debut']) : '';
  $finL = isset($_POST['fin']) ? test_input($_POST['fin']) : '';

  if (count($_POST)==0) {
    $controller = "vehicle"; $action = "modifier_dates";
    require('./vue/layout.tpl');
  }
  else {
    require('./model/vehicleBD.php');

    if (!verif_dates_input($debutL, $finL)) {
      $msg = 'Erreur de saisie, Réessayer !';
      $controller = "vehicle"; $action = "modifier_dates";
      require('./vue/layout.tpl');
    }
    else {
      modifier_dates_BD($idv, $debutL, $finL);
      $controller = 'vehicle'; $action = 'get';
      $url = "./index.php?controller=vehicle&action=get";
      header('Location:' . $url);
    }
  }
}

function annuler()
{
  $idv = $_GET['param'];

  require('./model/vehicleBD.php');

  annuler_location_BD($idv);

  deselection_flotte();

}

function verif_dates_input($debutL, $finL) //: bool
{
  if (empty($debutL) || empty($finL)){
    return false;
  }

  if (!verif_date($debutL) || !verif_date($finL)){
    return false;
  }
  return true;
}

function verif_date($date)
{
    return preg_match("/[0-9]{4}\-[0-9]{2}\-[0-9]{2}/", $date);
}



function facture()
{
    $idE = 1;
    //$idE = $_GET['param'];

    require('./model/vehicleBD.php');

    /*prix d'une location*/
    $prixL = 0;

    /*prix total de la flotte*/
    $prixT = 0;

    /*date d'aujourd'hui*/
    $today = date('Y-m-d');

    /*calcule et affiche le prix de location pour chaque vehicle ligne par ligne (A compléter)*/
    for ($i = 0 ; $i == count(getFacture($idE)) ; $i++) {
        $debutL = getFacture($idE)['debutL'];
        $finL = getFacture($idE)['finL'];
        $prixJ = getFacture($idE)['prixJ'];
        $prixM = getFacture($idE)['prixM'];
        $nom = getFacture($idE)['nom'];

        if ($finL != null && substr($finL, 3) == substr($today, 5, -3)) {
            if (substr($finL, 5, -3) == substr($today, 5, -3) && substr($debutL, 5, -3) == substr($today, 5, -3)) {
                $dureeL = intval(substr($finL, 1)) - intval(substr($debutL, 1));

                if ($dureeL == 0)
                    $prixL = $prixJ;
                else if ($dureeL == getJoursMois(intval(substr($today, 5, -3))) - 1)
                    $prixL = $prixM;
                else
                    $prixL =  $dureeL * $prixJ ;

            }
            else if (substr($finL, 5, -3) == substr($today, 5, -3) && intval(substr($debutL, 5, -3)) < intval(substr($today, 5, -3))) {
                $dureeL = intval(substr($finL, 8, 0));
                if ($dureeL == getJoursMois(intval(substr($today, 5, -3))) - 1)
                    $prixL = $prixM;
                else
                    $prixL =  $dureeL * $prixJ ;
            }
            else if(intval(substr($finL, 5, -3)) > intval(substr($today, 5, -3)) 
                    && intval(substr($debutL, 5, -3)) == intval(substr($today, 5, -3))) {
                $dureeL = getJoursMois(intval(substr($today, 5, -3))) - intval(substr($today, 8, 0));
                if ($dureeL == getJoursMois(intval(substr($today, 5, -3))) - 1)
                    $prixL = $prixM;
                else
                    $prixL =  $dureeL * $prixJ ;
            }
            echo $nom . '          ' . $prixL;
        }else{
            $prixL = $prixM;
                echo $nom . '          ' . $prixL;
        }
    }
    /*calcule le montant total de la flotte de vehicules*/
    foreach (getFacture($idE) as $vehicle) {

        $debutL = $vehicle['debutL'];
        $finL = $vehicle['finL'];
        $prixJ = $vehicle['prixJ'];
        $prixM = $vehicle['prixM'];

        if ($finL != null && substr($finL, 3) == substr($today, 5, -3)) {
            if (substr($finL, 5, -3) == substr($today, 5, -3) && substr($debutL, 5, -3) == substr($today, 5, -3)) {
                $dureeL = intval(substr($finL, 1)) - intval(substr($debutL, 1));

                if ($dureeL == 0)
                    $prixL += $prixJ;
                else if ($dureeL == getJoursMois(intval(substr($today, 5, -3))) - 1)
                    $prixL += $prixM;
                else
                    $prixL +=  $dureeL * $prixJ ;

            }
            else if (substr($finL, 5, -3) == substr($today, 5, -3) && intval(substr($debutL, 5, -3)) < intval(substr($today, 5, -3))) {
                $dureeL = intval(substr($finL, 8, 0));
                if ($dureeL == getJoursMois(intval(substr($today, 5, -3))) - 1)
                    $prixL += $prixM;
                else
                    $prixL +=  $dureeL * $prixJ ;
            }
            else if(intval(substr($finL, 5, -3)) > intval(substr($today, 5, -3)) 
                    && intval(substr($debutL, 5, -3)) == intval(substr($today, 5, -3))) {
                $dureeL = getJoursMois(intval(substr($today, 5, -3))) - intval(substr($today, 8, 0));
                if ($dureeL == getJoursMois(intval(substr($today, 5, -3))) - 1)
                    $prixL += $prixM;
                else
                    $prixL +=  $dureeL * $prixJ ;
            }
        }else{
            $prixL += $prixM;
        }
    }
    if (count(getFacture($idE) >= 10)) {
        $prixT = $prixT - ($prixT*0.10);
    }
 
    $_SESSION['montant'] = $prixT;
}

function getJoursMois($mois) {

    if ($mois == 02)
        return 28;
    else if  ($mois == 1 || $mois == 2 || $mois == 5 || $mois == 7 || $mois == 8 || $mois == 10 || $mois == 12)
        return 31;

    return 30;
}


?>








