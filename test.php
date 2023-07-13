<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Carnet d'adresses</title>
</head>
<body>
<h1>Carnet d'adresses</h1>

<form method="GET">
    <label for="minPrice">Prix minimum :</label>
    <input type="number" id="minPrice" name="minPrice">

    <label for="maxPrice">Prix maximum :</label>
    <input type="number" id="maxPrice" name="maxPrice">

    <label for="Type">Type :</label>
    <select id="Type" name="Type">
        <option value="">Tous les types</option>
        <option value="Diesel">Diesel</option>
        <option value="Electric">Electric</option>
        <option value="gasoline">Gasoline</option>
        <!-- Add more type options as needed -->
    </select>

    <input type="submit" value="Filtrer">
</form>

<?php
$mysqli = new mysqli("localhost", "root", "", "project");
$mysqli->set_charset("utf8");

// Check if the form is submitted
if (isset($_GET['minPrice']) && isset($_GET['maxPrice']) && isset($_GET['Type'])) {
    $minPrice = $_GET['minPrice'];
    $maxPrice = $_GET['maxPrice'];
    $careType = $_GET['Type'];

    // Create a prepared statement with a price range and type filter query
    $requete = "SELECT * FROM vehicle WHERE (prixM >= $minPrice AND prixM <= $maxPrice) AND type = '$careType'";
} else {
    // No price range specified, retrieve all rows
    $requete = "SELECT * FROM vehicle";
}

$resultat = $mysqli->query($requete);

if ($resultat->num_rows > 0) {
    while ($ligne = $resultat->fetch_assoc()) {
        echo $ligne['type'] . ' | ' . $ligne['name']  . ' ';
        // Print the image
        echo '<img src="./view/image/' . $ligne['img'] . '" alt="Image" width="200"><br>';
    }
} else {
    echo "Aucune ligne trouvée dans la table.";
}

$mysqli->close();
?>
</body>
</html>
