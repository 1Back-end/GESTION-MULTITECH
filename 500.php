<?php
http_response_code(500);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Erreur interne - 500</title>
    <style>
        body {
            background-color: #fdf1f1;
            text-align: center;
            padding: 50px;
            font-family: Arial, sans-serif;
        }
        img {
            max-width: 100%;
            height: auto;
            max-height: 500px;
        }
        h1 {
            color: #ff0000;
        }
    </style>
</head>
<body>
    <h1>Erreur 500 - Erreur interne du serveur</h1>
    <img src="/public/images/errors/500.jpg" alt="Erreur 500">
    <p>Quelque chose s'est mal passé. Veuillez réessayer plus tard.</p>
</body>
</html>
