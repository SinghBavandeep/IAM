
<!-- ACCOUNT -->
<section class="account container" id="account">
    <br><br><br>
    <h2 class="section__title">My Account</h2>

    <div class="login__form">
        <form action="./index.php?controller=user&action=update" method="post" class="login__create" id="login-in">
            <h3 class="login__title">Personal Informations</h3>
            <div class="login__box">
                <i class="bx bxs-user login__icon"></i>
                <input type="text" name="name" value="" placeholder="Name" class="login__input">
            </div>
            <div class="login__box">
                <i class="bx bxs-user login__icon"></i>
                <input type="text" name="pseudo" value="" placeholder="Username" class="login__input">
            </div>
            <div class="login__box">
                <i class="bx bx-at login__icon"></i>
                <input type="email" name="email" value="" placeholder="E-Mail" class="login__input">
            </div>
            <div class="login__box">
                <i class="bx bxs-lock login__icon"></i>
                <input type="password" name="mdp" value="" placeholder="Password" class="login__input" id="password">
                <i class='bx bxs-show login__togglePassword' id="toggle-password"></i>
            </div>
            <div class="login__box">
                <i class='bx bxs-business login__icon' ></i>
                <input type="text" name="adresse" value="" placeholder="Address" class="login__input">
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