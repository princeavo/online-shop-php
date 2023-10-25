<?php
require_once '../include/session.php';
$error = null;
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        extract($_POST);
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);
        if(empty($email)){
            $error = "Le champ email est laissé vide";
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = "L'email entré est invalide'";
        }elseif(empty($password)){
            $error = "Le champ password est laissé vide";
        }
        if(empty($error)){
            require_once '../include/dbConnexion.php';
            $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email',$email);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                if(!$user['confirme']){
                    $error = "Veuillez vérifier votre boîte mail afin de confirmer le compte";
                }else{
                    if(password_verify($password,$user['password'])){
                        $_SESSION['user'] = $user;
                        header("Location:/tasks");
                        die();
                    }else{
                        $error = "Le mot de passe est incorrect";
                    }
                }
            }else{
                $error = "Identifiants invalides";
            }
        }
    }
    if(!empty($_GET))
        header("location:./connexion");
    require_once "./signin.php";