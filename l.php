<?php
include_once('functions/connectsqlbase.php');

$short_code = $_SERVER['REQUEST_URI']; #Récupère l'url actuelle
$id = substr($short_code, strrpos($short_code, '/') + 1); #Récupère uniquement ce qu'il y après le dernier /


$base = connectMaBase();
$sql = 'SELECT long_url, state, views, id_link FROM user_links WHERE short_url ="'.$id.'";';
$result = $base->query($sql);
$row = $result->fetch_assoc();


$link = $row['long_url'];
$state = $row['state'];
$views = $row['views'];
$id_link = $row['id_link'];
if ($state == 1) { #Si le lien est activé, met à jour le compteur sur la bdd, et renvoie vers le lien
    $views += 1;
    $sql = "UPDATE user_links SET views=".$views." WHERE id_link =".$id_link.';';
    $base->query($sql);
    header('Location: '.$link.'');
} else { #Si toute autre requête renvoie une page 404
    header('Location: ../pages/404.php');
}
$base->close();
?>