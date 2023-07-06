<nav class="nav container">
    <!-- LOGO -->
    <a href="./index.php?controller=user&action=accueil&param=vehicle-home" class="nav__logo">
        <img src="./view/image/logo_final.png" alt="logo" class="nav__logo-img">
        <p class="nav__logo-title"><?php echo isset($_SESSION['profil']) ? $_SESSION['profil']['pseudo'] : ''; ?></p>
    </a>
    <!-- MENU -->
    <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
            <li class="nav__item">
                <a href="./index.php?controller=user&action=accueil&param=vehicle-home" class="nav__link">Home</a>
            </li>
            <?php 
                if ($controller == 'accueil') {
                    echo '
                    <!-- <li class="nav__item">
                        <a href="#about" class="nav__link">About</a>
                    </li>
                    <li class="nav__item">
                        <a href="#trick" class="nav__link">Candy</a>
                    </li>
                    <li class="nav__item">
                        <a href="#new" class="nav__link">New</a>
                    </li> -->
                    ';
                }
                if (!isset($_SESSION['profil'])) {
                    echo '
                    <li class="nav__item">
                        <a href="./index.php?controller=user&action=inscr" class="nav__link">Inscription</a>
                    </li>
                    <li class="nav__item">
                        <a href="./index.php?controller=user&action=ident" class="nav__link">Login</a>
                    </li>';

                }else{
                    if ($_SESSION['profil']['role'] == 'client') {
                        echo'
                        <li class="nav__item">
                            <a href="./index.php?controller=vehicle&action=get" class="nav__link">Vehicles</a>
                        </li>
                        <li class="nav__item">
                            <a href="./index.php?controller=vehicle&action=get" class="nav__link">Spare part</a>
                        </li>';
                    }
                    if ($_SESSION['profil']['role'] == 'loueur') {
                        echo'
                        <li class="nav__item">
                            <a href="./index.php?controller=vehicle&action=get&param=vehicle-stock" class="nav__link">Stock</a>
                        </li>
                        <li class="nav__item">
                            <a href="./index.php?controller=vehicle&action=get&param=vehicle-rent" class="nav__link">Vehicles</a>
                        </li>
                        <li class="nav__item">
                            <a href="./index.php?controller=vehicle&action=get" class="nav__link">Spare part</a>
                        </li>';
                    }
                    echo'
                    <li class="nav__item">
                        <a href="./index.php?controller=user&action=deconnexion" class="nav__link">Logout</a>
                    </li>';
                }

            ?>
            
        </ul>
        <!-- NAV-CLOSE -->
        <div class="nav__close" id="nav-close">
            <i class="bx bx-x"></i>
        </div>
    </div>
    <!-- NAV BUTTONS -->
    <div class="nav__btns">
        <!-- THEME CHANGE BUTTON -->
        <div class="change-theme" >
            <i class='bx bxs-moon' id="theme-btn"></i>
        </div>
        <!-- TOGGLE -->
        <div class="nav__toggle" id="nav-toggle">
            <i class="bx bx-grid-alt"></i>
        </div>
    </div>
</nav>