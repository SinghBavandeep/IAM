<?php

    function getVehicle_BD($id, $role, $rent) 
    {
        require('./model/connectBD.php');
        try {
            if ($rent) {
                $sql = "SELECT * FROM `vehicle` WHERE ref = (
                        SELECT idv FROM `bill` GROUP BY idv);";
                $command = $pdo->prepare($sql);
                $bool = $command->execute();
            }
            else {
                if ($role == 'admin')
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

    function ajouter_vehicule_BD($nom, $type, $caract, $details, $prixM, $img) {
    
        require('./model/connectBD.php');

            $sql = "INSERT INTO `vehicle` (nom, type, caract, details, img, prixM)
                    VALUES (:nom, :type, :caract, :details, :img, :prixM )";
            $command = $pdo->prepare($sql);
            $command->bindParam(':nom', $nom);
            $command->bindParam(':type', $type);
            $command->bindParam(':caract', $caract);
            $command->bindParam(':details', $details);
            $command->bindParam(':img', $img);
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

        $sql = "SELECT id FROM `customer` WHERE idE =:idE";
        $command = $pdo->prepare($sql);
        $command->bindParam(':idE', $idE);
        $bool = $command->execute();

        if ($bool) {
            $clients = $command->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($clients); die();
        }

        $vehicules = array();

        /*Bug lorsqu un customer a plusieurs vehicules ou quand le state est egal � 0*/
        foreach($clients as $customer) {

            $sql = "SELECT nom, debutL, finL, prixM FROM `vehicle` WHERE idC=:id AND state = 1 ";
            $command = $pdo->prepare($sql);
            $command->bindParam(':id', $customer['id']);
            $bool = $command->execute();
            
            if ($bool) {
                $vehicles = $command->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($vehicles) && isset($vehicles[0])) {
                    array_push($vehicles, $vehicles[0]);
                }
            }
        }
        //var_dump($vehicules); die();
           return $vehicles;
     }


?>