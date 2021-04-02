<?php
include_once("connectsqlbase.php");


function random_string () { #Fonction permettant la création d'un string random (https://stackoverflow.com/questions/4356289/php-random-string-generator)
    $random_string = substr(md5(rand()), 0, 7);
    return $random_string;
}

function add_link_bdd () { #Récupère le lien pour le mettre dans la bdd
    if(isset ($_POST['link'])){
        $raw_long_link = $_POST['link'];
        if (filter_var($raw_long_link, FILTER_VALIDATE_URL) === FALSE) {
            invalide_url();
            return false;
        }
    } else {
        return;
    }

    $base = connectMaBase();
    $user_id = ($_SESSION["user_id"]);
    $sql = 'SELECT long_url FROM user_links WHERE id_user ='.$user_id.' AND long_url ="'.$raw_long_link.'";';
    $result = $base->query($sql);

    if ($result != null) { #Récupère les liens en fonction de l'user id pour éviter les doublons
        if ($result->num_rows > 0) {
            echo('Lien existe déjà');
        }
        else {
            $short_url = random_string(); #Créer un string aléatoire pour le code raccourci
            $sql = 'SELECT short_url FROM user_links WHERE short_url ="'.$short_url.'";';
            $result = $base->query($sql);
            while($result->num_rows > 0) { #Vérifie parmis les codes aléatoires que celui crée n'existe pas déjà
                $short_url = random_string();
                $sql = 'SELECT short_url FROM user_links WHERE short_url ="'.$short_url.'";';
                $result = $base->query($sql);
            }
            #Insère les données dans la bdd, et reload la page pour rafraichir les liens de l'utilisateur
            $sql = 'INSERT INTO user_links(long_url, short_url, id_user) VALUES("'.$raw_long_link.'","'.$short_url.'",'.$user_id.')';
            mysqli_query($base, $sql) or die($sql);
            mysqli_close($base);
            header('Location: ../pages/dashboard.php');
        }
    }
}
?>


