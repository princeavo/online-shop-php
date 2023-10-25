<?php
require_once '../include/session.php';
$titre = "Connexion";
if(!empty($_SESSION['confirmer']['error'])){
    $error = $_SESSION['confirmer']['error'];
    unset($_SESSION['confirmer']['error']);
}
if(!empty($_SESSION['confirmer']['sucess'])){
    $sucess = $_SESSION['confirmer']['sucess'];
    unset($_SESSION['confirmer']['sucess']);
}

?>
<?php require_once "../include/headerLogin.php" ?>
    <form action="./" method="POST">
        <h3 class="error"><?php if(isset($error)) echo $error;?><h3>
        <h3 class="success"><?php if(isset($sucess)) echo $sucess;?><h3>
        <h3>Login Here</h3>
        <label for="username">Email</label>
        <input type="email" placeholder="Email" id="username" name="email">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password">

        <button type="submit">Log In</button>
        <h3 class="info">Nouveau sur le site?Inscrivez-vous <a href="../inscription"> ici</a></h3>
        <h3 class="info">Mot de passe oublié? <a href="../forgot/"> Renitialiser ici</a></h3>
<?php require_once "../include/footerLogin.php" ?>