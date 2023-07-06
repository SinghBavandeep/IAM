<?php 

    // vérifie si le client est présent dans la base de donnée.
    function verif_ident_client_BD($ident, $mdp, &$Profile) 
    {
        require('./model/connectBD.php');
        try {
            $sql = "SELECT * FROM `client` WHERE pseudo=:ident AND mdp=:mdp OR email=:ident AND mdp=:mdp";
            $command = $pdo->prepare($sql);
            $command->bindParam(':ident', $ident);
            $command->bindParam(':mdp', $mdp);
            $bool = $command->execute();
    
            if ($bool) {
                $Resultat = $command->fetchAll(PDO::FETCH_ASSOC);
                if (count($Resultat) != 0) $Resultat[0]['role'] = 'client';
                // var_dump($Resultat); die();
            }
        }
        catch (PDOException $e) {
            echo utf8_encode('Echec de select : ' . $e->getMessage() . '\n');
            die();
        }
        if (count($Resultat)==0) {
            $Profile = array(); // retourne un tableau vide
            return false;
        }
        else {
            $Profile = $Resultat[0];
            return true;
        }
    }

    // vérifie si le loueur est présent dans la base de donnée.
    function verif_ident_loueur_BD($ident, $mdp, &$Profile)  
    {
        require('./model/connectBD.php');
        try {
            $sql = "SELECT * FROM `loueur` WHERE pseudo=:ident AND mdp=:mdp OR email=:ident AND mdp=:mdp";
            $command = $pdo->prepare($sql);
            $command->bindParam(':ident', $ident);
            $command->bindParam(':mdp', $mdp);
            $bool = $command->execute();
    
            if ($bool) {
                $Resultat = $command->fetchAll(PDO::FETCH_ASSOC);
                if (count($Resultat) != 0)
                    $Resultat[0]['role'] = 'loueur';
                // var_dump($Resultat); die();
            }
        }
        catch (PDOException $e) {
            echo utf8_encode('Echec de select : ' . $e->getMessage() . '\n');
            die();
        }

        if (count($Resultat)==0) {
            $Profile = array(); // retourne un tableau vide
            return false;
        }
        else {
            $Profile = $Resultat[0];
            return true;
        }
    }

    // insère un nouveau client dans la base de donnée.
    function inscr_BD($nom, $pseudo, $email, $mdp, $idE)
    {
        require('./model/connectBD.php');
        $sql = "INSERT INTO `client` (nom, pseudo, email, mdp, idE)
                 VALUES (:nom, :pseudo, :email, :mdp, :idE)";
        try {
            $command = $pdo->prepare($sql);
            $command->bindParam(':nom', $nom);
            $command->bindParam(':pseudo', $pseudo);
            $command->bindParam(':email', $email);
            $command->bindParam(':mdp', $mdp);
            $command->bindParam(':idE', $idE);
            $bool = $command->execute();

            if ($bool) return true;
            else return false;
        }

        catch (PDOException $e) {
            echo utf8_encode('Echec de insert into : ' . $e->getMessage() . '.\n');
            die();
        }
    }

    // insère une nouvelle entreprise dans la base de donnée.
    function create_entreprise_BD($nom, $adresse) 
    {
        require('./model/connectBD.php');
        $sql = "INSERT INTO `entreprise` (nom, adresse)
                VALUES (:nom, :adresse)";
        try {
            $command = $pdo->prepare($sql);
            $command->bindParam(':nom', $nom);
            $command->bindParam(':adresse', $adresse);
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
    function getId_entreprise_BD($nom)
    {
        require('./model/connectBD.php');
        $sql = "SELECT id FROM `entreprise` WHERE nom = :nom";
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
    }

    // vérifie si un email est présent dans la base de donnée.
    function verif_inscr_BD_valide_email($email) 
    {
        require('./model/connectBD.php');
        try {
            $sql = "SELECT * FROM `client` WHERE email=:email";
            $command = $pdo->prepare($sql);
            $command->bindParam(':email', $email);
            $bool = $command->execute();
    
            if ($bool) {
                $Resultat = $command->fetchAll(PDO::FETCH_ASSOC);
                // var_dump($Resultat); die();
            }
        }
        catch (PDOException $e) {
            echo utf8_encode('Echec de select : ' . $e->getMessage() . '\n');
            die();
        }

        if (count($Resultat)==0) return true;
        else return false;
    }

    // vérifie si un pseudo est présent dans la base de donnée.
    function verif_inscr_BD_valide_pseudo($pseudo) 
    {
        require('./model/connectBD.php');
        try {
            $sql = "SELECT * FROM `client` WHERE pseudo=:pseudo";
            $command = $pdo->prepare($sql);
            $command->bindParam(':pseudo', $pseudo);
            $bool = $command->execute();
    
            if ($bool) {
                $Resultat = $command->fetchAll(PDO::FETCH_ASSOC);
                // var_dump($Resultat); die();
            }
        }
        catch (PDOException $e) {
            echo utf8_encode('Echec de select : ' . $e->getMessage() . '\n');
            die();
        }

        if (count($Resultat)==0) return true;
        else return false;
    }
    

?>
