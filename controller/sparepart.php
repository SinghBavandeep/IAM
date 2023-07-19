<?php 
/*controleur c2.php :
  fonctions-action de gestion (c2) 
*/

function show() 
{	
  require('./model/sparepartBD.php');
  $_SESSION['SparePart'] = getSparePart_BD(1, 'admin', null);
  $url = './index.php?controller=user&action=home';
  header('Location:' . $url);
}

function get() 
{
  if (!isset($_SESSION['profile'])) {
    $url = './index.php?controller=user&action=ident';
    header('Location:' . $url);
  }
  else {
    require('./model/sparepart.php');
    // Affiche les SparePart en cours de location

    if (isset($_GET['param']) && $_GET['param'] == 'sparepart-rent')
      $rent = true;
    else 
      $rent = false;

    // Affiche sparepart en stock 
    if (isset($_GET['param']) && $_GET['param'] == 'sparepart-home') {
      $id = "1"; $role = 'admin';
    }
    // Affiche s sparepart en stock 
    else {
      $id = $_SESSION['profile']['id']; $role = $_SESSION['profile']['role'];
    }

    $_SESSION['admin'] = getSparePart_BD($id, $role, $rent);
    $controller = 'sparepart'; $action = 'spare_part';
    require('./view/layout.tpl');

    if ($_SESSION['profile']['role'] == 'admin') {
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
  $prixM = isset($_POST['prixM']) ? test_input($_POST['prixM']) : '';
  $img = isset($_POST['img']) ? test_input($_POST['img']) : '';
  
  
  $msg = '';

  if (count($_POST)==0) {
    $controller = "sparepart"; $action = "add";
    require('./view/layout.tpl');
  }
  else {
    require('./model/sparepartBD.php');
    
    if (!verif_ajout_input($nom, $type, $caract, $details, $prixM, $img)) {
        $msg = 'Erreur de saisie, veillez renseigner tous les champs s\'il vous plaît!';
        $controller = "sparepart"; $action = "add";
        require('./view/layout.tpl');
    }
    else  ajouter_vehicule_BD($nom, $type, $caract, $details, $prixM, $img);
  }

  $controller = 'sparepart'; $action = 'add';
  $url = "./index.php?controller=sparepart&action=get&param=sparepart-stock";
  header('Location:' . $url);
}

// Vérifie si tous les champs du formulaire d'inscription sont
// correctement renseignés
function verif_ajout_input($nom, $type, $caract, $details, $prixM, $img) //: bool
{
  if (empty($nom) || empty($type) || empty($caract) || empty($details) || empty($prixM) || empty($img) )
    return false;
  if (!verif_alpha_num($nom))
    return false;
  if (!verif_alpha_num($type) || !verif_alpha_num($caract))
    return false;
  if (!verif_num($prixM))
    return false;
  if (intval($prixM) <= 0 )
    return false;

  return true;
}

function supprimer()
{   
  $idv = $_GET['param'];

  require('./model/sparepartBD.php');

  supprimer_vehicule_BD($idv);

  $controller = 'sparepart'; $action = 'add';
  $url = "./index.php?controller=sparepart&action=get&param=sparepart-stock";
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
  if(!isset($_SESSION['profile'])) {
    $url = './index.php?controller=user&action=ident';
    header('Location:' . $url);
  }

  $id = $_SESSION['profile']['id'];
  $idv = $_GET['param'];

  require('./model/sparepartBD.php');

  selection_flotte_BD($id, $idv);

  $controller = 'sparepart'; $action = 'get'; $param = 'sparepart-home';
  $url = "./index.php?controller=$controller&action=$action&param=$param";
  header('Location:' . $url);
}

function deselection_flotte()
{
  $idv = $_GET['param'];

    require('./model/sparepartBD.php');

  deselection_flotte_BD($idv);

  $controller = 'sparepart'; $action = 'get';
  $url = "./index.php?controller=sparepart&action=get";
  header('Location:' . $url);
}


function modifier_dates()
{
  $idv = $_GET['param'];
  $debutL = isset($_POST['debut']) ? test_input($_POST['debut']) : '';
  $finL = isset($_POST['fin']) ? test_input($_POST['fin']) : '';

  if (count($_POST)==0) {
    $controller = "sparepart"; $action = "modifier_dates";
    require('./view/layout.tpl');
  }
  else {
    require('./model/sparepartBD.php');

    if (!verif_dates_input($debutL, $finL)) {
      $msg = 'Erreur de saisie, Réessayer !';
      $controller = "sparepart"; $action = "modifier_dates";
      require('./view/layout.tpl');
    }
    else {
      modifier_dates_BD($idv, $debutL, $finL);
      $controller = 'sparepart'; $action = 'get';
      $url = "./index.php?controller=sparepart&action=get";
      header('Location:' . $url);
    }
  }
}

function annuler()
{
  $idv = $_GET['param'];

  require('./model/sparepartBD.php');

  annuler_location_BD($idv);

  deselection_flotte();

}

function verif_date($date)
{
    return preg_match("/[0-9]{4}\-[0-9]{2}\-[0-9]{2}/", $date);
}



function bill()
{
    $idE = 1;
    //$idE = $_GET['param'];

    require('./model/sparepartBD.php');

    /*prix d'une location*/
    $prixL = 0;

    /*prix total de la flotte*/
    $prixT = 0;

    /*date d'aujourd'hui*/
    $today = date('Y-m-d');

    /*calcule et affiche le prix de location pour chaque sparepart ligne par ligne (A compléter)*/
    for ($i = 0 ; $i == count(getFacture($idE)) ; $i++) {
        $prixM = getFacture($idE)['prixM'];
        $nom = getFacture($idE)['nom'];

        $prixL = $prixM;
        echo $nom . '          ' . $prixL;
        
    }
    /*calcule le montant total de la flotte de admin*/
    foreach (getFacture($idE) as $sparepart) {

        $prixM = $sparepart['prixM'];
        $prixL += $prixM;
       
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









