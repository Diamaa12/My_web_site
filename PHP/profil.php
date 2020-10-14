<?php

session_start();
include_once 'function/function.php';
include_once 'function/compteur.php';
$bdd = bdd();?>
<!DOCTYPE html>
<html>
  <body>
    <div id="conteneur">
  <?php include_once '../HTML/header-page.html'?>
    <link rel="stylesheet" href="https://bombilafou.com/CSS/profils.css"/>
    <link rel="stylesheet" href="https://bombilafou.com/CSS/footer_page.css"/>
    <link rel="stylesheet" href="https://bombilafou.com/CSS/header_page.css"/>

<?php
if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM Membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
   
   $requser2 = $bdd->prepare('SELECT * FROM Profils WHERE membres_id = ?');
   $requser2->execute(array($getid));
   $userinfo2 = $requser2->fetch();
?>

      <div align="center">
         <h2 class="titre2">Bonjour  <?php echo $userinfo['Pseudo']; ?> Vous êtes ici Acceuil / Profil</h2>
         <br /><br />
         <?php if(!empty($userinfo2['Avatars']))
         {
             ?>
         <img src="Avatar/<?php echo $userinfo2['Avatars']?> " width="100"/>
         <?php
         }?>
         <br /><br />
         Votre pseudo est: <?php echo $userinfo['Pseudo']; ?>
         <br />
        Votre e-mail est: <?php echo $userinfo['Mail']; ?>
         <br />
         <?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
         ?>
         <br />
         <a href="edit_profil.php">Editer mon profil,  </a>
         <a href="../index.php"> Page d'acceuil,  </a>
         <a href="deconnexion.php">  Se déconnecter</a>
         <?php
         }
         ?>
      </div>
      <?php   include_once '../HTML/footer_page.html';?>
      </div>
   </body>
</html>
<?php   

}
