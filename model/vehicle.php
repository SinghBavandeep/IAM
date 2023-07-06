<?php

    function getVehicule_BD($id, $role, $rent) 
    {
        require('./model/connectBD.php');
        try {
            if ($rent) {
                $sql = "SELECT * FROM `vehicle` WHERE ref = (
                        SELECT idv FROM `facture` GROUP BY idv);";
                $command = $pdo->prepare($sql);
                $bool = $command->execute();
            }
            else {
                if ($role == 'loueur')
                    $sql = "SELECT * FROM `vehicle` WHERE idL=:id";
                else
                    $sql = "SELECT * FROM `vehicle` WHERE idC=:id";

                $command = $pdo->prepare($sql);
                $command->bindParam(':id', $id);
                $bool = $command->execute();
            }

            if ($bool) {
                $Resultat = $command->fetchAll(PDO::FETCH_ASSOC);
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
    
        require('./model/connectBD.php');

            $sql = "INSERT INTO `vehicle` (nom, type, caract, details, img, prixJ, prixM)
                    VALUES (:nom, :type, :caract, :details, :img, :prixJ, :prixM )";
            $command = $pdo->prepare($sql);
            $command->bindParam(':nom', $nom);
            $command->bindParam(':type', $type);
            $command->bindParam(':caract', $caract);
            $command->bindParam(':details', $details);
            $command->bindParam(':img', $img);
            $command->bindParam(':prixJ', $prixJ);
            $command->bindParam(':prixM', $prixM);        
            
            $bool = $command->execute();
    }

    function supprimer_vehicule_BD($idv)
    {
        require('./model/connectBD.php');

            $sql = "DELETE FROM `vehicle` WHERE ref=:idv";

            $command = $pdo->prepare($sql);
            $command->bindParam(':idv', $idv);
            $bool = $command->execute();

    }  

    function selection_flotte_BD($id, $idv)
    {
        require('./model/connectBD.php');

        $sql = "UPDATE `vehicle` SET idC = :id WHERE ref=:idv";

            $command = $pdo->prepare($sql);
            $command->bindParam(':id', $id);
            $command->bindParam(':idv', $idv);
            $bool = $command->execute();
    }

    function deselection_flotte_BD($idv)
    {
        require('./model/connectBD.php');

        $sql = "UPDATE `vehicle` SET idC = null WHERE ref=:idv";

            $command = $pdo->prepare($sql);
            $command->bindParam(':idv', $idv);
            $bool = $command->execute();
    }

    function annuler_location_BD($idv)
    {
        require('./model/connectBD.php');

        $sql = "UPDATE `vehicle` SET debutL = null, finL = null WHERE ref=:idv";

        $command = $pdo->prepare($sql);
        $command->bindParam(':idv', $idv);
        $bool = $command->execute();

        $sql = "SELECT * FROM `vehicle` WHERE ref=:idv";

        $command = $pdo->prepare($sql);
        $command->bindParam(':idv', $idv);
        $bool = $command->execute();

        $res = $command->fetchAll(PDO::FETCH_ASSOC);
        var_dump($res); die();
    }

    function modifier_dates_BD($idv, $debutL, $finL)
    {
        require('./model/connectBD.php');
        if(!empty($finL)) {
            $sql = "UPDATE `vehicle` SET finL = :finL WHERE ref=:idv";
            $command = $pdo->prepare($sql);
            $command->bindParam(':finL', $finL);
            $command->bindParam(':idv', $idv);
            $bool = $command->execute();
        }

        $sql = "UPDATE `vehicle` SET debutL = :debutL, state = 1 WHERE ref=:idv";

        $command = $pdo->prepare($sql);
        $command->bindParam(':debutL', $debutL);
        $command->bindParam(':idv', $idv);
        $bool = $command->execute();
    }


    function getFacture($idE)
    {
        require('./model/connectBD.php');

        $sql = "SELECT id FROM `client` WHERE idE =:idE";
        $command = $pdo->prepare($sql);
        $command->bindParam(':idE', $idE);
        $bool = $command->execute();

        if ($bool) {
            $clients = $command->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($clients); die();
        }

        $vehicules = array();

        /*Bug lorsqu un client a plusieurs vehicules ou quand le state est egal � 0*/
        foreach($clients as $client) {

            $sql = "SELECT nom, debutL, finL, prixJ, prixM FROM `vehicle` WHERE idC=:id AND state = 1 ";
            $command = $pdo->prepare($sql);
            $command->bindParam(':id', $client['id']);
            $bool = $command->execute();

           if ($bool) {
               array_push ($vehicles, $command->fetchAll(PDO::FETCH_ASSOC)[0]);          
            }      
        }
        //var_dump($vehicules); die();
           return $vehicles;
     }


?>