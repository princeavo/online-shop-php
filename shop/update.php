<?php
session_start();
if(empty($_SESSION['user']))
    header('Location:../connexion'); 
$active3 = "active";
$titre = "Mise à jour de produit";
if(empty($_GET) && empty($_SESSION['produit']))
    header("location:./");
require_once '../include/dbConnexion.php';
$stmt = $db->prepare("SELECT * FROM produit WHERE token = :token");
$token = htmlspecialchars($_GET['produit']??"oui");
$stmt->bindParam(':token',$token);
$stmt->execute();
$produit = $stmt->fetch(PDO::FETCH_ASSOC);


if(!$produit){
    $stmt->closeCursor();
    header('location:./');
}else{
    $stmt->closeCursor();
    if($produit['userId'] != $_SESSION['user']['id']){
        header("location:../fraude.php");
    }
}

if($produit){
    $stmt->closeCursor();
}else{
    $stmt->closeCursor();
    // if(empty($_SESSION['produit']))
        header('location:./');
}
require_once '../include/header.php';
?>
<section id="presentation">
    <h1>Mettez à jour votre produit</h1>
    <p><em>Vous pouvez mettre à jour votre produit.Montrez davantage son intérêt</em></p>
</section>
<section id="update">
    <?php 
        if(isset($_SESSION['produit']['error'])){
            ?>
                <div style="width: 100%; font-size:25px;color:firebrick;text-align:center">
                    <?php echo $_SESSION['produit']['error']; unset($_SESSION['produit']['error']); ?>
                </div>
            <?php
        }
        if(isset($_SESSION['produit']['sucess'])){
            ?>
                <div style="width: 100%; font-size:25px;color:lime;text-align:center">
                    <?php echo $_SESSION['produit']['sucess']; unset($_SESSION['produit']['sucess']); ?>
                </div>
            <?php
        }
    ?>
    <form action="./traitement.php?produit=<?=$token?>" method="POST" enctype = "multipart/form-data">
        <div class="group">
            <label for="nom">Nom du produit</label>
            <input type="text" name="nom_produit" id="nom" value="<?php echo @$produit['nom']?>">
        </div>
        <div class="group" >
            <label for="prix">Prix du produit</label>
            <input type="number" name="prix_produit" id="prix"  value="<?php echo @$produit['prix']?>">
        </div>
        <div class="group">
            <label for="desc">Décrivez ici votre produit</label>
            <textarea rows="10" cols="50" name="description_produit" id="desc"  ><?php echo @$produit['description']?></textarea>
        </div>
        <div class="group">
            <label for="img">Changer l'image</label>
            <input type="file" accept="image/*" name="image_produit" id="img">
        </div>
        <div class="group submit">
            <input type="submit" name="modifier" value="modifier">
        </div>
    </form>
    <a href="./">Annuler</a>
</section>