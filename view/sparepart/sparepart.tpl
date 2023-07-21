<!-- CARD -->
<section class="section card">
    <!-- TITLE -->
    <h2 class="section__title">Spare Parts</h2>
    <div class="card__container container">
        <!-- Filter Form -->
        <form method="GET" action="">
            <?php include('Menu_Categorie.tpl')?><br>
            <label for="filter">Filter by:</label>
            <select name="filter" id="filter" class="login__box">
                <option value="">All</option>
                <option value="price_low">Price Low to High</option>
                <option value="price_high">Price High to Low</option>
            </select>
            <button type="submit" CLASS="nav__link">Apply</button>
        </form>

        <div class="swiper card-swiper">
            <br>
            <?php
            $conn = mysqli_connect("localhost", "root", "", "project");

            // Vérifier la connexion à la base de données
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
            }

            // Récupérer le filtre depuis la requête GET
            $filter = $_GET['filter'] ?? '';
            $orderBy = '';

            // Construire la clause ORDER BY en fonction du filtre
            switch ($filter) {
                case 'price_low':
                    $orderBy = 'ORDER BY prixM ASC';
                    break;
                case 'price_high':
                    $orderBy = 'ORDER BY prixM DESC';
                    break;
                default:
                    // Pas de filtre, pas de clause ORDER BY
            }

            // Exécuter la requête SQL
            $sql = "SELECT * FROM spare_part $orderBy";
            $result = mysqli_query($conn, $sql);

            // Vérifier si des produits ont été trouvés
            if ($result === false) {
                echo "Error executing SQL: " . mysqli_error($conn);
                exit();
            }

            // Vérifier le nombre de lignes dans le résultat
            if (mysqli_num_rows($result) > 0) {
            // Afficher les produits
            while ($row = mysqli_fetch_assoc($result)) {
            // Afficher les détails du produit
            echo '
            <div class="login__create">
                <div class="login__form">
                    <div class="d-flex justify-content-center align-items-center vh-100">
                        <div class="shadow w-350 p-3 text-center">
                            Product Name: ' . $row['name'] . '<br>
                            <img src="./view/image/' . $row['img'] . '" alt="Alps" style="height: 400px; height: 400px;"><br>
                            Product Price: ' . $row['prixM'] . '£<br>
                            Product Details: ' . $row['details'] . '<br><br>
                            <ul class="nav__list">
                                <li class="nav__item">
                                    <a href="#Vadmin" class="nav__link" id="afficherBtn">Add to cart</a>
                                </li><br>
                                <li class="nav__item">
                                    <a href="#Vadmin" class="nav__link" id="afficherBtn">Buy</a>
                                </li><br>
                                <li class="nav__item">
                                    <div class="login__create">
                                        Quantity: <input type="number" class="quantity-input" value="0" min="0" onchange="calculateTotal()"><br>
                                    </div>
                                </li><br>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><br>';
            }
            } else {
            echo "No products found in the database.";
            }

            // Fermer la connexion à la base de données
            mysqli_close($conn);
            ?>
        </div>
    </div>
</section>
