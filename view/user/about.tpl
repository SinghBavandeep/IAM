<style>
    .banner {
        width: 935px;
        height: 200px;
        display: flex;
        overflow: hidden;
        border-radius: 90px;
        border: 2px solid black;
    }

    .banner img {
        width: 200px;
        height: 200px;
        object-fit: cover;
    }

    .diagonal-bar {
        width: 100%;
        height: 100%;
        position: relative;
        clip-path: polygon(0 0, 100% 0, 80% 100%, 0% 100%);
        background-color: black; /* Couleur de la barre diagonale */
        z-index: 1;
    }
    .gallery {
        display: flex;
        overflow: hidden;
        width: 935px; /* Ajustez la largeur de la galerie selon vos besoins */
        margin: 0 auto;
        border-radius: 90px
    }

    .gallery img {
        max-width: 100%;
        height: auto;
    }
    html {
        box-sizing: border-box;
    }


    *,
    *:before,
    *:after {
        box-sizing: inherit;
    }

    .grid {
        width: 100%;
        max-width: 60rem;
        margin-left: auto;
        margin-right: auto;

        display: flex;
        -webkit-box-orient: horizontal;
        -webkit-box-direction: normal;
        flex-direction: row;
        flex-wrap: wrap;
    }

    .grid-block {
        width: 50%;
        min-height: 11.25rem;
        padding: 1rem;
    }

    .image-grid {

        -webkit-perspective: 1000px;
        perspective: 1000px;
    }

    .image-grid .tile-link:hover .tile-img {
        top: -1rem;
        left: -1rem;
    }

    .image-grid .tile-img {
        position: relative;
        top: 0;
        left: 40px;
        -webkit-transition-property: opacity, top, left, box-shadow;
        transition-property: opacity, top, left, box-shadow;
    }

    .tile-link {
        display: block;
    }

    .tile-link:hover .tile-img {
        opacity: 1;
    }

    .tile-link:hover .tile-img-link {
        display: block;
    }

    .tile-link:hover .tile-img-link:hover .tile-img {
        opacity: 0.5;
    }

    .tile-img {
        display: block;
        width: 80%;
        height: auto;
        opacity: 1;
        -webkit-transition-property: opacity;
        transition-property: opacity;
        -webkit-transition-duration: 0.125s;
        transition-duration: 0.125s;
        -webkit-transition-timing-function: ease-in;
        transition-timing-function: ease-in;
    }
    .tile-link:hover .tile-img1 {
        box-shadow: 5px 5px rgba(244, 170, 200, 0.4),
        10px 10px rgba(244, 170, 200, 0.3), 15px 15px rgba(244, 170, 200, 0.2),
        20px 20px rgba(244, 170, 200, 0.1), 25px 25px rgba(244, 170, 200, 0.05);
    }

    .tile-link:hover .tile-img2 {
        box-shadow: 5px 5px rgba(45, 186, 233, 0.4), 10px 10px rgba(45, 186, 233, 0.3),
        15px 15px rgba(45, 186, 233, 0.2), 20px 20px rgba(45, 186, 233, 0.1),
        25px 25px rgba(45, 186, 233, 0.05);
    }

    .tile-link:hover .tile-img3 {
        box-shadow: 5px 5px rgba(214, 221, 244, 0.4),
        10px 10px rgba(214, 221, 244, 0.3), 15px 15px rgba(214, 221, 244, 0.2),
        20px 20px rgba(214, 221, 244, 0.1), 25px 25px rgba(214, 221, 244, 0.05);
    }

    .tile-link:hover .tile-img4 {
        box-shadow: 5px 5px rgba(82, 119, 192, 0.4), 10px 10px rgba(82, 119, 192, 0.3),
        15px 15px rgba(82, 119, 192, 0.2), 20px 20px rgba(82, 119, 192, 0.1),
        25px 25px rgba(82, 119, 192, 0.05);
    }

    .tile-link:hover .tile-img5 {
        box-shadow: 5px 5px rgba(138, 218, 245, 0.4),
        10px 10px rgba(138, 218, 245, 0.3), 15px 15px rgba(138, 218, 245, 0.2),
        20px 20px rgba(138, 218, 245, 0.1), 25px 25px rgba(138, 218, 245, 0.05);
    }

    .tile-link:hover .tile-img6 {
        box-shadow: 5px 5px rgba(203, 215, 193, 0.4),
        10px 10px rgba(203, 215, 193, 0.3), 15px 15px rgba(203, 215, 193, 0.2),
        20px 20px rgba(203, 215, 193, 0.1), 25px 25px rgba(203, 215, 193, 0.05);
    }

    .tile-link:hover .tile-img7 {
        box-shadow: 5px 5px rgba(91, 209, 250, 0.4), 10px 10px rgba(91, 209, 250, 0.3),
        15px 15px rgba(91, 209, 250, 0.2), 20px 20px rgba(91, 209, 250, 0.1),
        25px 25px rgba(91, 209, 250, 0.05);
    }
    .tile-link:hover .tile-img8 {
        box-shadow: 5px 5px rgba(145, 156, 196, 0.4),
        10px 10px rgba(145, 156, 196, 0.3), 15px 15px rgba(145, 156, 196, 0.2),
        20px 20px rgba(145, 156, 196, 0.1), 25px 25px rgba(145, 156, 196, 0.05);
    }

    .tile-link:hover .tile-img9 {
        box-shadow: 5px 5px rgba(188, 97, 129, 0.4), 10px 10px rgba(188, 97, 129, 0.3),
        15px 15px rgba(188, 97, 129, 0.2), 20px 20px rgba(188, 97, 129, 0.1),
        25px 25px rgba(188, 97, 129, 0.05);
    }

    .tile-link:hover .tile-img10 {
        box-shadow: 5px 5px rgba(4, 140, 231, 0.4), 10px 10px rgba(4, 140, 231, 0.3),
        15px 15px rgba(4, 140, 231, 0.2), 20px 20px rgba(4, 140, 231, 0.1),
        25px 25px rgba(4, 140, 231, 0.05);
    }

</style>
<section class="account container" id="account">
    <br><br><br>
    <h2 class="section__title">About Us</h2>
    <div class="login__form">
        <div class="login__create">
            <h3 class="home__subtitle">WELCOME TO IAM</h3>
            <p class="home__description" style="text-align: justify;">Welcome to Guaranteed Automotive and Transmission Service,
                your head pick for master vehicle fix close and around Lafayette, IN.
                Our very educated ASE-Certified auto mechanics really have an enthusiasm for playing
                out a wide range of vehicle fix administrations, huge or little.</p>

            <div class="gallery" id="gallery">
                <?php
                    $directory = './view/image/AboutusG/';
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                    $files = scandir($directory);
                    foreach ($files as $file) {
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                        if (in_array($extension, $allowedExtensions)) {
                            echo '<img src="' . $directory . $file . '" alt="' . $file . '">';
                        }
                    }
                ?>
            </div><br>

            <p class="home__description" style="text-align: justify;">Our group can get to the foundation of the issue and fix
                car glitches that other vehicle benefit focuses may miss. The amenable and agreeable
                group at IAM has such huge numbers of faithful and long-haul customers
                since we meet due dates, surpass guarantees, and go well beyond inevitably.</p>

            <div class="Contrie_box">
                <div class="grid image-grid">

                    <div class="grid-block">
                        <div class="tile">
                            <a class="tile-link" href="#">
                                <img class="tile-img tile-img1" src="./view/image/schooroom3.jpg" alt="Image">
                            </a>
                        </div>
                    </div>

                    <div class="grid-block">
                        <div class="tile">
                            <a class="tile-link" href="#">
                                <img class="tile-img tile-img1" src="./view/image/schooroom2.jpg" alt="Image">
                            </a>
                        </div>
                    </div>
                </div><br>
            </div>


            <p class="home__description" style="text-align: justify;">Vehicle proprietors in the Lafayette, IN territory,
                have come to believe that IAM is not normal for some other vehicle fix shop.
                In case you’re searching for an auto-fix encounter that is consistent and agreeable,
                at that point you’ll be satisfied that you chose us.</p>
            <div class="banner">
                <img src="./view/image/wheel1.png" alt="Image 1">
                <div class="diagonal-bar"></div>
                <img src="./view/image/wheel2.png" alt="Image 2">
                <div class="diagonal-bar"></div>
                <img src="./view/image/wheel3.png" alt="Image 3">
                <div class="diagonal-bar"></div>
                <img src="./view/image/wheel4.png" alt="Image 4">
                <div class="diagonal-bar"></div>
                <img src="./view/image/wheel5.png" alt="Image 5">
                <div class="diagonal-bar"></div>
                <img src="./view/image/wheel6.png" alt="Image 6">
            </div><br>

            <p class="home__description" style="text-align: justify;">The group at IAM is productive, wonderful, and has the mission
                of having your head out in a vehicle that will keep you, your travelers, and different
                drivers out and about out of damage’s way. A few different things make us emerge</p>
        </div>
    </div>
</section>
<script>
    // Code JavaScript pour faire défiler la galerie automatiquement
    let gallery = document.getElementById('gallery');
    let images = gallery.getElementsByTagName('img');
    let currentIndex = 0;
    let interval = 6000;

    function showNextImage() {
        images[currentIndex].style.display = 'none';
        currentIndex = (currentIndex + 1) % images.length;
        images[currentIndex].style.display = 'block';
    }

    // Cacher toutes les images sauf la première
    for (let i = 1; i < images.length; i++) {
        images[i].style.display = 'none';
    }

    // Commencer le défilement automatique
    setInterval(showNextImage, interval);
</script>

<div class="swiper-pagination"></div>
</div>
</section>