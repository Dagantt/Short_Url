<?php
include_once('connectsqlbase.php');

#Enlève les variables globals pour couper la connexion, et renoive vers login

session_start();
unset($_SESSION["pseudo"]);
unset($_SESSION["user_id"]);
header("Location: ../pages/login.php");
?>