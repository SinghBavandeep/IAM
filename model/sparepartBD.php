<?php

// Function to get spare parts from the database
function getSparePart_BD($id, $role, $rent, $pdo)
{
    require('./model/connectBD.php');

    try {
        if ($rent) {
            // Query to get rented spare parts
            $sql = "SELECT * FROM 'spare_part' WHERE ref = (
                    SELECT idv FROM 'bill' GROUP BY idv);";
            $command = $pdo->prepare($sql);
            $bool = $command->execute();
        } else {
            if ($role == 'admin')
                // Query to get spare parts for the admin
                $sql = "SELECT * FROM 'spare_part' WHERE idL=:id";
            else
                // Query to get spare parts for the customer
                $sql = "SELECT * FROM 'spare_part' WHERE idC=:id";

            $command = $pdo->prepare($sql);
            $command->bindParam(':id', $id);
            $bool = $command->execute();
        }

        if ($bool) {
            $Resultat = $command->fetchAll(PDO::FETCH_ASSOC);
            // Debugging purpose, you can remove this line
            var_dump($Resultat);
            die();
        }
    } catch (PDOException $e) {
        echo utf8_encode('Select failed: ' . $e->getMessage() . '\n');
        die();
    }
    if (count($Resultat) == 0)
        return array(); // Return an empty array if there are no spare parts
    else
        return $Resultat;
}

// ... Rest of the functions ...



function ajouter_SparePart_BD($name, $type, $caract, $details, $prixM, $img) {

    require('./model/connectBD.php');

    $sql = "INSERT INTO `spare_part` (name, type, caract, details, img, prixM)
                VALUES (:name, :type, :caract, :details, :img, :prixM )";
    $command = $pdo->prepare($sql);
    $command->bindParam(':name', $name);
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

    $sql = "DELETE FROM `spare_part` WHERE ref=:idv";

    $command = $pdo->prepare($sql);
    $command->bindParam(':idv', $idv);
    $bool = $command->execute();

}

function selection_flotte_BD($id, $idv)
{
    require('./model/connectBD.php');

    $sql = "UPDATE `spare_part` SET idC = :id WHERE ref=:idv";

    $command = $pdo->prepare($sql);
    $command->bindParam(':id', $id);
    $command->bindParam(':idv', $idv);
    $bool = $command->execute();
}

function deselection_flotte_BD($idv)
{
    require('./model/connectBD.php');

    $sql = "UPDATE `spare_part` SET idC = null WHERE ref=:idv";

    $command = $pdo->prepare($sql);
    $command->bindParam(':idv', $idv);
    $bool = $command->execute();
}

function annuler_location_BD($idv)
{
    require('./model/connectBD.php');

    $sql = "UPDATE `spare_part` SET debutL = null, finL = null WHERE ref=:idv";

    $command = $pdo->prepare($sql);
    $command->bindParam(':idv', $idv);
    $bool = $command->execute();

    $sql = "SELECT * FROM `spare_part` WHERE ref=:idv";

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
        $sql = "UPDATE `spare_part` SET finL = :finL WHERE ref=:idv";
        $command = $pdo->prepare($sql);
        $command->bindParam(':finL', $finL);
        $command->bindParam(':idv', $idv);
        $bool = $command->execute();
    }

    $sql = "UPDATE `spare_part` SET debutL = :debutL WHERE ref=:idv";
    $command = $pdo->prepare($sql);
    $command->bindParam(':debutL', $debutL);
    $command->bindParam(':idv', $idv);
    $bool = $command->execute();
}

function getFacture($idE) {

    require('./model/connectBD.php');

    $sql = "SELECT idv FROM `spare_part` WHERE idL=:idE AND finL!=null AND debutL!=null";

    $command = $pdo->prepare($sql);
    $command->bindParam(':idE', $idE);
    $bool = $command->execute();

    if ($bool) {
        $Resultat = $command->fetchAll(PDO::FETCH_ASSOC);
        return $Resultat;
    }

    return array();
}

?>
