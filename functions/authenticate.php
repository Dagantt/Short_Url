<?php
include_once('connectsqlbase.php');

/* L'user_id de la session est crée à la connexion du site, si l'utilisateur est connecté il peut accéder à sa page
dashboard, s'il n'en a pas, il est redirigé vers login */

session_start();
if(!isset($_SESSION['user_id'])){
    header('Location: ../pages/login.php');
    exit;
}
?>