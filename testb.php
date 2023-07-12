<!DOCTYPE html>
<html>
<head>
    <title>Affichage dynamique</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
<button id="afficherBtn">Afficher le code</button>

<pre id="code" class="hidden">
        <?php
        // Code à afficher
        echo "Hello, world!";
        ?>
    </pre>

<script>
    $(document).ready(function() {
        $('#afficherBtn').click(function() {
            $('#code').toggleClass('hidden');
        });
    });
</script>
</body>
</html>
