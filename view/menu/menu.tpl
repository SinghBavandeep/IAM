<nav class="nav container">
    <!-- LOGO -->
    <a href="./index.php?controller=user&action=home&param=vehicle-home" class="nav__logo">
        <img src="./view/image/logo_final.png" alt="logo" class="nav__logo-img">
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
            } else {
            // Afficher les onglets pour les clients
            if (isset($_SESSION['profile']['role']) && $_SESSION['profile']['role'] == 'customer') {
            echo '
            <li class="nav__item">
                <a href="./index.php?controller=vehicle&action=getVehicles" class="nav__link">Vehicles</a>
            </li>
            <li class="nav__item">
                <a href="./index.php?controller=sparepart&action=getSpareParts" class="nav__link">Spare parts</a>
            </li>';
            }

            // Afficher les onglets pour les administrateurs
            if (isset($_SESSION['profile']['role']) && $_SESSION['profile']['role'] == 'admin') {
            echo '
            <li class="nav__item">
                <a href="./view/user/Admin/index.php" class="nav__link">Panel</a>
            </li>
            <li class="nav__item">
                <a href="./index.php?controller=user&action=adminpanel" class="nav__link">Paneltest</a>
            </li>
            <li class="nav__item">
                <a href="./index.php?controller=user&action=vehicle_stock" class="nav__link">Stock</a>
            </li>';
            }

            echo '
            <li class="nav__item">
                <a href="./index.php?controller=user&action=deconnexion" class="nav__link">Logout</a>
            </li>';
            }
            ?>
            <li class="nav__item">
                <a href="./index.php?controller=user&action=account" class="nav__logo">
                    <img src="<?php
            if (!isset($_SESSION['profile'])) {
                echo "./view/image/profile-icon.png";
                    } else {
                    if (isset($_SESSION['profile']['role'])) {
                    $image = isset($_SESSION['profile']['photo']) ? $_SESSION['profile']['photo'] : '';
                    echo "./view/image/$image";
                    } else {
                    echo "./view/image/profile-icon.png";
                    }
                    }
                    ?>" width="40px" height="40px" alt="profile">
                    <p class="nav__logo-title"><?php echo isset($_SESSION['profile']) ? $_SESSION['profile']['username'] : 'Your Account'; ?></p>
                </a>
            </li>

        </ul>
        <!-- NAV-CLOSE -->
        <div class="nav__close" id="nav-close">
            <i class="bx bx-x"></i>
        </div>
    </div>
    <!-- NAV BUTTONS -->
    <div class="nav__btns">
        <!-- THEME CHANGE BUTTON -->
        <div class="change-theme">
            <i class='bx bxs-moon' id="theme-btn"></i>
        </div>
        <!-- TOGGLE -->
        <div class="nav__toggle" id="nav-toggle">
            <i class="bx bx-grid-alt"></i>
        </div>
    </div>
</nav>
