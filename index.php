<?php
session_start();
if(empty($_SESSION['user']))
    header('Location:./connexion'); 

if(isset($_POST["rechercher"]) && $_POST["rechercher"] === "Rechercher"){
    if(true){
        $categorie = (htmlspecialchars($_POST["categorie"]) === "all") ? "" : htmlspecialchars($_POST["categorie"]);
        require_once './include/dbConnexion.php';
        $stmt = $db->prepare("SELECT * FROM produit WHERE nom LIKE :nom ". ((!empty($categorie)) ? "  AND categorie = :categorie" : ""));
        $nom = "%".htmlspecialchars($_POST['recherche'])."%";
        $stmt->bindParam(':nom',$nom);
        if(!empty($categorie)){
            $stmt->bindParam(':categorie',$categorie);
        }
        $stmt->execute();
        $resultatsRecherche = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $messageSiPasDeProduit = "Aucun produit ne correspond à votre recherche.";
    }
}

$active1 = "active";
$titre = "Home";
require_once './include/header.php';
?>

<section id="presentation">
    <h1>Cherchez votre produit ici</h1>
    <p><em>Ici vous avez les meilleurs vendeurs et aussi les produits de qualité.La qualité vaut mieux que la quantité.Explorez la qualité!</em></p>
</section>
<?php 
    if(!isset($resultatsRecherche)){
        require_once './include/dbConnexion.php';
        $stmt = $db->prepare("SELECT * FROM produit ");
        $stmt->execute();
        $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $messageSiPasDeProduit = "Il n'y a aucun produit à consulter.Veuillez completer votre boutique!";
    }else{
    $produits = $resultatsRecherche;
    }
    echo "<section id='produits'>";
    if(isset($resultatsRecherche) || !empty($produits)):
        require_once './include/categorie.php';
    ?>
        <form action='' method = 'POST'>
            <select name='categorie'>
                <option value="all">Toutes</option>
                    <?php foreach($categories as $option): ?> 
                        <option value="<?=$option?>" <?php if(isset($categorie) && $categorie == $option) echo "selected"; ?> ><?= $option ?></option>
                    <?php endforeach ;?>
            </select>
            <input type='search' placeholder='Entre le nom ou marque' name='recherche' value="<?php if(isset($_POST['recherche'])) echo htmlspecialchars($_POST['recherche']); ?>" >
            <input type='submit' value='Rechercher' name="rechercher">
        </form>
    <?php
    endif;
    if(!$produits){ ?>
        <section id="neant">
            <p><?=@$messageSiPasDeProduit?></p>
        </section>
    <?php

    }else{ 
        foreach ($produits as  $produit) { ?>
            <div class="produit">
                <a id='lien' href="./produit.php?produit=<?php echo substr($produit['image'], 0,-4)?>"><img alt="" src="./images/<?php echo $produit['image'];?>"></a>
                <h3><?php echo $produit['nom'];?></h3>
                <p><?php echo $produit['prix'];  ?>£</p>
                <div>
                    <a href="./panier">Ajouter au panier</a>
                </div>
            </div>
        <?php
        }
        echo "</section>
            <footer>
                Tout droits réservés
            </footer>
            </body>
            </html>";
    }
    die();
?>


<section id="produits">
    <form action="" method="POST">
        <input type="search" placeholder="Rechercher ici" name="recherche">
        <input type="submit" value="Rechercher">
    </form>
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
        <img alt="" src="./images/image2.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            Ajouter au panier
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image2.jpg">
        <h3>Nom du produit</h3>
        <p>$40.00 - $80.00</p>
        <div>
            Ajouter au panier
        </div>
    </div>
    <div class="produit">
        <img alt="" src="./images/image2.jpg">
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