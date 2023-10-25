<?php 
require_once '../include/session.php';
$titre = "Inscription";
?>
<?php require_once "../include/headerLogin.php" ?>
    <form action="./" method="POST">
        <h3 class="error"><?php if(isset($error)) echo $error;?><h3>
        <h3 class="success"><?php if(isset($sucess)) echo $sucess;?><h3>
        <h3>Sign up Here</h3>
        <label for="username">Nom</label>
        <input type="text" placeholder="Votre nom" id="username" name="nom">
        <label for="username">Prenom</label>
        <input type="text" placeholder="Votre prénom" id="username" name="prenom">
        <label for="username">Email</label>
        <input type="email" placeholder="Email" id="username" name="email">
        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password">
        <label for="confirm_password">Confirm password</label>
        <input type="password" placeholder="Confirm password" id="confirm_password" name="confirm_password">

        <button type="submit">Sign up</button>
        <h3 class="info"> Vous avez un compte?Connectez vous <a href="./signin.php"> ici</a></h3>
<?php require_once "../include/footerLogin.php" ?>