<?php
session_start();
if(empty($_SESSION['user']))
    header('Location:../connexion'); 
$active2 = "active";
$titre = "A propos de nous";
require_once '../include/header.php';
?>
<section id="presentation">
    <h1>Qui sommes-nous?</h1>
    <p><em>Ici vous avez les meilleurs vendeurs et aussi les produits de qualité.La qualité vaut mieux que la quantité.Explorez la qualité!</em></p>
</section>
<section id="a-propos">
    <div class="partie">
        <h2>Nous sommes une entreprise</h2>
        <div>
            <p>Nous avons créer cet espace afin de donner une bonne visibilité aux vendeurs</p>
            <p>Cet espace permet aussi aux utlisateur de vite retrouver des produits dont ils ont besoin</p>
        </div>
    </div>
    <div class="partie">
        <h2>Nous sommes une entreprise</h2>
        <div>
            <p>Nous avons créer cet espace afin de donner une bonne visibilité aux vendeurs</p>
            <p>Cet espace permet aussi aux utlisateur de vite retrouver des produits dont ils ont besoin</p>
        </div>
    </div>
    <div class="partie">
        <h2>Nous sommes une entreprise</h2>
        <div>
            <p>Nous avons créer cet espace afin de donner une bonne visibilité aux vendeurs</p>
            <p>Cet espace permet aussi aux utlisateur de vite retrouver des produits dont ils ont besoin</p>
        </div>
    </div>
    <div class="partie">
        <h2>Nous sommes une entreprise</h2>
        <div>
            <p>Nous avons créer cet espace afin de donner une bonne visibilité aux vendeurs</p>
            <p>Cet espace permet aussi aux utlisateur de vite retrouver des produits dont ils ont besoin</p>
        </div>
    </div>
</section>
<footer>
    Tout droits réservés
</footer>
</body>
</html>