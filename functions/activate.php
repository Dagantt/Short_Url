<?php
include_once('connectsqlbase.php');

# Permet de ré activer un lien s’il est désactivé

function activate_url() {
    $id_link = $_REQUEST['id_activate'];
    $state = 1;

    $base = connectMaBase();
    $sql = "UPDATE user_links SET state=".$state." WHERE id_link =".$id_link.';';
    $base->query($sql);
    $base->close();

    header('Location: ../pages/dashboard.php');
}
?>