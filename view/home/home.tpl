
<!-- HOME -->
<section class="home container" id="home">
    <br><br>
    <h2 class="section__title">Welcome to IAM!</h2>
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

