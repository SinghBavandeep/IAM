<?php

    function getVehicule_BD($id, $role, $rent) 
    {
        require('./modele/connectBD.php');
        try {
            if ($rent) {
                $sql = "SELECT * FROM `vehicule` WHERE ref = (
                        SELECT idv FROM `facture` GROUP BY idv);";
                $commande = $pdo->prepare($sql);
                $bool = $commande->execute();
            }
            else {
                if ($role == 'loueur')
                    $sql = "SELECT * FROM `vehicule` WHERE idL=:id";
                else
                    $sql = "SELECT * FROM `vehicule` WHERE idC=:id";

                $commande = $pdo->prepare($sql);
                $commande->bindParam(':id', $id);
                $bool = $commande->execute();
            }

            if ($bool) {
                $Resultat = $commande->fetchAll(PDO::FETCH_ASSOC);
                // var_dump($Resultat); die();
            }
        }
        catch (PDOException $e) {
            echo utf8_encode('Echec de select : ' . $e->getMessage() . '\n');
            die();
        }
        if (count($Resultat) == 0)
            return array(); // renvoie un tableau vide
        else
            return $Resultat;
    }

    function ajouter_vehicule_BD($nom, $type, $caract, $details, $prixJ, $prixM, $img) {
    
        require('./modele/connectBD.php');

            $sql = "INSERT INTO `vehicule` (nom, type, caract, details, img, prixJ, prixM)
                    VALUES (:nom, :type, :caract, :details, :img, :prixJ, :prixM )";
            $commande = $pdo->prepare($sql);
            $commande->bindParam(':nom', $nom);
            $commande->bindParam(':type', $type);
            $commande->bindParam(':caract', $caract);
            $commande->bindParam(':details', $details);
            $commande->bindParam(':img', $img);
            $commande->bindParam(':prixJ', $prixJ);
            $commande->bindParam(':prixM', $prixM);        
            
            $bool = $commande->execute();
    }

    function supprimer_vehicule_BD($idv)
    {
        require('./modele/connectBD.php');

            $sql = "DELETE FROM `vehicule` WHERE ref=:idv";

            $commande = $pdo->prepare($sql);
            $commande->bindParam(':idv', $idv);
            $bool = $commande->execute();

    }  

    function selection_flotte_BD($id, $idv)
    {
        require('./modele/connectBD.php');

        $sql = "UPDATE `vehicule` SET idC = :id WHERE ref=:idv";

            $commande = $pdo->prepare($sql);
            $commande->bindParam(':id', $id);
            $commande->bindParam(':idv', $idv);
            $bool = $commande->execute();
    }

    function deselection_flotte_BD($idv)
    {
        require('./modele/connectBD.php');

        $sql = "UPDATE `vehicule` SET idC = null WHERE ref=:idv";

            $commande = $pdo->prepare($sql);
            $commande->bindParam(':idv', $idv);
            $bool = $commande->execute();
    }

    function annuler_location_BD($idv)
    {
        require('./modele/connectBD.php');

        $sql = "UPDATE `vehicule` SET debutL = null, finL = null WHERE ref=:idv";

        $commande = $pdo->prepare($sql);
        $commande->bindParam(':idv', $idv);
        $bool = $commande->execute();

        $sql = "SELECT * FROM `vehicule` WHERE ref=:idv";

        $commande = $pdo->prepare($sql);
        $commande->bindParam(':idv', $idv);
        $bool = $commande->execute();

        $res = $commande->fetchAll(PDO::FETCH_ASSOC);
        var_dump($res); die();
    }

    function modifier_dates_BD($idv, $debutL, $finL)
    {
        require('./modele/connectBD.php');
        if(!empty($finL)) {
            $sql = "UPDATE `vehicule` SET finL = :finL WHERE ref=:idv";
            $commande = $pdo->prepare($sql);
            $commande->bindParam(':finL', $finL);
            $commande->bindParam(':idv', $idv);
            $bool = $commande->execute();
        }

        $sql = "UPDATE `vehicule` SET debutL = :debutL, state = 1 WHERE ref=:idv";

        $commande = $pdo->prepare($sql);
        $commande->bindParam(':debutL', $debutL);
        $commande->bindParam(':idv', $idv);
        $bool = $commande->execute();
    }


    function getFacture($idE)
    {
        require('./modele/connectBD.php');

        $sql = "SELECT id FROM `client` WHERE idE =:idE";
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':idE', $idE);
        $bool = $commande->execute();

        if ($bool) {
            $clients = $commande->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($clients); die();
        }

        $vehicules = array();

        /*Bug lorsqu un client a plusieurs vehicules ou quand le state est egal � 0*/
        foreach($clients as $client) {

            $sql = "SELECT nom, debutL, finL, prixJ, prixM FROM `vehicule` WHERE idC=:id AND state = 1 ";
            $commande = $pdo->prepare($sql);
            $commande->bindParam(':id', $client['id']);
            $bool = $commande->execute();

           if ($bool) {
               array_push ($vehicules, $commande->fetchAll(PDO::FETCH_ASSOC)[0]);          
            }      
        }
        //var_dump($vehicules); die();
           return $vehicules;
     }


?>