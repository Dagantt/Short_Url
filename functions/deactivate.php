<?php
include_once('connectsqlbase.php');

#Permet de désactiver un lien si il est activé

function deactivate_url() {
    $id_link = $_REQUEST['id_deactivate'];
    $state = 0;

    $base = connectMaBase();
    $sql = "UPDATE user_links SET state=".$state." WHERE id_link =".$id_link.';';
    $base->query($sql);
    $base->close();

    header('Location: ../pages/dashboard.php');
}
?>