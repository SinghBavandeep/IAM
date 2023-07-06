<?php 

    // vérifie si le client est présent dans la base de donnée.
    function verif_ident_client_BD($ident, $mdp, &$Profil) 
    {
        require('./modele/connectBD.php');
        try {
            $sql = "SELECT * FROM `client` WHERE pseudo=:ident AND mdp=:mdp OR email=:ident AND mdp=:mdp";
            $commande = $pdo->prepare($sql);
            $commande->bindParam(':ident', $ident);
            $commande->bindParam(':mdp', $mdp);
            $bool = $commande->execute();
    
            if ($bool) {
                $Resultat = $commande->fetchAll(PDO::FETCH_ASSOC);
                if (count($Resultat) != 0) $Resultat[0]['role'] = 'client';
                // var_dump($Resultat); die();
            }
        }
        catch (PDOException $e) {
            echo utf8_encode('Echec de select : ' . $e->getMessage() . '\n');
            die();
        }
        if (count($Resultat)==0) {
            $Profil = array(); // retourne un tableau vide
            return false;
        }
        else {
            $Profil = $Resultat[0];
            return true;
        }
    }

    // vérifie si le loueur est présent dans la base de donnée.
    function verif_ident_loueur_BD($ident, $mdp, &$Profil)  
    {
        require('./modele/connectBD.php');
        try {
            $sql = "SELECT * FROM `loueur` WHERE pseudo=:ident AND mdp=:mdp OR email=:ident AND mdp=:mdp";
            $commande = $pdo->prepare($sql);
            $commande->bindParam(':ident', $ident);
            $commande->bindParam(':mdp', $mdp);
            $bool = $commande->execute();
    
            if ($bool) {
                $Resultat = $commande->fetchAll(PDO::FETCH_ASSOC);
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
            $Profil = array(); // retourne un tableau vide
            return false;
        }
        else {
            $Profil = $Resultat[0];
            return true;
        }
    }

    // insère un nouveau client dans la base de donnée.
    function inscr_BD($nom, $pseudo, $email, $mdp, $idE)
    {
        require('./modele/connectBD.php');
        $sql = "INSERT INTO `client` (nom, pseudo, email, mdp, idE)
                 VALUES (:nom, :pseudo, :email, :mdp, :idE)";
        try {
            $commande = $pdo->prepare($sql);
            $commande->bindParam(':nom', $nom);
            $commande->bindParam(':pseudo', $pseudo);
            $commande->bindParam(':email', $email);
            $commande->bindParam(':mdp', $mdp);
            $commande->bindParam(':idE', $idE);
            $bool = $commande->execute();

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
        require('./modele/connectBD.php');
        $sql = "INSERT INTO `entreprise` (nom, adresse)
                VALUES (:nom, :adresse)";
        try {
            $commande = $pdo->prepare($sql);
            $commande->bindParam(':nom', $nom);
            $commande->bindParam(':adresse', $adresse);
            $bool = $commande->execute();

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
        require('./modele/connectBD.php');
        $sql = "SELECT id FROM `entreprise` WHERE nom = :nom";
        try {
            $commande = $pdo->prepare($sql);
            $commande->bindParam(':nom', $nom);
            $bool = $commande->execute();

            if ($bool) {
                $Resultat = $commande->fetchAll(PDO::FETCH_ASSOC);
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
        require('./modele/connectBD.php');
        try {
            $sql = "SELECT * FROM `client` WHERE email=:email";
            $commande = $pdo->prepare($sql);
            $commande->bindParam(':email', $email);
            $bool = $commande->execute();
    
            if ($bool) {
                $Resultat = $commande->fetchAll(PDO::FETCH_ASSOC);
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
        require('./modele/connectBD.php');
        try {
            $sql = "SELECT * FROM `client` WHERE pseudo=:pseudo";
            $commande = $pdo->prepare($sql);
            $commande->bindParam(':pseudo', $pseudo);
            $bool = $commande->execute();
    
            if ($bool) {
                $Resultat = $commande->fetchAll(PDO::FETCH_ASSOC);
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
