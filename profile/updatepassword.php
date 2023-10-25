<?php
session_start();
if(empty($_SESSION['user']))
    header('Location:../connexion');
$titre = "Modifier mon mot de passe";
require_once '../include/headerLogin.php';
?>

<?php 
    if(isset($_POST['cancel'])){
        header("location:..");
    }elseif(isset($_POST['value'])){
        if(!empty($_POST['password']) && !empty($_POST['newPassword']) && !empty($_POST['confirmPassword'])){
            if(htmlspecialchars($_POST['newPassword']) == htmlspecialchars($_POST['confirmPassword'])){
                if(password_verify(htmlspecialchars($_POST['password']),$_SESSION['user']['password'])){
                    $_SESSION['user']['password'] = password_hash(htmlspecialchars($_POST['newPassword']),PASSWORD_DEFAULT);
                    $sucess = "Mot de passe modifié avec succès";
                }else{
                    $error = "Le mot de passe est incorrect";
                }
            }else{
                $error = "Les mots de passe ne corrrespondent pas";
            }
        }else{
            $error = "Veuillez renseigner tous les champs!";
        }
    }
?>


<form method='POST' action='' class="infos" >
    <h3 class="error"><?php if(isset($error)) echo $error;?><h3>
    <h3 class="success"><?php if(isset($sucess)) echo $sucess;?><h3>
    <h3>Modification de mot de passe</h3>
    <label for="password">Votre mot de passe actuel</label>
    <input type='password' name='password'  id="password" >
    <label for="newPassword">Nouveau mot de passe</label>
    <input type='password' name='newPassword'  id="newPassword" >
    <label for="confirmPassword">Confimer le nouveau mot de passe</label>
    <input type='password' name='confirmPassword'  id="confirmPassword" >
    <div style="width:100%;display:flex;justify-content:space-between">
        <button  style="width:45%" type='submit' value='value' name="value">Modifier</button>
        <button style="width:45%" type="submit" name="cancel">Annuler</button>
    </div>
</form>
<?php   require_once '../include/footer.php'   ?>