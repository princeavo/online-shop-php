<?php
require_once '../include/session.php';
$error = null;
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        extract($_POST);
        $nom = htmlspecialchars($nom);
        $prenom = htmlspecialchars($prenom);
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);
        $confirm_password = htmlspecialchars($confirm_password);
        if(empty($nom)){
            $error = "Le champ nom est laissé vide";
        }elseif(empty($prenom)){
            $error = "Le champ prenom est laissé vide";
        }elseif(empty($email)){
            $error = "Le champ email est laissé vide";
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = "L'email entré est invalide'";
        }elseif(empty($password)){
            $error = "Le champ password est laissé vide";
        }elseif(empty($confirm_password)){
            $error = "Veuillez confirmer le mot de passe";
        }elseif($password !== $confirm_password){
            $error = "Les mots de passe ne sont pas identiques";
        }
        if(empty($error)){
            require_once '../include/dbConnexion.php';
            $stmt = $db->prepare("SELECT * FROM users WHERE email = :email ");
            $stmt->bindParam(':email',$email);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $stmt->closeCursor();
                $error = "Veuillez utiliser une autre adresse email";
            }else{
                $stmt = $db->prepare("INSERT INTO users (id, nom, prenom, email, password, confirme, token,email_id,profile_image) VALUES (NULL,:nom,:prenom,:email,:password,:confirme, :token,:email_id,'user.jpg')");
                $stmt->bindParam(':nom',$nom);
                $stmt->bindParam(':prenom',$prenom);
                $stmt->bindParam(':email',$email);
                $password = password_hash($password,PASSWORD_DEFAULT);
                $stmt->bindParam(':password',$password);
                // $chaine = "abcdefghijklmopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                // $token = str_repeat($chaine,150);
                // $token = str_shuffle($token);
                // $token = substr($token,0,150);
                $token = bin2hex(random_bytes(75));
                $stmt->bindParam(':token',$token);
                // $chaine = "abcdefghijklmopqrstuvwxyz0123456789";
                // $email_id = str_repeat($chaine,150);
                // $email_id = str_shuffle($email_id);
                // $email_id = substr($email_id,0,50);
                $email_id = bin2hex(random_bytes(25));
                $confirme = null;
                $stmt->bindParam(':email_id',$email_id);
                $stmt->bindParam(':confirme',$confirme);
                $stmt->execute();
                if($stmt){
                    $sucess = "Inscription réussie.Veuillez vérifier votre boîte mail afin de confirmer le compte";
                }else{
                    $error = "Inscription échouée.Veuillez réessayer";
                }
            }
        }
    }
    if(!empty($_GET))
        header("location:./");
    require_once "./signup.php"; 