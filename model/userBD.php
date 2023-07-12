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
function inscr_BD($name, $username, $email, $password, $address)
{
    require('./model/connectBD.php');
    $sql = "INSERT INTO `customer` (name, username, email, password, address)
                VALUES (:name, :username, :email, :password, :address)";
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
?>
