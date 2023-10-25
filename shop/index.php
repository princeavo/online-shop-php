<?php
session_start();
if(empty($_SESSION['user']))
    header('Location:../connexion'); 
$active3 = "active";
$titre = "Votre boutique";
require_once '../include/header.php';
?>
<section id="presentation">
    <h1>Voici votre boutique</h1>
    <p><em>Vous pouvez mettre à jour votre boutique ici(ajouter vos nouveaux produits).La qualité vaut mieux que la quantité.Explorez la qualité!</em></p>
</section>
<section id="global">
    <div id="produits">
    <?php 
        require_once "../include/dbConnexion.php";
        if(is_null($db)){?>
            <div id="pas-produit">
                Erreur lors de la récupéraion des données.Veuillez réessayer.<a href="./add.php">Ajouter des produits</a>
            </div>
        <?php  }else{
            $stmt = $db->prepare("SELECT * FROM produit WHERE userId = :id");
            $stmt->bindParam(':id',$_SESSION['user']['id']);
            $stmt->execute();
            $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            if(!empty($produits)){ ?>
                <!-- <form action="" method="POST">
                    <input type="search" placeholder="Rechercher ici" name="recherche">
                    <input type="submit" value="Rechercher">
                </form> -->
                <?php foreach ($produits as  $produit) { ?>
                    <div class="produit">
                        <img alt="" src="../images/<?php echo $produit['image']; ?>">
                        <h3><?php echo $produit['nom']; ?></h3>
                        <p><?php echo $produit['prix']; ?>£</p>
                        <div>
                            <a href="./update.php?produit=<?php echo $produit['token']; ?>">Mettre à jour les informations</a>
                        </div>
                    </div>
                <?php }
            }else{ ?>
                <div id="pas-produit">
                    Vous n'avez aucun produit.
                </div>
            <?php }
        }
    ?>

<a href="./add.php" id="add-produit">Ajouter de produit</a>
    </div>
</section>
<footer>
    Tout droits réservés
</footer>
</body>
</html>

        <?php die(); ?>

    <div class="produit">
        <img alt="" src="./images/image1.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            <a href="./update.php">Mettre à jour les informations</a>
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image2.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            <a href="">Ajouter au panier</a>
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image3.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            <a href="">Ajouter au panier</a>
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image4.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            <a href="">Ajouter au panier</a>
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image1.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            <a href="">Ajouter au panier</a>
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image2.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            <a href="">Ajouter au panier</a>
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image3.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            <a href="">Ajouter au panier</a>
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image4.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            <a href="">Ajouter au panier</a>
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image1.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            Ajouter au panier
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image1.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            Ajouter au panier
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image1.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            Ajouter au panier
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image1.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            Ajouter au panier
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image1.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            Ajouter au panier
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image1.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            Ajouter au panier
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image1.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            Ajouter au panier
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image1.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            Ajouter au panier
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image1.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            Ajouter au panier
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image1.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            Ajouter au panier
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image1.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            Ajouter au panier
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image1.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            Ajouter au panier
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image1.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            Ajouter au panier
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image1.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            Ajouter au panier
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image1.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            Ajouter au panier
        </div>
    </div>
</section>
<footer>
    Tout droits réservés
</footer>
</body>
</html>