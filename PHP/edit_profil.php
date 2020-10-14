<?php
session_start();
include_once 'function/function.php';
$bdd = bdd();?>
<!DOCTYPE html>
<html>
  <body>
    <div id="conteneur">
     <?php include_once '../HTML/header-page.html';?>
    <link rel="stylesheet" href="../CSS/footer_page.css"/>
    <link rel="stylesheet" href="../CSS/header_page.css"/>
      <link rel="stylesheet" href="../CSS/edit_profil.css"> 
<?php
if(isset($_SESSION['id'])) {
   
   $requser = $bdd->prepare("SELECT * FROM Membres WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
   if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['Pseudo']) {
      $newpseudo = htmlspecialchars($_POST['newpseudo']);
     
      $insertpseudo = $bdd->prepare("UPDATE Membres SET Pseudo = ? WHERE id = ?");
      $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['Mail']) {
      $newmail = htmlspecialchars($_POST['newmail']);
    
      $insertmail = $bdd->prepare("UPDATE Membres SET Mail = ? WHERE id = ?");
      $insertmail->execute(array($newmail, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
      $mdp1 = htmlspecialchars($_POST['newmdp1']);
      $mdp2 = htmlspecialchars($_POST['newmdp2']);
      if($mdp1 == $mdp2) {
          $mdp1 = password_hash($mdp1, PASSWORD_BCRYPT);
         $insertmdp = $bdd->prepare("UPDATE Membres SET Password = ? WHERE id = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['id']));
         header('Location: profil.php?id='.$_SESSION['id']);
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }
   //Traitement d'VATAR
  
   if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
   $tailleMax = 2097152;
   $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
   if($_FILES['avatar']['size'] <= $tailleMax) {
      $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
      if(in_array($extensionUpload, $extensionsValides)) {
          $tmp_name = $_FILES['avatar']['tmp_name'];
       
         $chemin = 'Avatar/'.$_SESSION['id'].'.'.$extensionUpload;
         $resultat = move_uploaded_file($tmp_name, $chemin);
         if($resultat) {
            $updateavatar = $bdd->prepare('INSERT INTO Profils(membres_id, Avatars) VALUES(:id,:avatar)');
            $updateavatar->execute(array(
                'id' => $_SESSION['id'],
               'avatar' => $_SESSION['id'].".".$extensionUpload
               ));
            header('Location: profil.php?id='.$_SESSION['id']);
         } else {
             echo '<br>'.$_FILES['avatar']['error'];
            $msg = "Erreur durant l'importation de votre photo de profil";
         }
      } else {
         $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
      }
   } else {
      $msg = "Votre photo de profil ne doit pas dépasser 2Mo";
   }
}
   
?>
  
   
      <div align="center">
         <h2>Editer votre profil</h2>
         <div align="center" class="grDiv">
             <form method="POST" action="edit_profil.php" enctype="multipart/form-data">
            <table>
               <tr>
                  <td align="right">
                     <label for="newpseudo">Pseudo :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre pseudo" id="pseudo" name="newpseudo" value="<?php echo $user['Pseudo'];  ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="newmail">Mail :</label>
                  </td>
                  <td>
                      <input type="email" placeholder="Votre mail" id="mail" name="newmail" value="<?php echo $user['Mail']; ?>" />
                  </td>
               </tr>
               <tr>
             
               <tr>
                  <td align="right">
                     <label for="newmdp1">Mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Votre mot de passe" id="mdp" name="newmdp1" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="newmdp2">Confirmation du mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="newmdp2" />
                  </td>
               </tr>
                 <tr>
                  <td align="right">
                      <label for="avatar">Ajouter un avatar:</label>
                  </td>
                 <td>
                     <input type="file" name="avatar" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                      <label></label>
                  </td>
                  <td>
                     <input type="submit" value="Mettre à jour le profil" />
                  </td>
               </tr>
            </table>
         </form>
            <?php if(isset($msg)) { echo '<font color="red">'.$msg.'</font>'; } ?>
         </div>
      </div>
      <?php include_once '../HTML/footer_page.html';?>
      </div>
   </body>
</html>
<?php   
}
else {
   header("Location: connexion1.php");
}


