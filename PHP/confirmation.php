<?php
session_start();
include_once 'function/function.php';
$bdd = bdd();


if(isset($_GET['pseudo'], $_GET['key']) AND !empty($_GET['pseudo']) AND !empty($_GET['key'])) {
   $pseudo = htmlspecialchars(urldecode($_GET['pseudo']));
   $key = htmlspecialchars($_GET['key']);
   $requser = $bdd->prepare("SELECT * FROM Membres WHERE Pseudo = ? AND confirme_key = ?");
   $requser->execute(array($pseudo, $key));
   $userexist = $requser->rowCount();
   if($userexist == 1) {
      $user = $requser->fetch();
      $_SESSION['Pseudo'] = $user['Pseudo'];
      if($user['confirme_user'] == 0) {
         $updateuser = $bdd->prepare("UPDATE Membres SET confirme_user = 1 WHERE Pseudo = ? AND confirme_key = ?");
         $updateuser->execute(array($pseudo,$key));
       	  include_once 'connexion1.php';
      } else {
        header('Location: https://www.bombilafou.com/PHP/connexion1.php');
      }
   } else {
      echo "L'utilisateur n'existe pas !";
   }
}