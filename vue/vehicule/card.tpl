<!-- CARD -->
<section class="section card">
    <!-- TITLE -->
    <h2 class="section__title">Vehicles</h2>
    <div class="card__container container">
        <div class="swiper card-swiper">
            <div class="swiper-wrapper">
                <!-- NEW 1 -->
                <?php 
                    foreach ($_SESSION['vehicules'] as $item) {
                    echo '
                        <div class="card__content swiper-slide" id="'.$item['ref'].'">
                            <div class="card__data card__data-img">
                                <img src="./vue/image/'.$item['img'].'" alt="treat1" class="card__img">
                                <h3 class="card__title">'.$item['nom'].'</h3>
                                <div class="card__subtitle">'.$item['type'].'</div>
                                <div class="card__price">'.$item['prixJ'].'€ / Jour</div>
                                <div class="card__price">'.$item['prixM'].'€ / Mois</div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                            <div class="card__data card__data-details">
                                <div class="card__detail">
                                    <div class="card__pagination">
                                        <div class="card__subtitle">Vehicles</div>
                                        <div class="swiper-pagination"></div>
                                    </div>
                                    <div class="card__info">
                                        <!-- RENT -->
                                        <div class="card__subtitle">Rental Dates</div>
                                        <p class="card__description">Beginning : ';
                                            echo empty($item['debutL'])?'Aucune':$item['debutL']; 
                                            echo '<br>
                                            Fin : ';
                                            echo empty($item['finL'])?'Aucune':$item['finL']; 
                                            echo '
                                        </p>
                                        <!-- FEATURES -->
                                        <div class="card__subtitle">Features</div>
                                        <p class="card__description">'.$item['caract'].'</p>
                                        <!-- DETAILS -->
                                        <div class="card__subtitle">Details</div>
                                        <p class="card__description">'.$item['details'].'</p>
                                    </div>
                                    
                                </div>';
                                if (isset($_GET["param"]) && $_GET['param'] == 'vehicule-home') {
                                    if (!isset($_SESSION['profil']) || $_SESSION['profil']['role'] != 'loueur') {
                                        echo '
                                        <div class="card__buttons">
                                            <a href="./index.php?controle=vehicule&action=selection_flotte&param=' . $item['ref'] . '" class="button card__button">
                                                <i class="bx bx-cart-alt "></i>
                                            </a>
                                        </div>';
                                    }
                                }
                                else {
                                    echo '
                                    <div class="card__buttons">';
                                        if ($_SESSION['profil']['role'] == 'client') {
                                            if (!empty($item['debutL']) || !empty($item['debutL'])) {
                                                echo '
                                                <a href="./index.php?controle=vehicule&action=deselection_flotte&param=' . $item['ref'] . '" class="button ">
                                                    Cancel
                                                </a>';
                                            }
                                            else {
                                                echo '
                                                <a href="./index.php?controle=vehicule&action=deselection_flotte&param=' . $item['ref'] . '" class="button ">
                                                    Deselect
                                                </a>';
                                            }
                                            echo '
                                            <a href="./index.php?controle=vehicule&action=modifier_dates&param=' . $item['ref'] . '" class="button">
                                                Edit
                                            </a>';
                                        }
                                        if ($_SESSION['profil']['role'] == 'loueur') {
                                            if (isset($_GET['param']) && $_GET['param'] == 'vehicule-stock') {
                                                echo '
                                                <a href="./index.php?controle=vehicule&action=ajouter" class="button ">
                                                    Add
                                                </a>
                                                <a href="./index.php?controle=vehicule&action=supprimer&param='.$item['ref'].'" class="button">
                                                    Delete
                                                </a>';
                                            }
                                            if (isset($_GET['param']) && $_GET['param'] == 'vehicule-rent') {
                                                echo '
                                                <a href="./index.php?controle=vehicule&action=facturation" class="button ">
                                                    Billing
                                                </a>';
                                            }
                                        }
                                        echo '
                                    </div>';
                                }
                                echo '
                            </div>
                        </div>
                    ';
                    }
                ?>
            </div>
        </div>
    </div>
</section>