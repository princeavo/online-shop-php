<?php   require_once '../include/headerLogin.php'   ?>
        <!-- <h1 class="titre">Vos informations personelles</h1> -->
        <!-- <form method='POST' action='modifier_infos.php' class="infos" enctype = "multipart/form-data" >
            <div class="line">
                <label for="nom">Nom</label>
                <input type='text' name='nom' value="<?=$_SESSION['user']['nom']?>" id="nom">
            </div>
            <div class="line">
                <label for="prenom">Prenom</label>
                <input type='text' name='prenom' value="<?=$_SESSION['user']['prenom']?>" id="prenom">
            </div>
            <div class="line">
                <label for="email">Email</label>
                <input type='email' name='email' value="<?=$_SESSION['user']['email']?>" id="email">
            </div>
            <div class="line">
                <label for="photo">Photo</label>
                <input type='file' name='photo' id="photo" accept="image/*" >
            </div>
            <div class="center">
                <button><a href="./">Annuler</a></button>
                <button type='submit' value='value'>Modifier</button>
            </div>
        </form> -->
        <form method='POST' action='modifier_infos.php' class="infos" enctype = "multipart/form-data">
            <h3 class="error"><?php if(isset($error)) echo $error;?><h3>
            <h3 class="success"><?php if(isset($sucess)) echo $sucess;?><h3>
            <h3>Vos informations personelles</h3>
            <label for="username">Nom</label>
            <input type='text' name='nom' value="<?=$_SESSION['user']['nom']?>" id="nom">
            <label for="username">Prenom</label>
            <input type='text' name='prenom' value="<?=$_SESSION['user']['prenom']?>" id="prenom">

                <label for="photo">Photo</label>
                <input type='file' name='photo' id="photo" accept="image/*" style="background-color:rgba(0,0,0,0.04)" >
            <a href="updatepassword.php" style="text-decoration:none;font-size:20px;color:blueviolet">Changer son mot de passe</a>
            <div style="width:100%;display:flex;justify-content:space-between">
                <button style="width:45%" type="submit" name="cancel">Annuler</button>
                <button  style="width:45%" type='submit' value='value' name="value">Modifier</button>
            </div>
                

        </form>
<?php   require_once '../include/footer.php'   ?>