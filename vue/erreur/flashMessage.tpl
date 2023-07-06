
<!-- FHASH MESSAGE -->
<section class="section flash">
    <div class="flash__container container grid">
        <div class="flash__content">
            <div class="flash__img">
                <img src="./vue/img/flash-img.png" alt="flash">
            </div>
            <div class="flash__data">
                <h3 class="flash__title">Oooops!!</h3>
                <p class="flash__description">
                    <?php echo $_GET['arg'];?>
                </p>
            </div>
            <?php echo '
                <a href="./index.php?controle='.$_GET['param1'].'&action='.$_GET['param2'].'" class="button flash__button">Try again</a>
                ';
            ?>
        </div>
    </div>
</section>
