<?php

include_once('connectsqlbase.php');

function register(){
    $today = date("d.m.y");
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){ #Si les champs sont vides, envoie une erreur
        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp'];
    } else {
        echo("<p style='color: #a01414; text-align: center'>L'un des deux champs est vide, veuillez remplir les deux champs</p>");
        return false;
    }

    $base = connectMaBase();
    $sql = 'SELECT pseudo FROM user_table WHERE pseudo = "'.$pseudo.'"';
    $result = $base->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pseudo_sql = $row['pseudo'];
        if ($pseudo == $pseudo_sql) { #Si ce pseudo existe déjà, empèche l'utilisateur de crée son comtpe et renoive une erreur
            echo ("<p style='color: #a01414; text-align: center'>Ce pseudo est déjà utilisé, veuillez utiliser un autre pseudo</p>");
            return false;
        }
    }


    #Si tout est bon, envoie le pseudo, le mot de passe hashé(pour la sécuriter) et la date d'aujourd'hui a la bdd
    $hash = hash("sha256", $mdp);
    $sql = 'INSERT INTO user_table(pseudo, mdp, date) VALUES("'.$pseudo.'","'.$hash.'","'.$today.'")';
    mysqli_query($base, $sql) or die($sql);
    mysqli_close($base);
    header('Location: ../pages/login.php');
}

?>