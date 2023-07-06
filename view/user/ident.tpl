<?php 
    if (!empty($msg)) {
        $url = './index.php?controller=user&action=erreur&param1=user&param2=ident&arg='.$msg;
        header('Location:' . $url);
    } 
?>

<section class="section login">
    <!-- TITLE -->
    <h2 class="section__title">Connexion</h2>
    <div class="login__container container">
        <div class="login__content">
            <div class="login__img">
                <img src="./view/image/login-img.svg" alt="login">
            </div>
            <!-- FORM -->
            <div class="login__form">
                <form action="./index.php?controller=user&action=ident" method="post" class="login__register" id="login-in">
                    <h3 class="login__title">Authentification</h3>
                    <div class="login__box">
                        <i class="bx bxs-user login__icon"></i>
                        <input type="text" name="ident" value="<?php echo $ident; ?>" placeholder="ID" class="login__input">
                    </div>
                    <div class="login__box">
                        <i class="bx bxs-lock login__icon"></i>
                        <input type="password" name="mdp" value="<?php echo $mdp; ?>" placeholder="Password" class="login__input" id="password">
                        <i class='bx bxs-show login__togglePassword' id="toggle-password"></i>
                    </div>
                    <!-- FORGOT PASSWORD -->
                    <a href="#" class="login__forgot">Forgot your password?</a>
                    <!-- SIGN IN -->
                    <input type="submit" value="login" class="button login__button"></input>
                    <!-- <p style="color: red;"><?php echo $msg; ?></p> -->
                    
                    <!-- SIGN UP -->
                    <div>
                        <span class="login__account">You do not have an account?</span>
                        <a href="./index.php?controller=user&action=inscr" class="login__signin">Sign up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>