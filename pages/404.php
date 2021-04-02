<?php
?>

<html lang="fr">
<head>
    <title>Erreur 404</title>
</head>
<body>
<div class="error_page">
    <h2>SHORT URL</h2>
    <h1>ERREUR 404</h1>
    <p>Il se peut que la page à laquelle vous essayez d'accéder soit désactivée, ou n'existe pas/plus.</p>
    <p>Déjà connecter ? Accédez à la page utilisateur <a href="dashboard.php">ici</a></p>
    <p>Envie d'utiliser notre service ? Inscrivez vous <a href="dashboard.php">ici</a></p>
</div>
</form>
</body>
</html>


<style>
    body{
        margin: 0 auto;
        background-color: #d680f2;
        font-family: 'Roboto', sans-serif;
    }

    .error_page{
        width: 100vw;
        display: inline-block;
        text-align: center;
        margin: auto;
    }

    .error_page a{
        transition: 0.2s;
        color: white;
        text-decoration: none;
        font-size: 1.2em;
    }

    .error_page a:hover{
        transition: 0.2s;
        color: #d680f2;
    }
</style>