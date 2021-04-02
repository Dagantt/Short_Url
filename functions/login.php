<?php
include_once('connectsqlbase.php');

# Permet de se login

function login(){
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){  # Si un des deux champs est vide, renvoie une erreur
        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp'];
    } else {
        echo("<p style='color: #a01414; text-align: center'>L'un des deux champs est vide, veuillez remplir les deux champs</p>");
        return false;
    }


    $base = connectMaBase();
    $sql = 'SELECT pseudo, mdp, id FROM user_table WHERE pseudo = "'.$pseudo.'"';
    $result = $base->query($sql); #Récupère ce que contient la requete sql(du pseudo correspondant au formulaire ici)

    if ($result->num_rows > 0) { #Vérifie que la bdd contient des informations
        $row = $result->fetch_assoc(); # Mets les résultats dans un tableau
        $pseudo = $row['pseudo'];
        $mdp_sql = $row['mdp'];
        $id_sql = $row['id'];
        $hash = hash("sha256", $mdp); #Hash de mot de passe pour compararer avec celui de la bdd
        if ($hash == $mdp_sql) {
            session_start(); #Si les deux mdp concordent, la session est crée, et des variables globals pseudo et
            $_SESSION["pseudo"] = $pseudo; #user_id sont crées pour maintenir la connexion
            $_SESSION["user_id"] = $id_sql;
            header('Location: dashboard.php'); #renvoie vers la page utilisateur
        } else {
            echo("<p style='color: #a01414; text-align: center'>Mauvais mot de passe</p>");
        }
    } else {
        echo ("<p style='color: white; text-align: center'>Aucun Résultats</p>");
    }
    $base->close();
}
?>