<nav class="nav container">
    <!-- LOGO -->
    <a href="./index.php?controller=user&action=home&param=vehicle-home" class="nav__logo">
        <img src="./view/image/logo_final.png" alt="logo" class="nav__logo-img">
    </a>
    <a href="./index.php?controller=user&action=account" class="nav__logo">
        <img src="
        <?php
            if (!isset($_SESSION['profile'])) {
                echo "./view/image/profile-icon.png";
            }else{
                if ($_SESSION['profile']['role'] == 'customer') {
                    $image= isset($_SESSION['profile']) ? $_SESSION['profile']['photo'] : '';
                    echo "./view/image/$image";
                }else{
                    if ($_SESSION['profile']['role'] == 'admin') {
                        $image= isset($_SESSION['profile']) ? $_SESSION['profile']['photo'] : '';
                        echo "./view/image/$image";
                    }else{
                        $image= isset($_SESSION['profile']) ? $_SESSION['profile']['photo'] : '';
                        echo "./view/image/$image";
                    }
                }
            }


        ?>"width="40px" height="40px" alt="profile" >
        <p class="nav__logo-title"><?php echo isset($_SESSION['profile']) ? $_SESSION['profile']['username'] : ''; ?></p>
    </a>
    <!-- MENU -->
    <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
            <li class="nav__item">
                <a href="./index.php?controller=user&action=home&param=vehicle-home" class="nav__link">Home</a>
            </li>
            <?php

                if (!isset($_SESSION['profile'])) {
                    echo '
                    <li class="nav__item">
                        <a href="./index.php?controller=user&action=inscr" class="nav__link">Sign up</a>
                    </li>
                    <li class="nav__item">
                        <a href="./index.php?controller=user&action=ident" class="nav__link">Login</a>
                    </li>';

                }else{
                    if ($_SESSION['profile']['role'] == 'customer') {
                        echo'
                        <li class="nav__item">
                            <a href="./index.php?controller=vehicle&action=get" class="nav__link">Vehicles</a>
                        </li>
                        <li class="nav__item">
                            <a href="./index.php?controller=vehicle&action=get" class="nav__link">Spare part</a>
                        </li>';
                    }
                    if ($_SESSION['profile']['role'] == 'admin') {
                        echo'
                        <li class="nav__item">
                            <a href="./view\user\Admin\index.php" class="nav__link">Panel</a>
                        </li>
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

