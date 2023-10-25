<?php
session_start();
if(empty($_SESSION['user']))
    header('Location:../connexion'); 
$active3 = "active";
$titre = "Ajouter un produit";
require_once '../include/header.php';
?>
<section id="presentation">
    <h1>Ajouter un produit</h1>
    <p><em>Vous pouvez ajouter des produits à votre boutique.Mettez à jour votre boutique</em></p>
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
    <form action="./traitement.php" method="POST" enctype = "multipart/form-data">
        <div class="group">
            <label for="nom">Nom du produit</label>
            <input type="text" name="nom_produit" id="nom">
        </div>
        <div class="group" >
            <label for="prix">Prix du produit</label>
            <input type="number" name="prix_produit" id="prix">
        </div>
        <div class="group">
            <label for="desc">Décrivez ici votre produit</label>
            <textarea rows="10" cols="50" name="description_produit" id="desc"></textarea>
        </div>
        <div class="group">
            <label for="img">Ajouter une image</label>
            <input type="file" accept="image/*" name="image_produit" id="img" required>
        </div>
        <?php 
            require_once '../include/categorie.php';
        ?>
        <div class="group">
            <label for="img">Sélectionnez une catégorie</label>
                <select name="categorie">
                <?php foreach($categories as $option){ ?>
                    <option value="<?php echo $option; ?>"><?php echo $option;?></option>
                <?php } ?>
                </select>
        </div>
        <div class="group" >
            <label for="marque">Marque du produit</label>
            <input type="text" name="marque_produit" id="marque">
        </div>
        <div class="group" >
            <label for="nombre">Quantité du produit disponible</label>
            <input type="number" name="nombre_produit" id="nombre">
        </div>
        <div class="group submit">
            <input type="submit" name="Ajouter" value="Ajouter">
        </div>
    </form>
    <a href="./">Annuler</a>
</section>