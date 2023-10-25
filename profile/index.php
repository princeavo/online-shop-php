<?php
session_start();
if(empty($_SESSION['user']))
    header('Location:../connexion');
$titre = "Mon profil";
require_once 'edit_profile.php';