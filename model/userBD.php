<?php 

    // vérifie si le customer est présent dans la base de donnée.
    function verif_ident_customer_BD($ident, $password, &$profile)
    {
        require('./model/connectBD.php');
        try {
            $sql = "SELECT * FROM `customer` WHERE username=:ident AND password=:password OR email=:ident AND password=:password";
            $command = $pdo->prepare($sql);
            $command->bindParam(':ident', $ident);
            $command->bindParam(':password', $password);
            $bool = $command->execute();
    
            if ($bool) {
                $result = $command->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) != 0) $result[0]['role'] = 'customer';
            }
        }
        catch (PDOException $e) {
            echo utf8_encode('Echec de select : ' . $e->getMessage() . '\n');
            die();
        }
        if (count($result)==0) {
            $profile = array(); // retourne un tableau vide
            return false;
        }
        else {
            $profile = $result[0];
            return true;
        }
    }

    // vérifie si le loueur est présent dans la base de donnée.
    function verif_ident_admin_BD($ident, $password, &$profile)
    {
        require('./model/connectBD.php');
        try {
            $sql = "SELECT * FROM `admin` WHERE username=:ident AND password=:password OR email=:ident AND password=:password";
            $command = $pdo->prepare($sql);
            $command->bindParam(':ident', $ident);
            $command->bindParam(':mdp', $password);
            $bool = $command->execute();
    
            if ($bool) {
                $result = $command->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) != 0)
                    $result[0]['role'] = 'admin';
                // var_dump($result); die();
            }
        }
        catch (PDOException $e) {
            echo utf8_encode('Echec de select : ' . $e->getMessage() . '\n');
            die();
        }

        if (count($result)==0) {
            $profile = array(); // retourne un tableau vide
            return false;
        }
        else {
            $profile = $result[0];
            return true;
        }
    }

    // insère un nouveau customer dans la base de donnée.
    function inscr_BD($name, $username, $email, $password)
    {
        require('./model/connectBD.php');
        $sql = "INSERT INTO `customer` (name, username, email, password)
                 VALUES (:name, :username, :email, :password)";
        try {
            $command = $pdo->prepare($sql);
            $command->bindParam(':name', $name);
            $command->bindParam(':username', $username);
            $command->bindParam(':email', $email);
            $command->bindParam(':password', $password);
            $bool = $command->execute();

            if ($bool) return true;
            else return false;
        }

        catch (PDOException $e) {
            echo utf8_encode('Echec de insert into : ' . $e->getMessage() . '.\n');
            die();
        }
    }

    // renvoie l'id de l'entreprise ayant le nom passé en paramètre
    /*function getId_entreprise_BD($nom)
    {
        require('./model/connectBD.php');
        $sql = "SELECT id FROM `company` WHERE nom = :nom";
        try {
            $command = $pdo->prepare($sql);
            $command->bindParam(':nom', $nom);
            $bool = $command->execute();

            if ($bool) {
                $Resultat = $command->fetchAll(PDO::FETCH_ASSOC);
                // var_dump($Resultat[0]); die();
            }
        }
        catch (PDOException $e) {
            echo utf8_encode('Echec de insert into : ' . $e->getMessage() . '.\n');
            die();
        }

        if (count($Resultat)==0) {
            return array(); // retourne un tableau vide
        }
        else {
            return $Resultat[0];
        }
    }*/

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
            $command->bindParam(':pseudo', $username);
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
