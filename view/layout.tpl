<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIA</title>
    <!-- BOXICONS -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- SWIPER CSS -->
    <link rel="stylesheet" href="./view/styles/styleCSS/swiper-bundle.min.css">
    <!-- STYLE CSS -->
    <link rel="stylesheet" href="./view/styles/styleCSS/style.css">
    <link rel="icon" type="image/x-icon" href="./view/image/favicon_final.ico">
</head>
<body>
    <!-- HEADER -->

    <header class="header" id="header">
        <?php require ('./view/menu/menu.tpl'); ?>	
    </header>

    <!-- MAIN -->
    <main class="main">
        <?php require('./view/' . $controller . '/' . $action . '.tpl'); ?>
    </main>

    <!-- FOOTER -->
    <footer class="footer section">
        <?php require('./view/footer/footer.tpl'); ?>
    </footer>

    <!-- SCROLL UP -->

    <!-- SCROLL REVEAL -->

    <!-- SWIPER JS -->

    <!-- SWIPER JS -->
    <script src="./view/styles/styleJS/swiper-bundle.min.js"></script>
    <!-- MAIN JS -->
    <script src="./view/styles/styleJS/main.js"></script>
</body>
</html>