<?php
session_start();
if(empty($_SESSION['user']))
    header('Location:./connexion');

$active1 = "active";
$titre = "Home";
require_once './include/header.php';

?>
<section id="presentation">

</section>
<div id="messages">
    
</div>