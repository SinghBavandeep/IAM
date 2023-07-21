<?php
/* controller sparepart.php:
   functions-actions for spare part management
*/

// Function to show spare parts
function show()
{
  require('./model/sparepartBD.php');

  // Get spare parts for the admin (ID = 1)
  $_SESSION['spare_parts'] = getSparePart_BD(1, 'admin', null);

  // Redirect to the home page
  $url = './index.php?controller=user&action=home';
  header('Location:' . $url);
}

// Function to get spare parts
function getSpareParts()
{
  if (!isset($_SESSION['profile'])) {
    // Redirect to the login page if the user is not logged in
    $url = './index.php?controller=user&action=ident';
    header('Location:' . $url);
  } else {
    require('./model/sparepartBD.php');

    // Check if we need to display rented spare parts
    if (isset($_GET['param']) && $_GET['param'] == 'sparepart-rent')
      $rent = true;
    else
      $rent = false;

    // Check if we need to display spare parts for the admin or the customer
    if (isset($_GET['param']) && $_GET['param'] == 'sparepart-home') {
      $id = 1;
      $role = 'admin';
    } else {
      $id = $_SESSION['profile']['id'];
      $role = $_SESSION['profile']['role'];
    }

    // Get the spare parts from the database
    $_SESSION['spare_parts'] = getSparePart_BD($id, $role, $rent);

    // Load the view
    $controller = 'sparepart';
    $action = 'sparepart';
    require('./view/layout.tpl');

    // Perform different actions based on the user role (admin or customer)
    if ($_SESSION['profile']['role'] == 'admin') {
      // Functions for the admin
    } else {
      // Functions for the customer
    }
  }
}



function add()
{
  // Définition des variables
  $name = isset($_POST['name']) ? test_input($_POST['name']) : '';
  $type = isset($_POST['type']) ? test_input($_POST['type']) : '';
  $caract = isset($_POST['caract']) ? test_input($_POST['caract']) : '';
  $details = isset($_POST['details']) ? test_input($_POST['details']) : '';
  $prixM = isset($_POST['prixM']) ? test_input($_POST['prixM']) : '';
  $img = isset($_POST['img']) ? test_input($_POST['img']) : '';

  $msg = '';

  if (count($_POST) == 0) {
    $controller = "sparepart"; $action = "add";
    require('./view/layout.tpl');
  } else {
    require('./model/sparepartBD.php');

    if (!verif_ajout_input($name, $type, $caract, $details, $prixM, $img)) {
      $msg = 'Erreur de saisie, veuillez renseigner tous les champs s\'il vous plaît!';
      $controller = "sparepart"; $action = "add";
      require('./view/layout.tpl');
    } else {
      ajouter_SparePart_BD($name, $type, $caract, $details, $prixM, $img);
      $controller = 'sparepart'; $action = 'getSpareParts'; $param = 'sparepart-stock';
      $url = "./index.php?controller=$controller&action=$action&param=$param";
      header('Location:' . $url);
    }
  }
}

// Vérifie si tous les champs du formulaire d'inscription sont
// correctement renseignés
function verif_ajout_input($name, $type, $caract, $details, $prixM, $img) //: bool
{
  if (empty($name) || empty($type) || empty($caract) || empty($details) || empty($prixM) || empty($img))
    return false;
  if (!verif_alpha_num($name))
    return false;
  if (!verif_alpha_num($type) || !verif_alpha_num($caract))
    return false;
  if (!verif_num($prixM))
    return false;
  if (intval($prixM) <= 0)
    return false;

  return true;
}

function supprimer()
{
  $idv = $_GET['param'];

  require('./model/sparepartBD.php');

  supprimer_SparePart_BD($idv);

  $controller = 'sparepart'; $action = 'add';
  $url = "./index.php?controller=sparepart&action=getSpareParts&param=sparepart-stock";
  header('Location:' . $url);
}

// Vérifie si une chaîne est alphabétique
function verif_alpha(string $str): bool
{
  return preg_match("/^[a-zA-Z]+$/", $str);
}

// Vérifie si une chaîne est numérique
function verif_num(string $str): bool
{
  return preg_match("/^[0-9 .]+$/", $str);
}

// Vérifie si une chaîne est alpha-numérique
function verif_alpha_num(string $str): bool
{
  return preg_match("/^[a-zA-Z0-9. ]+$/", $str);
}

// Fonction test_input
function test_input(string $data): string
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function selection_flotte()
{
  if (!isset($_SESSION['profile'])) {
    $url = './index.php?controller=user&action=ident';
    header('Location:' . $url);
  }

  $id = $_SESSION['profile']['id'];
  $idv = $_GET['param'];

  require('./model/sparepartBD.php');

  selection_flotte_BD($id, $idv);

  $controller = 'sparepart'; $action = 'getSpareParts'; $param = 'sparepart-home';
  $url = "./index.php?controller=$controller&action=$action&param=$param";
  header('Location:' . $url);
}

function deselection_flotte()
{
  $idv = $_GET['param'];

  require('./model/sparepartBD.php');

  deselection_flotte_BD($idv);

  $controller = 'sparepart'; $action = 'getSpareParts';
  $url = "./index.php?controller=sparepart&action=getSpareParts";
  header('Location:' . $url);
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
  foreach (getFacture($idE) as $sparepart) {
    $prixM = $sparepart['prixM'];
    $name = $sparepart['name'];

    $prixL = $prixM;
    echo $name . '          ' . $prixL;

  }
  /*calcule le montant total de la flotte de admin*/
  foreach (getFacture($idE) as $sparepart) {
    $prixM = $sparepart['prixM'];
    $prixT += $prixM;
  }
  if (count(getFacture($idE)) >= 10) {
    $prixT = $prixT - ($prixT * 0.10);
  }

  $_SESSION['montant'] = $prixT;
}

function add_to_cart()
{
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }

  $sparepart_id = $_GET['id'];

  // Add the vehicle to the cart (You can customize how you store the cart data)
  $_SESSION['cart'][$sparepart_id] = 1; // You can set the quantity to 1 for now, or use the input quantity from the vehicle.tpl file

  // Redirect back to the vehicle page or cart page
  header('Location: ./index.php?controller=sparepart&action=getSpareParts');
}

?>
