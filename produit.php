<?php
session_start();
if(empty($_SESSION['user']))
    header('Location:./connexion');
if(empty($_GET['produit']) || count($_GET)!=1)
    header('Location:./');

$image=htmlspecialchars($_GET['produit']) .".png";
//Je vais vérifier si l'id correspond à un id de notre base de données
require_once './include/dbConnexion.php';
$stmt = $db->prepare("SELECT * FROM produit WHERE image = :image");
$stmt->bindParam(':image',$image);
$stmt->execute();
$produit = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt->closeCursor();

if(!$produit)
    header('Location:./');
if(isset($_POST['commenter']) && !empty($_POST["comment"])){
    $stmt = $db->prepare("INSERT INTO commentaires (idProduit,idUser,contenu,date) VALUES (:idProduit,:idUer,:contenu,NOW()) ");
    $stmt->bindParam(':idProduit',$_GET['produit']);
    $stmt->bindParam(':contenu',$_POST["comment"]);
    $stmt->bindParam(':idUer',$_SESSION['user']['id']);
    $stmt->execute();
    $stmt->closeCursor();
}


$active1 = "active";
$titre = "Home";
require_once './include/header.php';
?>
<section id="presentation">
    Catégorie : <?=$produit['categorie']?>
    <h1><?=$produit['nom']?></h1>
    <?php 
        $stmt = $db->prepare(" SELECT nom,prenom FROM users WHERE id = :id");
        $stmt->bindParam(':id',$produit['userId']);
        $stmt->execute();
        $poster = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    ?>
    <p><em>Par <a href="" title="Contacter le vendeur"><?= $poster['nom']." ".$poster['prenom']?></a> le <?=$produit['dateDeModification']?></em></p>
</section>
<section id="container">
    <div id="left">
        <img src="./images/<?=$produit['image']?>" alt="">
    </div>
    <div id="right">
        <?=$produit['description']?>
        <a href="">Ajouter au panier</a>
        <span><b>Seulement à <?=$produit['prix']?>£</b></span>
    </div>
</section>
<h2 id="titreCommentaires">Les commentaires relatifs à ce produit</h2>
<section id="commentaires">
<?php
        $stmt = $db->prepare("SELECT users.nom,users.prenom,commentaires.contenu,commentaires.date FROM users  INNER JOIN commentaires ON users.id = commentaires.idUser WHERE commentaires.idProduit = :produit");
        $stmt->bindParam(":produit",$_GET["produit"]);
        $stmt->execute();
        $commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        if($commentaires){
            foreach($commentaires as $com){ ?>
                <div class="commentaire">
                    <div>Avis de <?php echo $com['nom']." ".$com['prenom']; ?></div>
                    <p><?php echo $com['contenu']; ?></p>
                    <span>Publié le <?php echo $com['date']; ?></span>
                </div>
            <?php }
        }else{ ?>
            <div id="pasDeCommentaire">
                Aucun commentaire.Soyez le premier à commenter!
            </div>
        <?php } ?>
</section>
<section id="comment">
    <form action="" method="POST">
        <input type="text" name="comment" placeholder="Ajouter un commentaire" required>
        <input type="submit" name="commenter" value="Commenter">
    </form>
</section>