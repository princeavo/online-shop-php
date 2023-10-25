<?php if(session_status() === PHP_SESSION_NONE )  session_start();?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title><?=@$titre?></title>
        <link rel="stylesheet" href="/tasks/style.css">
    </head>
    <body>
        <header>
            <div>
                <h1>Site web</h1>
                <nav>
                    <ul>
                        <li class="<?=$active1??''?>"><a href="/tasks/" title="Acceuil">Home</a></li>
                        <li class="<?=$active2??''?>"><a href="/tasks/about" title="A propos de nous">About</a></li>
                        <li class="<?=$active3??''?>"><a href="/tasks/shop" title="Vos produits sont ici">Shop</a></li>
                    </ul>
                </nav>
            </div>
            <div>
                <div id="panier-bloc">
                    <h3><a href="/tasks/panier">Panier</a></h3><span>0</span>
                </div>
                <div>
                    <a href="/tasks/profile"><img alt="" src="/tasks/profileImage/<?=@$_SESSION['user']['profile_image']?>" title="Editer votre profil"></a>
                    <a href="/tasks/deconnexion/">Logout</a>
                </div>
            </div>
        </header>
        