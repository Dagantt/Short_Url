<?php
include_once('connectsqlbase.php');

#Permet de supprimer une url du dashboard avec le id_link du lien

function delete_url() {
    $id_link = $_REQUEST['id_link'];

    $base = connectMaBase();
    $sql = 'DELETE FROM user_links WHERE id_link ='.$id_link.';';

    $base->query($sql);
    $base->close();
    header('Location: ../pages/dashboard.php');
}
?>

