<?php 
    if (!empty($msg)) {
        $url = './index.php?controller=user&action=error&param1=user&param2=inscr&arg='.$msg;
        header('Location:' . $url);
    } 
?>


<section class="section login">
    <!-- TITLE -->
    <h2 class="section__title">Sign up</h2>
    <div class="login__container container">
        <div class="login__content">
            <div class="login__img">
                <img src="./view/image/login-img.svg" alt="login">
            </div>
            <!-- FORM -->
            <div class="login__form">
                <form action="./index.php?controller=user&action=inscr" method="post" class="login__create" id="login-in">
                    <h3 class="login__title">Registration</h3>
                    <div class="login__box">
                        <i class="bx bxs-user login__icon"></i>
                        <input type="text" name="name" value="<?php echo $nom; ?>" placeholder="Name" class="login__input">
                    </div>
                    <div class="login__box">
                        <i class="bx bxs-user login__icon"></i>
                        <input type="text" name="pseudo" value="<?php echo $pseudo; ?>" placeholder="Username" class="login__input">
                    </div>
                    <div class="login__box">
                        <i class="bx bx-at login__icon"></i>
                        <input type="email" name="email" value="<?php echo $email; ?>" placeholder="E-Mail" class="login__input">
                    </div>
                    <div class="login__box">
                        <i class="bx bxs-lock login__icon"></i>
                        <input type="password" name="mdp" value="<?php echo $mdp; ?>" placeholder="Password" class="login__input" id="password">
                        <i class='bx bxs-show login__togglePassword' id="toggle-password"></i>
                    </div>
                    <div class="login__box">
                        <i class='bx bxs-business login__icon' ></i>
                        <input type="text" name="adresseE" value="<?php echo $adresseE; ?>" placeholder="Address" class="login__input">
                    </div>
                    <!-- SIGN IN -->
                    <input type="submit" value="Register" class="button login__button"></input>
                    <!-- <p style="color: red;"><?php echo $msg; ?></p> -->
                    
                    <!-- SIGN UP -->
                    <div>
                        <span class="login__account">Already have an account?</span>
                        <a href="./index.php?controller=user&action=ident" class="login__signup">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>