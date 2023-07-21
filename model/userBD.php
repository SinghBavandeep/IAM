<?php
// Vérifie si le client est présent dans la base de données
// vérifie si le customer est présent dans la base de données.
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
                $result[0]['role'] = 'admin';
            } else {
                return false; // Mot de passe incorrect
            }
        }
    } catch (PDOException $e) {
        echo utf8_encode('Echec de select : ' . $e->getMessage() . '\n');
        die();
    }

    if (count($result) == 0) {
        $profile = array();
        return false;
    } else {
        $profile = $result[0];
        return true;
    }
}


// Insère un nouveau client dans la base de données
// Insère un nouveau client dans la base de données
function inscr_BD($name, $username, $email, $password, $address, $photo)
{
    require('./model/connectBD.php');
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Cryptage du mot de passe

    $sql = "INSERT INTO `customer` (name, username, email, password, address, photo) VALUES (:name, :username, :email, :password, :address, :photo)";
    try {
        $command = $pdo->prepare($sql);
        $command->bindParam(':name', $name);
        $command->bindParam(':username', $username);
        $command->bindParam(':email', $email);
        $command->bindParam(':password', $hashedPassword); // Enregistrement du mot de passe crypté
        $command->bindParam(':address', $address);
        $command->bindParam(':photo', $photo);
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
    // You should use a library or email sending method appropriate for your environment
    // (e.g., PHPMailer, SwiftMailer, etc.). Here's an example of sending a basic email using PHP's mail() function:

    $to = $email;
    $subject = "Order Confirmation";

    // The body of the confirmation message
    $message = "Hello $name,\n\n";
    $message .= "Thank you for placing an order on our website.\n";
    $message .= "Here are the details of your order:\n";
    $message .= "- Vehicle/Spare Part: $vehicle_name\n";
    $message .= "- Total Amount: $total_amount\n\n";
    $message .= "Your order is being processed.\n";
    $message .= "We will send you a notification once it is shipped.\n\n";
    $message .= "Best regards,\n";
    $message .= "The Team at Our Website";

    // Sending the email
    $headers = "From: noreply@yoursite.com" . "\r\n" .
        "Reply-To: noreply@yoursite.com" . "\r\n" .
        "X-Mailer: PHP/" . phpversion();

    // Using the mail() function to send the email
    // (make sure your server is configured to send emails)
    mail($to, $subject, $message, $headers);
}

// In the handle_payment() function, add the call to send_confirmation_email() after the payment is validated:
function handle_payment($customerId, $name, $addressLine1, $addressLine2, $city, $postalCode, $country, $phoneNumber)
{
    // Step 1: Insert delivery details into the 'delivery' table
    require('./model/userBD.php');
    if (!insert_delivery_details($customerId, $name, $addressLine1, $addressLine2, $city, $postalCode, $country, $phoneNumber)) {
        return false; // Failed to save delivery details
    }

    return true;
}


function insert_delivery_details($customerId, $name, $addressLine1, $addressLine2, $city, $postalCode, $country, $phoneNumber)
{
    // Include the database connection file
    require('./model/connectBD.php');

    // Prepare the SQL statement to insert data into the 'delivery' table
    $sql = "INSERT INTO `delivery` (customerId, name, addressLine1, addressLine2, city, postalCode, country, phoneNumber) VALUES (:customerId, :name, :addressLine1, :addressLine2, :city, :postalCode, :country, :phoneNumber)";
    try {
        $command = $pdo->prepare($sql);
        $command->bindParam(':customerId', $customerId);
        $command->bindParam(':name', $name);
        $command->bindParam(':addressLine1', $addressLine1);
        $command->bindParam(':addressLine2', $addressLine2); // Enregistrement du mot de passe crypté
        $command->bindParam(':city', $city);
        $command->bindParam(':postalCode', $postalCode);
        $command->bindParam(':country', $country);
        $command->bindParam(':phoneNumber', $phoneNumber);
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
