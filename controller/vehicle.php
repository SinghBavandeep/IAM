<?php 
/*controleur c2.php :
  fonctions-action de gestion (c2) 
*/

function show()
{	
  require('./model/vehicleBD.php');
  $_SESSION['vehicles'] = getVehicle_BD(1, 'admin', null);
  $url = './index.php?controller=user&action=home';
  header('Location:' . $url);
}

function getVehicles()
{
  if (!isset($_SESSION['profile'])) {
    $url = './index.php?controller=user&action=ident';
    header('Location:' . $url);
  }
  else {
    require('./model/vehicleBD.php');
    // Affiche les vehicles en cours de location 

    if (isset($_GET['param']) && $_GET['param'] == 'vehicle-rent')
      $rent = true;
    else 
      $rent = false;

    // Affiche vehicle en stock 
    if (isset($_GET['param']) && $_GET['param'] == 'vehicle-home') {
      $id = "1"; $role = 'admin';
    }
    // Affiche s vehicle en stock 
    else {
      $id = $_SESSION['profile']['id']; $role = $_SESSION['profile']['role'];
    }

    $_SESSION['admin'] = getVehicle_BD($id, $role, $rent);
    $controller = 'vehicle'; $action = 'vehicle';
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
  $name = isset($_POST['name']) ? test_input($_POST['name']) : '';
  $type = isset($_POST['type']) ? test_input($_POST['type']) : '';
  $caract = isset($_POST['caract']) ? test_input($_POST['caract']) : '';
  $details = isset($_POST['details']) ? test_input($_POST['details']) : '';
  $prixM = isset($_POST['prixM']) ? test_input($_POST['prixM']) : '';
  $img = isset($_POST['img']) ? test_input($_POST['img']) : '';
  
  
  $msg = '';

  if (count($_POST)==0) {
    $controller = "vehicle"; $action = "add";
    require('./view/layout.tpl');
  }
  else {
    require('./model/vehicleBD.php');
    
    if (!verif_ajout_input($name, $type, $caract, $details, $prixM, $img)) {
        $msg = 'Imput error!';
        $controller = "vehicle"; $action = "add";
        require('./view/layout.tpl');
    }
    else  add_vehicle_BD($name, $type, $caract, $details, $prixM, $img);
  }

  $controller = 'user'; $action = 'vehicle_stock';
  require('./view/layout.tpl');
}

// Vérifie si tous les champs du formulaire d'inscription sont
// correctement renseignés
function verif_ajout_input($name, $type, $caract, $details, $prixM, $img) //: bool
{
  if (empty($name) || empty($type) || empty($caract) || empty($details) || empty($prixM) || empty($img) )
    return false;
  if (!verif_alpha_num($name))
    return false;
  if (!verif_alpha_num($type) || !verif_alpha_num($caract))
    return false;
  if (!verif_num($prixM))
    return false;
  if (intval($prixM) <= 0 )
    return false;

  return true;
}

function delete()
{   
  $idv = $_GET['param'];

  require('./model/vehicleBD.php');

  delete_vehicle_BD($idv);

  $controller = 'user'; $action = 'vehicle_stock';
  require('./view/layout.tpl');
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

  require('./model/vehicleBD.php');

  selection_flotte_BD($id, $idv);

  $controller = 'vehicle'; $action = 'getVehicles'; $param = 'vehicle-home';
  $url = "./index.php?controller=$controller&action=$action&param=$param";
  header('Location:' . $url);
}

function deselection_flotte()
{
  $idv = $_GET['param'];

    require('./model/vehicleBD.php');

  deselection_flotte_BD($idv);

  $controller = 'vehicle'; $action = 'getVehicles';
  $url = "./index.php?controller=vehicle&action=getVehicles";
  header('Location:' . $url);
}

function bill()
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
        $prixM = getFacture($idE)['prixM'];
        $name = getFacture($idE)['name'];

        $prixL = $prixM;
        echo $name . '          ' . $prixL;
        
    }
    /*calcule le montant total de la flotte de admin*/
    foreach (getFacture($idE) as $vehicle) {

        $prixM = $vehicle['prixM'];
        $prixL += $prixM;
       
    }
    if (count(getFacture($idE) >= 10)) {
        $prixT = $prixT - ($prixT*0.10);
    }
 
    $_SESSION['montant'] = $prixT;
}


function add_to_cart()
{

  // Check if the cart exists in the session, and create it if it doesn't
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }

  // Get the vehicle ID from the query parameters
  if (isset($_GET['id'])) {
    $vehicle_id = $_GET['ref'];
    var_dump($vehicle_id);
    die();

    // Get the customer ID from the session (assuming it's stored in $_SESSION['id'])
    $customer_id = $_SESSION['id'] ?? 0;

    if ($customer_id > 0) {
      // Add the vehicle to the cart for the specific customer
      // Use a multi-dimensional array to store cart data for each customer
      if (!isset($_SESSION['cart'][$customer_id])) {
        $_SESSION['cart'][$customer_id] = array();
      }

      // Check if the vehicle is already in the cart, and increase the quantity if it is
      if (isset($_SESSION['cart'][$customer_id][$vehicle_id])) {
        $_SESSION['cart'][$customer_id][$vehicle_id]++;
      } else {
        // If the vehicle is not in the cart, add it with quantity 1
        $_SESSION['cart'][$customer_id][$vehicle_id] = 1;
      }

      // Update the 'idC' field in the 'vehicle' table with the customer ID
      $conn = mysqli_connect("localhost", "root", "", "project");
      $sql = "UPDATE vehicle SET idC = $customer_id WHERE ref = $vehicle_id";
      mysqli_query($conn, $sql);
      mysqli_close($conn);

      // Redirect back to the vehicle page or cart page
      header('Location: ./index.php?controller=vehicle&action=getVehicles');
      exit(); // Always exit after a header redirect to prevent further execution of the script
    } else {
      // Customer not logged in, handle the error (e.g., redirect to login page)
      header('Location: ./index.php?controller=login'); // Redirect to the login page or an error page
      exit();
    }
  } else {
    // Vehicle ID not provided, handle the error (e.g., redirect to home page)
    header('Location: ./index.php'); // Redirect to the home page or an error page
    exit();
  }
}




?>









