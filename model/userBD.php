<?php
// Vérifie si le client est présent dans la base de données
function verif_ident_customer_BD($ident, $password, &$profile)
{
    require('./model/connectBD.php');
    try {
        $sql = "SELECT * FROM `customer` WHERE username=:ident OR email=:ident";
        $command = $pdo->prepare($sql);
        $command->bindParam(':ident', $ident);
        $bool = $command->execute();

        if ($bool) {
            $result = $command->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) != 0 && password_verify($password, $result[0]['password'])) {
                $profile = $result[0];
                $profile['role'] = 'customer';
                return true;
            }
        }
    } catch (PDOException $e) {
        echo utf8_encode('Echec de select : ' . $e->getMessage() . '\n');
        die();
    }

    $profile = array();
    return false;
}

// Vérifie si le vendeur est présent dans la base de données
function verif_ident_seller_BD($ident, $password, &$profile)
{
    require('./model/connectBD.php');
    try {
        $sql = "SELECT * FROM `seller` WHERE username=:ident OR email=:ident";
        $command = $pdo->prepare($sql);
        $command->bindParam(':ident', $ident);
        $bool = $command->execute();

        if ($bool) {
            $result = $command->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) != 0 && password_verify($password, $result[0]['password'])) {
                $profile = $result[0];
                $profile['role'] = 'seller';
                return true;
            }
        }
    } catch (PDOException $e) {
        echo utf8_encode('Echec de select : ' . $e->getMessage() . '\n');
        die();
    }

    $profile = array();
    return false;
}

// Vérifie si l'administrateur est présent dans la base de données
function verif_ident_admin_BD($ident, $password, &$profile)
{
    require('./model/connectBD.php');
    try {
        $sql = "SELECT * FROM `admin` WHERE username=:ident OR email=:ident";
        $command = $pdo->prepare($sql);
        $command->bindParam(':ident', $ident);
        $bool = $command->execute();

        if ($bool) {
            $result = $command->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) != 0 && password_verify($password, $result[0]['password'])) {
                $profile = $result[0];
                $profile['role'] = 'admin';
                return true;
            }
        }
    } catch (PDOException $e) {
        echo utf8_encode('Echec de select : ' . $e->getMessage() . '\n');
        die();
    }

    $profile = array();
    return false;
}

// Insère un nouveau client dans la base de données
function inscr_BD($name, $username, $email, $password, $address, $type)
{
    require('./model/connectBD.php');
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Cryptage du mot de passe

    if ($type == "Admin") {
        $sql = "INSERT INTO `admin` (name, username, email, password, address) VALUES (:name, :username, :email, :password, :address)";
    } else {
        $sql = "INSERT INTO `seller` (name, username, email, password, address) VALUES (:name, :username, :email, :password, :address)";
    }

    try {
        $command = $pdo->prepare($sql);
        $command->bindParam(':name', $name);
        $command->bindParam(':username', $username);
        $command->bindParam(':email', $email);
        $command->bindParam(':password', $hashedPassword); // Enregistrement du mot de passe crypté
        $command->bindParam(':address', $address);
        $bool = $command->execute();

        if ($bool) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo utf8_encode('Echec de insert into : ' . $e->getMessage() . '.\n');
        die();
    }
}

// Step 4: Send order confirmation email to the customer
function send_confirmation_email($email, $name, $vehicle_name, $total_amount)
{
    // Your email sending code here (using libraries like PHPMailer, SwiftMailer, etc.)
    // This is just a placeholder to demonstrate the function.
    // Make sure to use proper email libraries and configurations for production.
    $subject = 'Order Confirmation';
    $message = "Dear $name,\n\nThank you for your order. We are pleased to confirm your purchase of $vehicle_name.\n\nTotal Amount: $total_amount\n\nRegards,\nThe XYZ Store";
    $headers = "From: your@example.com\r\n";
    mail($email, $subject, $message, $headers);
}

function handle_payment($customerId, $name, $addressLine1, $addressLine2, $city, $postalCode)
{

    // Include the database connection file
    require('./model/connectBD.php');

    // Vérifier si le paiement est réussi (vous pouvez ajouter votre logique de paiement ici)
    $paymentSuccess = true; // Modifier selon votre logique de paiement

    if ($paymentSuccess) {
        // Enregistrement des détails de livraison dans la table 'delivery'
        $insertSuccess = insert_delivery_details($customerId, $name, $addressLine1, $addressLine2, $city, $postalCode);

        return true;
    } else {
        return false; // Échec du paiement, ne pas enregistrer les détails de livraison
    }
}


function insert_delivery_details($customerId, $name, $addressLine1, $addressLine2, $city, $postalCode)
{
    // Include the database connection file
    require('./model/connectBD.php');

    // Prepare the SQL statement to insert data into the 'delivery' table
    $sql = "INSERT INTO `delivery` (customerId, name, addressLine1, addressLine2, city, postalCode) VALUES (:customerId, :name, :addressLine1, :addressLine2, :city, :postalCode)";
    try {
        $command = $pdo->prepare($sql);
        $command->bindParam(':customerId', $customerId);
        $command->bindParam(':name', $name);
        $command->bindParam(':addressLine1', $addressLine1);
        $command->bindParam(':addressLine2', $addressLine2);
        $command->bindParam(':city', $city);
        $command->bindParam(':postalCode', $postalCode);
        $bool = $command->execute();

        if ($bool) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo utf8_encode('Echec de insert into : ' . $e->getMessage() . '.\n');
        die();
    }
}



// Met à jour les informations du profil de l'utilisateur dans la base de données
function update_BD($name, $username, $email, $password, $address, $photo)
{
    require('./model/connectBD.php');
    $sql = "UPDATE `admin` SET name = :name, username = :username, email = :email, password = :password, address = :address, photo = :photo WHERE id = :id";
    try {
        $command = $pdo->prepare($sql);
        $command->bindParam(':name', $name);
        $command->bindParam(':username', $username);
        $command->bindParam(':email', $email);
        $command->bindParam(':password', $password);
        $command->bindParam(':address', $address);
        $command->bindParam(':photo', $photo);
        $command->bindParam(':id', $_SESSION['profile']['id']);
        $bool = $command->execute();

        return $bool;
    } catch (PDOException $e) {
        echo utf8_encode('Échec de la requête UPDATE : ' . $e->getMessage() . '.\n');
        die();
    }
}


// Vérifie si une adresse e-mail est déjà utilisée par un autre client
function verif_inscr_BD_valid_email($email)
{
    require('./model/connectBD.php');
    try {
        $sql = "SELECT * FROM `customer` WHERE email=:email";
        $command = $pdo->prepare($sql);
        $command->bindParam(':email', $email);
        $bool = $command->execute();

        if ($bool) {
            $result = $command->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        echo utf8_encode('Echec de select : ' . $e->getMessage() . '\n');
        die();
    }

    if (count($result) == 0) {
        return true;
    } else {
        return false;
    }
}

// Vérifie si un nom d'utilisateur est déjà utilisé par un autre client
function verif_inscr_BD_valid_username($username)
{
    require('./model/connectBD.php');
    try {
        $sql = "SELECT * FROM `customer` WHERE username=:username";
        $command = $pdo->prepare($sql);
        $command->bindParam(':username', $username);
        $bool = $command->execute();

        if ($bool) {
            $result = $command->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        echo utf8_encode('Echec de select : ' . $e->getMessage() . '\n');
        die();
    }

    if (count($result) == 0) {
        return true;
    } else {
        return false;
    }
}
function add_BD($name, $username, $email, $password, $address,$type)
{
    require('./model/connectBD.php');
    if ($type=="Admin"){
        $sql = "INSERT INTO `admin` (name, username, email, password, address)
                VALUES (:name, :username, :email, :password, :address)";
    }else{
        $sql = "INSERT INTO `seller` (name, username, email, password, address)
                VALUES (:name, :username, :email, :password, :address)";
    }

    try {
        $command = $pdo->prepare($sql);
        $command->bindParam(':name', $name);
        $command->bindParam(':username', $username);
        $command->bindParam(':email', $email);
        $command->bindParam(':password', $password);
        $command->bindParam(':address', $address);
        $bool = $command->execute();

        if ($bool) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo utf8_encode('Echec de insert into : ' . $e->getMessage() . '.\n');
        die();
    }
}
?>
