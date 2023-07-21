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

            // Retrieve the products from the database with filtering
            $filter = $_GET['filter'] ?? '';
            switch ($filter) {
                case 'price_low':
                    $orderBy = 'ORDER BY prixM ASC';
                    break;
                case 'price_high':
                    $orderBy = 'ORDER BY prixM DESC';
                    break;
                default:
                    $orderBy = '';
            }

            $sql = "SELECT ref, name, img, prixM, details FROM spare_part $orderBy";
            $result = mysqli_query($conn, $sql);

            // Check if any products were found
            if (mysqli_num_rows($result) > 0) {
            // Loop through the products and display them
            while ($row = mysqli_fetch_assoc($result)) {
            if (empty($filter)) {
            echo '
            <div class="login__create">
                <div class="login__form">
                    <div class="d-flex justify-content-center align-items-center vh-100">
                        <div class="shadow w-350 p-3 text-center">';
                            echo "Product Name: " . $row['name'] . "<br>";
                            echo '<img src="./view/image/' . $row['img'] . '" alt="Alps" style="height: 400px; height: 400px;"><br>';
                            echo "Product Price: " . $row['prixM'] . "£<br>";
                            echo "Product Details: " . $row['details'] . "<br>";
                            echo "<br>";
                            echo '
                            <ul class="nav__list">
                                <li class="nav__item">
                                    <a href="./index.php?controller=sparepart&action=add_to_cart&ref=' . $row['ref'] . '" class="nav__link" id="afficherBtn">Add to cart</a>
                                </li><br>
                                <li class="nav__item">
                                    <a href="#Vadmin" class="nav__link" id="afficherBtn">Buy</a>
                                </li><br>
                                <li class="nav__item">
                                    <div class="login__create">';
                                        echo "Quantity: ";
                                        echo '<input type="number" class="quantity-input" value="0" min="0" onchange="calculateTotal()"><br>
                                    </div>
                                </li><br>
                            </ul>';

                            echo '</div>
                    </div>
                </div>
            </div><br>';
            } else {
            // Apply the filter to skip displaying filtered-out products
            // Example: Skip products with a price less than 1000
            if ($filter === 'price_low' && $row['prixM'] < 1000) {
            continue;
            }

            echo '
            <div class="login__create">
                <div class="login__form">
                    <div class="d-flex justify-content-center align-items-center vh-100">
                        <div class="shadow w-350 p-3 text-center">';
                            echo "Product Name: " . $row['name'] . "<br>";
                            echo '<img src="./view/image/' . $row['img'] . '" alt="Alps" style="height: 400px; height: 400px;"><br>';
                            echo "Product Price: " . $row['prixM'] . "<br>";
                            echo "Product Details: " . $row['details'] . "<br>";
                            echo "<br>";
                            echo '
                            <ul class="nav__list">
                                <li class="nav__item">
                                    <a href="#Vadmin" class="nav__link" id="afficherBtn">View more</a>
                                </li><br>
                                <li class="nav__item">
                                    <a href="#Vadmin" class="nav__link" id="afficherBtn">Buy</a>
                                </li><br>
                                <li class="nav__item">
                                    <div class="login__create">';
                                        echo "Quantity: ";
                                        echo '<input type="number" class="quantity-input" value="0" min="0" onchange="calculateTotal()"><br>
                                    </div>
                                </li><br>
                            </ul>';

                            echo '</div>
                    </div>
                </div>
            </div><br>';
            }
            }
            } else {
            echo "No products found in the database.";
            }
            // Close the database connection
            mysqli_close($conn);
            ?>
        </div>
    </div>
</section>
