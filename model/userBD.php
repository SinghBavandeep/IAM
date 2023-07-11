<?php 

    // vérifie si le customer est présent dans la base de donnée.
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
                $result[0]['role'] = 'customer';
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


// vérifie si le loueur est présent dans la base de donnée.
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


// insère un nouveau customer dans la base de donnée.
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

            if ($bool) return true;
            else return false;
        }

        catch (PDOException $e) {
            echo utf8_encode('Echec de insert into : ' . $e->getMessage() . '.\n');
            die();
        }
    }

function update_BD($name, $username, $email, $password, $address, $photo)
{
    require('./model/connectBD.php');
    $sql = "UPDATE `admin` SET name = :name, email = :email, password = :password, address = :address, photo = :photo WHERE $username = :username";
    try {
        $command = $pdo->prepare($sql);
        $command->bindParam(':name', $name);
        $command->bindParam(':username', $username);
        $command->bindParam(':email', $email);
        $command->bindParam(':password', $password);
        $command->bindParam(':address', $address);
        $command->bindParam(':photo', $photo);
        $bool = $command->execute();

        if ($bool) return true;
        else return false;
    } catch (PDOException $e) {
        echo utf8_encode('Échec de la requête UPDATE : ' . $e->getMessage() . '.\n');
        die();
    }


}


    // vérifie si un email est présent dans la base de donnée.
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
                // var_dump($Resultat); die();
            }
        }
        catch (PDOException $e) {
            echo utf8_encode('Echec de select : ' . $e->getMessage() . '\n');
            die();
        }

        if (count($result)==0) return true;
        else return false;
    }

    // vérifie si un pseudo est présent dans la base de donnée.
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
                // var_dump($Resultat); die();
            }
        }
        catch (PDOException $e) {
            echo utf8_encode('Echec de select : ' . $e->getMessage() . '\n');
            die();
        }

        if (count($result)==0) return true;
        else return false;
    }
    

?>
