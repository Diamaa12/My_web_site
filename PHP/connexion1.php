<?php
session_start();

include_once 'function/function.php';
include_once 'function/compteur.php';
$bdd = bdd();
if(isset($_POST['formconnexion'])) {
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = htmlspecialchars($_POST['mdpconnect']);
   if(!empty($mailconnect) AND !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM Membres WHERE Pseudo = ?");
      $requser->execute(array($mailconnect));
      
      $userexist = $requser->rowCount();

      if($userexist == 1) {
         $userinfo = $requser->fetch();
         
         if(password_verify($mdpconnect, $userinfo['Password'])){
                    $_SESSION['id'] = $userinfo['id'];
         			$_SESSION['Pseudo'] = $userinfo['Pseudo'];
      				header("Location: https://bombilafou.com/PHP/profil.php?id=".$_SESSION['id']);
         }
        else {
             $erreur = 'Les mots de passe ne correspond pas!';
        }

      } else {
         $erreur = "Utilisateur non enregistrè  !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
<html>
    
  <body>
    <div id="conteneur">
     <?php include_once '../HTML/header-page.html';?>
    <link rel="stylesheet" href="../CSS/connexion.css">
    <link href="https://fonts.googleapis.com/css?family=Acme|Karla&display=swap" rel="stylesheet"> 
   
       <div class="madiv1" align="center">
           
        
         <form  name="formulaire" method="POST" action="connexion1.php" onsubmit="return valider()" id="formulaire">
             <h2 class="connexion">Connexion</h2>
            <label for="psd">Pseudo:</label>    <input type="text" name="mailconnect" placeholder="Pseudo" id="psd"/><br/>
            <label for="pwd">Mot de passe:</label><input type="password" name="mdpconnect" placeholder="Mot de passe" id="pwd" />
            <br /><br />
            <input class="soumet" type="submit" name="formconnexion" value="Se connecter !" /><br/>
             <span id="small"></span>
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
         <a href="https://bombilafou.com/PHP/recup_passwd.php">Mot de passe oublié ?</a>
      </div>
          
        <?php include_once '../HTML/footer_page.html';?>
        
      </div>
     <script  src="../Javascript/inscrit.js" type="text/javascript" async></script>
   </body>
 
</html>