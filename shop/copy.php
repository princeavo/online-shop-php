<?php 
    $infos = $_FILES["image_produit"];
    require_once '../include/dbConnexion.php';
    if(empty($token)){
        $token = bin2hex(random_bytes(32));
        while (true) {
            $stmt=$db->prepare("SELECT * FROM produit WHERE token = :token");
            $stmt->bindParam(':token',$token);
            $stmt->execute();
            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            if(empty($resultat))
                break;
        }
    }    

    $nom = $token.".png";

    $fichier_temporaire = $infos['tmp_name'];
    $code_error = $infos['error'];
    switch ($code_error) {

        case UPLOAD_ERR_OK :

            //Fichier bien reçu
            //Déterminer sa destination finale 
            $destination = dirname(__DIR__).DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR . $nom;
            //copier le fichier temporaire 
            if(copy($fichier_temporaire,$destination)){
                $nom = htmlspecialchars($nom);
                $token = htmlspecialchars($token);
            }else{
                //Problème de copie => mettre un message d'erreur 
                $_SESSION['produit']['error'] = "Problème de copie sur le serveur";
            }
            break;

        case UPLOAD_ERR_NO_FILE :

        //Pas de fichier saisi 
        $_SESSION['produit']['error'] = 'Pas de fichier saisi';
        break;

        case UPLOAD_ERR_INI_SIZE :

        //Taille fichier > upload_max_filesize
        $_SESSION['produit']['error'] = "Fichier $nom non transféré ";
        $_SESSION['produit']['error'].='Taille > upload_max_filesize';
        break;

        case UPLOAD_ERR_FORM_SIZE :

        //Taille fichier > MAX_FILE_SIZE
        $_SESSION['produit']['error'] = "Fichier $nom non transféré ";
        $_SESSION['produit']['error'].='Taille > MAX_FILE_SIZE';
        break;


        case UPLOAD_ERR_PARTIAL :

        // fichier partiellement transféré
        $_SESSION['produit']['error'] = "Fichier $nom non transféré ";
        $_SESSION['produit']['error'].='problème lors du transfert';
        break;

        case UPLOAD_ERR_NO_TMP_DIR :

        //Pas de répertoire temporaire
        $_SESSION['produit']['error'] = "Fichier $nom non transféré ";
        $_SESSION['produit']['error'].='pas de répertoire temporaire';
        break;

        case UPLOAD_ERR_CANT_WRITE :

        // erreur de l'écriture sur disque
        $_SESSION['produit']['error'] = "Fichier $nom non transféré ";
        $_SESSION['produit']['error'].='erreur de l\'écriture sur disque';
        break;

        case UPLOAD_ERR_EXTENSION :

        // transfert stoppé par l'extension
        $_SESSION['produit']['error'] = "Fichier $nom non transféré ";
        $_SESSION['produit']['error'].="transfert stoppé par l'extension";
        break;

        default :
        $_SESSION['produit']['error'] = "Fichier non trasféré";
    }