<?php

# Fonction permettant la connexion à la base de données

function connectMaBase(){
    $base = mysqli_connect('localhost', 'root', "", 'shorturl');
    return $base;
}
?>

