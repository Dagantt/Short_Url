<?php
require ('../functions/register.php');
?>

<html lang="fr">
<head>
    <title>Formulaire d'inscription</title>
</head>
<body>
    <header>
        <h1>Inscrivez-vous</h1>
    </header>
    <form name="inscription" method="post" action="" class="inscription_sec">
        <p>Entrez votre pseudo</p> <input type="text" name="pseudo"/> <br/>
        <p>Entrez votre mot de passe</p> <input type="password" name="mdp"/> <br/>
        <input type="submit" name="valider" value="OK"/>
    </form>
    <div class="already_register">
        <p>Déjà inscrit ? Connectez vous <a href="login.php">ici</a></p>
    </div>
</body>
</html>

<?php
if (isset ($_POST['valider'])){
    register();
}

?>

<style>
    body{
        margin: 0 auto;
        font-family: 'Roboto', sans-serif;
        background-color: #945abd;
    }

    header{
        text-align: center;
        color: darkorange;
        font-size: 2em;
        margin-top: 2em;
    }

    .inscription_sec{
        width: 25em;
        margin: 0 auto;
        text-align: center;
    }

    .inscription_sec p{
        color: white;
        font-size: 1.8em;
    }

    input[type=text] {
        font-size: 1.2em;
        width: 80%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: 4px solid darkorange;
        border-radius: 4px;
        background-color: #d680f2;
        color: white;
    }

    input[type=password] {
        font-size: 1.2em;
        width: 80%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: 4px solid darkorange;
        border-radius: 4px;
        background-color: #d680f2;
        color: white;
    }

    input[type=submit] {
        transition: 0.2s;
        margin-top: 2em;
        padding: 5px 15px;
        background: darkorange;
        border: 0 none;
        cursor: pointer;
        color: white;
        -webkit-border-radius: 5px;
        border-radius: 5px;
    }

    input[type=submit]:hover {
        transition: 0.2s;
        background: #9600ff;
    }

    .already_register{
        width: 25em;
        margin: auto;
        text-align: center;
        margin-top: 2em;
    }

    .already_register a{
        transition: 0.2s;
        color: white;
        text-decoration: none;
        font-size: 1.2em;
    }

    .already_register a:hover{
        transition: 0.2s;
        color: #d680f2;
    }
</style>
