<?php

    function getSparePart_BD($id, $role, $rent)
    {
        require('./model/connectBD.php');
        try {
            if ($rent) {
                $sql = "SELECT * FROM 'spares_parts' WHERE ref = (
                        SELECT idv FROM `bill` GROUP BY idv);";
                $command = $pdo->prepare($sql);
                $bool = $command->execute();
            }
            else {
                if ($role == 'admin')
                    $sql = "SELECT * FROM 'spares_parts' WHERE idL=:id";
                else
                    $sql = "SELECT * FROM 'spares_parts' WHERE idC=:id";

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

    function ajouter_SparePart_BD($nom, $type, $caract, $details, $prixM, $img) {
    
        require('./model/connectBD.php');

            $sql = "INSERT INTO 'spares_parts' (nom, type, caract, details, img, prixM)
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

    function supprimer_SparePart_BD($idv)
    {
        require('./model/connectBD.php');

            $sql = "DELETE FROM 'spares_parts' WHERE ref=:idv";

            $command = $pdo->prepare($sql);
            $command->bindParam(':idv', $idv);
            $bool = $command->execute();

    }  

    function selection_flotte_BD($id, $idv)
    {
        require('./model/connectBD.php');

        $sql = "UPDATE 'spares_parts' SET idC = :id WHERE ref=:idv";

            $command = $pdo->prepare($sql);
            $command->bindParam(':id', $id);
            $command->bindParam(':idv', $idv);
            $bool = $command->execute();
    }

    function deselection_flotte_BD($idv)
    {
        require('./model/connectBD.php');

        $sql = "UPDATE 'spares_parts' SET idC = null WHERE ref=:idv";

            $command = $pdo->prepare($sql);
            $command->bindParam(':idv', $idv);
            $bool = $command->execute();
    }

    function annuler_location_BD($idv)
    {
        require('./model/connectBD.php');

        $sql = "UPDATE 'spares_parts' SET debutL = null, finL = null WHERE ref=:idv";

        $command = $pdo->prepare($sql);
        $command->bindParam(':idv', $idv);
        $bool = $command->execute();

        $sql = "SELECT * FROM 'spares_parts' WHERE ref=:idv";

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
            $sql = "UPDATE 'spares_parts' SET finL = :finL WHERE ref=:idv";
            $command = $pdo->prepare($sql);
            $command->bindParam(':finL', $finL);
            $command->bindParam(':idv', $idv);
            $bool = $command->execute();
        }

        $sql = "UPDATE 'spares_parts' SET debutL = :debutL, state = 1 WHERE ref=:idv";

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

            $sql = "SELECT nom, debutL, finL, prixM FROM 'spares_parts' WHERE idC=:id AND state = 1 ";
            $command = $pdo->prepare($sql);
            $command->bindParam(':id', $customer['id']);
            $bool = $command->execute();
            
            if ($bool) {
                $SparePart = $command->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($SparePart) && isset($SparePart[0])) {
                    array_push($SparePart, $SparePart[0]);
                }
            }
        }
        //var_dump($vehicules); die();
           return $SparePart;
     }


?>