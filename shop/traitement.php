<?php 
session_start();
if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    if(isset($_POST['Ajouter'])){
        if(!empty($_POST['nom_produit']) && !empty($_POST['prix_produit']) && !empty($_POST['description_produit'])&& !empty($_POST['categorie'])&& !empty($_POST['marque_produit'])&& !empty($_POST['nombre_produit'])){
            require_once '../include/dbConnexion.php';
            require_once './copy.php';
            if(empty($_SESSION['produit']['error'])){
                $stmt = $db->prepare("INSERT INTO `produit` (`id`,userId, `token`, `nom`, `prix`, `description`, `image`,`categorie`,`marque`,`nombre`,`dateDeModification`) VALUES (NULL,:userId,:token,:nom,:prix,:description,:image,:categorie,:marque,:nombre,NOW())");
                $nom_produit = htmlspecialchars($_POST['nom_produit']);
                $prix_produit = htmlspecialchars($_POST['prix_produit']);
                $description_produit = htmlspecialchars($_POST['description_produit']);
                $categorie = htmlspecialchars($_POST['categorie']);
                $marque = htmlspecialchars($_POST['marque_produit']);
                $nombre = (int)htmlspecialchars($_POST['nombre_produit']);
                $stmt->bindParam(':nom',$nom_produit);
                $stmt->bindParam(':prix',$prix_produit);
                $stmt->bindParam(':description',$description_produit);
                $stmt->bindParam(':categorie',$categorie);
                $stmt->bindParam(':marque',$marque);
                $stmt->bindParam(':nombre',$nombre);
                $stmt->bindParam(':image',$nom);
                $stmt->bindParam(':token',$token);
                $stmt->bindParam(':userId',$_SESSION['user']['id']);
                $stmt->execute();
                $stmt->closeCursor();
                $_SESSION['produit']['sucess'] = "Opération réussie";
            }
            
            // else{
            //     $_SESSION['produit']['error'] = "Une erreur est survenue de notre coté.Veuillez réessayer!";
            // }
            
            header('location:./add.php');
        }else{
            $_SESSION['produit']['error'] = "Veuillez remplir tous les champs puis réessayer";
            header('location:./add.php');
        }
    }elseif(isset($_POST['modifier'])){
        if(!empty($_POST['nom_produit']) && !empty($_POST['prix_produit']) && !empty($_POST['description_produit'])){
            $token = htmlspecialchars($_GET['produit']);
            if(empty($token)){
                header("Location:./");
            }else{
                require_once './copy.php';
                if(@$_SESSION['produit']['error'] === 'Pas de fichier saisi'){
                    unset($_SESSION['produit']['error']);
                }
                $stmt = $db->prepare("UPDATE produit SET nom = :nom,prix = :prix,description=:description WHERE token = :token");
                $nom_produit = htmlspecialchars($_POST['nom_produit']);
                $prix_produit = htmlspecialchars($_POST['prix_produit']);
                $description_produit = htmlspecialchars($_POST['description_produit']);
                $stmt->bindParam(':nom',$nom_produit);
                $stmt->bindParam(':prix',$prix_produit);
                $stmt->bindParam(':description',$description_produit);
                $stmt->bindParam(':token',$token);
                try{
                    $stmt->execute();
                }catch(Exception $e){
                    $_SESSION['produit']['error'] = "Une erreur s'est produite de notre côté.Veuillez réessayer!";
                }
                
                @$stmt->closeCursor();
                $_SESSION['produit']['sucess'] = "Opération réussie";
                header("location:./update.php");
            }
        }else{
            $_SESSION['produit']['error'] = "Veuillez remplir tous les champs puis réessayer";
            header('location:./update.php');
        }
    }
}