<?php
if($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['value']))
    header("Location:../");
if(session_status() == PHP_SESSION_NONE)
    session_start();
// var_dump($_SERVER);
// var_dump($_POST); die();
// var_dump($_FILES);

require_once '../include/dbConnexion.php';

$request = $db->prepare("UPDATE users SET  nom=:nom,prenom=:prenom WHERE id=:id ");
$nomUser = htmlspecialchars($_POST['nom']);
$request->bindParam(":nom", $nomUser);
$prenomUser = htmlspecialchars($_POST['prenom']);
$request->bindParam(":prenom", $prenomUser);
$request->bindParam(":id", $_SESSION['user']['id']);
$request->execute();
$request->closeCursor();

$_SESSION['user']['nom'] = $nomUser;
$_SESSION['user']['prenom'] = $prenomUser;

if(!empty($_FILES["photo"])){
    $infos = $_FILES["photo"];
    $nom = $_SESSION['user']['email_id'].".png";
    $type = $infos['type'];
    $taille = $infos['size'];
    $fichier_temporaire = $infos['tmp_name'];
    $code_error = $infos['error'];
    switch ($code_error) {

        case UPLOAD_ERR_OK :
            //Fichier bien reçu      Déterminer sa destination finale 
            $destination = dirname(__DIR__).DIRECTORY_SEPARATOR."profileImage".DIRECTORY_SEPARATOR . $nom;
            //copier le fichier temporaire 
            if(copy($fichier_temporaire,$destination)){
                $request = $db->prepare("UPDATE users SET profile_image = :profile_image WHERE id=:id ");
                $request->bindParam(':profile_image',$nom);
                $request->bindParam(':id',$_SESSION['user']['id']);
                $request->execute();
                $request->closeCursor();
                $_SESSION['user']['profile_image'] = $nom;
            }
        break;
        default :
    }
}
header("location:../");