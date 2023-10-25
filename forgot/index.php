<?php 
//CE qui reste je dois vérifier que le token est uique à la ligne 20
error_reporting(E_ALL);
require_once '../include/session.php';
$titre = "Renitialisation";
?>
<?php 
    if(!empty($_GET)){
        if(count(array_keys($_GET)) === 1 && array_key_exists("token",$_GET)){
            $token = htmlspecialchars($_GET["token"]);
            require_once '../include/dbConnexion.php';
            $stmt = $db->prepare("SELECT nom,prenom FROM users WHERE token = :token");
            $stmt->bindParam(':token',$token);
            $stmt->execute();
            $nomPrenom = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            if($nomPrenom){
                $salutation = "Hi ". $nomPrenom['nom']." ".$nomPrenom['prenom'];
                if(isset($_POST["password"]) && isset($_POST["confirm_password"])){
                    if(htmlspecialchars($_POST["password"]) == htmlspecialchars($_POST["confirm_password"])){
                        $stmt = $db->prepare("UPDATE users SET  password = :password WHERE token = :token");
                        $password = password_hash(htmlspecialchars($_POST['password']),PASSWORD_DEFAULT);
                        $stmt->bindParam(':password',$password);
                        $stmt->bindParam(':token',$token);
                        $stmt->execute();
                        $stmt->closeCursor();
                        $_SESSION['confirmer']['sucess'] = "Password updated sucessfully";
                        header("location:../connexion");
                    }else{
                        // $salutation = "";
                        $error = "Les mots de passe ne sont pas identiques";
                    }
                }
            }else{
                header('location:../connexion');
            }
        }else{
            header('location:../connexion');
        }
        
    }elseif(isset($_POST["send"])){
        $userEmail = htmlspecialchars($_POST['email']);
        if(filter_var($userEmail,FILTER_VALIDATE_EMAIL)){
            require_once '../include/dbConnexion.php';
            $stmt = $db->prepare("SELECT id FROM users WHERE email = :email");
            $stmt->bindParam(':email',$userEmail);
            $stmt->execute();
            if($stmt->fetch()){
                $token = bin2hex(random_bytes(75));
                $stmt->closeCursor();
                $stmt = $db->prepare("UPDATE users SET token = :token");
                $stmt->bindParam(":token",$token);
                $stmt->execute();
                //On va lui envoyer un mail
                $sucess = "Check your mail inbox";
            }else{
                $error = "Adresse inconnue.";
                $stmt->closeCursor();
            }
        }
    }
?>
<?php require_once "../include/headerLogin.php" ?>
    <form action="" method="POST">
        <?php if(isset($salutation)) : ?>
            <h3 class="success"><?=$salutation?><h3>
        <?php endif ; ?>
        <?php if(isset($error)) : ?>
            <h3 class="error"><?=$error?><h3>
        <?php endif ; ?>

        <?php if(isset($sucess)) : ?>
            <h3 class="success"><?=$sucess?><h3>
        <?php endif ; ?>

        <?php if(isset($salutation)) : ?>
            <label for="password">New Password</label>
            <input type="password" placeholder="Password" id="password" name="password">
            <label for="confirm_password">Confirm password</label>
            <input type="password" placeholder="Confirm password" id="confirm_password" name="confirm_password">
            <button type="submit" name="reset">Modifier votre mot de passe</button>
        <?php else :  ?>

        <!-- <h3>We'll send you a mail</h3> -->
            <label for="username">Enter your mail adress</label>
            <input type="email" placeholder="Email" id="username" name="email">
            <button type="submit" name="send">Send</button>
        <?php endif; ?>
        <h3 class="info"> Vous avez un compte?Connectez vous <a href="../connexion"> ici</a></h3>
<?php require_once "../include/footerLogin.php" ?>