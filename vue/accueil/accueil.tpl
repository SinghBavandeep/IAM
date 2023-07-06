<!-- TRICK OR TREAT -->
<section class="section trick" id="trick">
    <!-- TITLE -->
    <h2 class="section__title">Trick Or Treat</h2>
    <div class="trick__container container grid">
        <?php 
            foreach ($_SESSION['vehicules'] as $item) {
                echo '
                <!-- TRICK-TREAT 0 -->
                <div class="trick__card">
                    <a href="./index.php?controle=vehicule&action=get&param=vehicule-home" class="trick__content">
                        <img src="./vue/image/'.$item['img'].'" alt="trick-treat1" class="trick__img">
                        <h3 class="trick__title">'.$item['nom'].'</h3>
                        <div class="trick__subtitle">'.$item['type'].'</div>
                        <div class="trick__price">'.$item['prixJ'].'€</div>
                        <button class="button trick__button aaa">
                            <i class="bx bx-cart-alt "></i>
                        </button>
                    </a>
                </div>';
            }
        ?>
    </div>
</section>