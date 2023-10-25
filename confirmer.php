<?php
require_once './include/session.php';
  if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(count($_GET) === 1 && !empty($_GET['token'])){
      $tokenId = htmlspecialchars($_GET['token']);
      $token = substr($tokenId, 0,150);
      $email_id = substr($tokenId,150,50);
      require_once './include/dbConnexion.php';
      $stmt = $db->prepare('SELECT * FROM users WHERE token = :token AND email_id = :email_id');
      $stmt->bindParam(':token', $token);
      $stmt->bindParam(':email_id', $email_id);
      $stmt->execute();
      $user = $stmt->fetch();
      $stmt->closeCursor();
      if($user){
        if($user['confirme'] === NULL){
          $stmt = $db->prepare('UPDATE users SET confirme = NOW() WHERE token = :token AND email_id = :email_id');
          $stmt->bindParam(':token',$token);
          $stmt->bindParam(':email_id',$email_id);
          $stmt->execute();
          if($stmt->fetch()){
            $_SESSION['confirmer']['sucess']='Votre compte a été bien confirmé';
          }else{
            $_SESSION['confirmer']['error']='Une erreur est survenue.Veuillez réessayer';
          }
          $stmt->closeCursor();
        }else{
          $_SESSION['confirmer']['sucess']='Votre compte est bien actif';
        }
      }else{
        $_SESSION['confirmer']['error']='Compte introuvable';
      }
    }
    // var_dump($_COOKIE);
    header("location:./connexion");
  }