<section class="section login">
    <!-- TITLE -->
    <h2 class="section__title">Location de véhicule</h2>
    <div class="login__container container">
        <div class="login__content">
            <!-- FORM -->
            <form <?php echo 'action="./index.php?controle=vehicule&action=modifier_dates&param='.$idv.'"'; ?> method="post" class="login__create" id="login-in">
                <h3 class="login__title">Change date</h3>
                <label class="login__label">Beginning</label>
                <div class="login__box">
                    <div></div>
                    <input type="date" name="debut" value="<?php echo $debutL; ?>" placeholder="Date de début" class="login__input">
                </div>
                <label class="login__label">End</label>
                <div class="login__box">
                    <div></div>
                    <input type="date" name="fin" value="<?php echo $finL; ?>" placeholder="End date" class="login__input">
                </div>
                <!-- VALIDATE -->
                <input type="submit" value="To validate" class="button login__button"></input>
            </form>
        </div>
    </div>
</section>