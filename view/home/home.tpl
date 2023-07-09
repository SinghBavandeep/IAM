
<!-- HOME -->
<section class="home container" id="home">
    <br><br><br>
    <div class="swiper home-swiper">
        <div class="swiper-wrapper">
            <!-- #Home 1# -->
            <?php 
                foreach ($_SESSION['vehicles'] as $item) {
                    echo '
                    <section class="swiper-slide">
                        <div class="home__content grid">
                            <!-- HOME GROUP -->
                            <div class="home__group grid">
                                <img src="./view/image/'.$item['img'].'" alt="home1" class="home__img">
                                <div class="home__indicator"></div>
                            </div>
                            <!-- HOME DATA -->
                            <div class="home__data">
                                <h3 class="home__subtitle">'.$item['type'].'</h3>
                                <h1 class="home__title">'.$item['name'].'</h1>
                                <p class="home__description">'.$item['details'].'</p>
                                <div class="home__buttons">
                                    <a href="./index.php?controller=vehicle&action=selection_flotte&param='.$item['ref'].'" class="button">Select</a>
                                    <a href="./index.php?controller=vehicle&action=get&param=vehicle-home" class="button--link">
                                        Features
                                        <i class="bx bx-right-arrow-alt button__icon"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>';
                }
            ?>
            <!-- ## -->
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Accepter les cookies</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div id="cookie-popup" class="cookie-popup">
    <div class="cookie-content">
        <h2>Ce site utilise des cookies</h2>
        <p>Nous utilisons des cookies pour améliorer votre expérience sur notre site. En continuant à naviguer, vous acceptez notre utilisation des cookies.</p>
        <div class="button-container">
            <button id="accept-cookie-btn">Accepter</button>
            <button id="decline-cookie-btn">Refuser</button>
        </div>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>
