<?php
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page non trouvée - Erreur 404</title>
    <style>
        body {
            background-color: #f8f9fa;
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
            color: #dc3545;
        }
    </style>
</head>
<body>
    <h1>Erreur 404 - Page non trouvée</h1>
    <img src="public/errors/404.png" alt="Erreur 404">
    <p>La page que vous cherchez n'existe pas ou a été déplacée.</p>
</body>
</html>
