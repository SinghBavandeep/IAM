<!-- ACCOUNT -->
<section class="account container" id="account">
    <br><br><br>
    <h2 class="section__title">My Account</h2>
    <div class="login__form">
        <form action="./index.php?controller=user&action=update" method="post" class="login__create" id="login-in">
            <h3 class="login__title">Personal Informations</h3>
            <div class="d-flex justify-content-center align-items-center vh-100">
                <div class="shadow w-350 p-3 text-center">
                    <img src="
                            <?php
                                if (!isset($_SESSION['profile'])) {
                                    echo "./view/image/profile-icon.png";
                    }else{
                    if (isset($_SESSION['profile']['role'])) {
                    $image = isset($_SESSION['profile']['photo']) ? $_SESSION['profile']['photo'] : '';
                    echo "./view/image/$image";
                    } else {
                    // Gérer le cas où la clé 'role' n'est pas définie dans le tableau $_SESSION['profile']
                    echo "Role is not defined.";
                    }
                    }
                    ?>"width="140px" height="140px" class="image-ronde">
                    <h3 class="display-4 "><?php echo isset($_SESSION['profile']) ? $_SESSION['profile']['username'] : ''; ?></h3>
                </div>
            </div>



            <div class="login__box">
                <i class="bx bxs-user login__icon"></i>
                <input type="text" name="name" value="<?php echo isset($_SESSION['profile']) ? $_SESSION['profile']['name'] : ''; ?>" placeholder="Name" class="login__input" required>
            </div>
            <div class="login__box">
                <i class="bx bxs-user login__icon"></i>
                <input type="text" name="username" value="<?php echo isset($_SESSION['profile']) ? $_SESSION['profile']['username'] : ''; ?>" placeholder="Username" class="login__input" required>
            </div>
            <div class="login__box">
                <i class="bx bx-at login__icon"></i>
                <input type="email" name="email" value="<?php echo isset($_SESSION['profile']) ? $_SESSION['profile']['email'] : ''; ?>" placeholder="E-Mail" class="login__input" required>
            </div>
            <div class="login__box">
                <i class="bx bxs-lock login__icon"></i>
                <input type="password" name="password" value="" placeholder="Password" class="login__input" id="password">
                <i class='bx bxs-show login__togglePassword' id="toggle-password"></i>
            </div>
            <div class="login__box">
                <i class='bx bxs-business login__icon' ></i>
                <input type="text" name="address" value="<?php echo isset($_SESSION['profile']) ? $_SESSION['profile']['address'] : ''; ?>" placeholder="Address" class="login__input" required>
            </div>
            <div class="login__box">
                <label for="photo">Profile Picture:</label>
                <input type="file" name="photo" value="<?php echo isset($_SESSION['profile']) ? $_SESSION['profile']['photo'] : ''; ?>" id="photo" >
            </div>
            <!-- MODIFY -->
            <input type="submit" value="Update" class="button login__button"></input>
            <!-- RESET -->
            <input type="reset" value="Reset" class="button login__button"></input>
        </form>
    </div>
</section>


<div class="swiper-pagination"></div>
</div>
</section>