<?php
/**
 * Traitement
 */

session_start();

if(isset($_GET['articles_list']) && !empty($_GET['articles_list'])) {

    // Du formulaire
    $new_articles = $_GET['articles_list'];

    // De la session
    if(isset($_SESSION['articles'])) {
        $articles = $_SESSION['articles'];
    } else {
        $articles = array();
    }

    foreach ($new_articles as $article) {

        // Si il existe déjà
        if(isset($articles[$article])) {

            $articles[$article] = $articles[$article] + 1;

        } else {

            $articles[$article] = 1;

        }

    }

    // On le sauvegarde
    $_SESSION['articles'] = $articles;

    print_r($articles);

}

/**
 * AFFICHAGE
 */
?>
<!DOCTYPE html>
<html>

<head>
    <title>Checkboxes</title>
    <meta charset="utf-8" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>

<div class="container">

    <pre><?php print_r($_SESSION['articles']); ?></pre>

    <div class="col-md-6">

        <form action="" method="get" id="articles">

            <h1>Catalogue</h1>

            <hr>

            <div>
                <label for="articles_list">Ajouter un article</label>
                <select name="articles_list[]" id="articles_list" class="form-control" multiple>
                    <option value="robe">Robe</option>
                    <option value="pentalon">Pentalon</option>
                    <option value="pull_de_franois">Pull De François</option>
                </select>
            </div>

            <hr>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Ajouter!</button>
            </div>

        </form>

    </div>

    <div class="col-md-6">

        <h1>Liste de produits</h1>

        <hr>

        <form action="" method="get">

            <?php if(isset($_SESSION['articles'])) { ?>

                <ul>
                    <?php foreach ($_SESSION['articles'] as $name=>$quantite) { ?>
                        <li>
                            <?php echo $name;  ?> - <?php echo $quantite; ?>
                            <input type="submit" class="btn btn-danger" name="<?php echo $name;  ?>" value="-">
                            <input type="submit" class="btn btn-success" name="<?php echo $name;  ?>" value="+">
                        </li>
                    <?php } ?>
                </ul>

            <?php } else { ?>

                <h3>Bro, on a pas d'articles...</h3>

            <?php } ?>

        </form>



    </div>

</div>

</body>

</html>