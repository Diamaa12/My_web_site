<?php
ob_start();//permet à la function header de rediriger les pages web sans souci
session_start();
require_once 'function/function.php';
?>

<html>
  <body>
    <div id="conteneur">
    <link rel="stylesheet" href="https://bombilafou.com/CSS/recup_passwd.css"/>    
<?php

include_once '../HTML/header-page.html';
$bdd = bdd();

if(isset($_GET['section'])){
    $section = htmlspecialchars($_GET['section']);
}
 else {
     $section = '';
}

if(isset($_POST['recup_submit'],$_POST['recup_mail'])) {
   if(!empty($_POST['recup_mail'])) {
      $recup_mail = htmlspecialchars($_POST['recup_mail']);
      if(filter_var($recup_mail,FILTER_VALIDATE_EMAIL)) {
         $mailexist = $bdd->prepare('SELECT id, Pseudo FROM Membres WHERE Mail = ?');
         $mailexist->execute(array($recup_mail));
         $mailexist_count = $mailexist->rowCount();
         if($mailexist_count == 1) {
            $pseudo = $mailexist->fetch();
            $pseudo = $pseudo['Pseudo'];
            
            $_SESSION['recup_mail'] = $recup_mail;
            $recup_code = "";
            for($i=0; $i < 8; $i++) { 
               $recup_code .= mt_rand(0,9);
            }
            $mail_recup_exist = $bdd->prepare('SELECT id FROM recup_passwd WHERE mail = ?');
            $mail_recup_exist->execute(array($_SESSION['recup_mail']));
            $mail_recup_exist = $mail_recup_exist->rowCount();
            if($mail_recup_exist == 1) {
               $recup_insert = $bdd->prepare('UPDATE recup_passwd SET code = ? WHERE mail = ?');
               $recup_insert->execute(array($recup_code,$_SESSION['recup_mail']));
            } else {
               $recup_insert = $bdd->prepare('INSERT INTO recup_passwd(mail,code, confirme) VALUES (?, ?, 0)');
               $recup_insert->execute(array($_SESSION['recup_mail'],$recup_code));
            }
            $header="MIME-Version: 1.0\r\n";
         $header.='From:"bombilafou.com"<support@bombilafou.com>'."\n";
         $header.='Content-Type:text/html; charset="utf-8"'."\n";
         $header.='Content-Transfer-Encoding: 8bit';
         $message = '
         <html>
         <head>
           <title>Récupération de mot de passe - bombilafou.com</title>
           <meta charset="utf-8" />
         </head>
         <body>
           <font color="#303030";>
             <div align="center">
               <table width="600px">
                 <tr>
                   <td>
                     
                     <div align="center">Bonjour <b>'.$pseudo.'</b>,</div>
                     Voici votre code de récupération: <b>'.$recup_code.'</b>
                     A bientôt sur <a href="http://bombilafou.com/">bombilafou.com</a> !
                     
                   </td>
                 </tr>
                 <tr>
                   <td align="center">
                     <font size="2">
                       Ceci est un email automatique, merci de ne pas y répondre
                     </font>
                   </td>
                 </tr>
               </table>
             </div>
           </font>
         </body>
         </html>
         ';
         
         mail($recup_mail, "Récupération de mot de passe - bombilafou.com", $message, $header);
            header("Location:   http://www.bombilafou.com/PHP/recup_passwd.php?section=code"); 
         } else {
            $error = "Cette adresse mail n'est pas enregistrée";
         }
      } else {
         $error = "Adresse mail invalide";
      }
   } else {
      $error = "Veuillez entrer votre adresse mail";
   }
}
if(isset($_POST['verif_submit'],$_POST['verif_code'])) {
   if(!empty($_POST['verif_code'])) {
      $verif_code = htmlspecialchars($_POST['verif_code']);
      $verif_req = $bdd->prepare('SELECT id FROM recup_passwd WHERE mail = ? AND code = ?');
      $verif_req->execute(array( $_SESSION['recup_mail'],$verif_code));
      $verif_req = $verif_req->rowCount();
      if($verif_req == 1) {
         $up_req = $bdd->prepare('UPDATE recup_passwd SET confirme = 1 WHERE mail = ?');
         $up_req->execute(array($_SESSION['recup_mail']));
         header('Location: http://bombilafou.com/PHP/recup_passwd.php?section=changemdp');
      } else {
         $error = "Code invalide";
      }
   } else {
      $error = "Veuillez entrer votre code de confirmation";
   }
}
if(isset($_POST['change_submit'])) {
   if(isset($_POST['change_mdp'],$_POST['change_mdpc'])) {
      $verif_confirme = $bdd->prepare('SELECT confirme FROM recup_passwd WHERE mail = ?');
      $verif_confirme->execute(array($_SESSION['recup_mail']));
      $verif_confirme1 = $verif_confirme->fetch();
      $verif_confirme2 = $verif_confirme1['confirme'];
      if($verif_confirme2 == 1) {
         $mdp = htmlspecialchars($_POST['change_mdp']);
         $mdpc = htmlspecialchars($_POST['change_mdpc']);
         if(!empty($mdp) AND !empty($mdpc)) {
            if($mdp == $mdpc) {
               $mdp = password_hash($mdp, PASSWORD_BCRYPT);
               $ins_mdp = $bdd->prepare('UPDATE Membres SET Password = ? WHERE Mail = ?');
               $ins_mdp->execute(array($mdp,$_SESSION['recup_mail']));
              $del_req = $bdd->prepare('DELETE FROM recup_passwd WHERE mail = ?');
              $del_req->execute(array($_SESSION['recup_mail']));
               header('Location:http://bombilafou.com/PHP/connexion1.php');
            } else {
               $error = "Vos mots de passes ne correspondent pas";
            }
         } else {
            $error = "Veuillez remplir tous les champs";
         }
      } else {
         $error = "Veuillez valider votre mail grâce au code de vérification qui vous a été envoyé par mail";
      }
   } else {
      $error = "Veuillez remplir tous les champs";
   }
}
?>
	
            <h4 align="center" class="title-element">Récupération de mot de passe</h4>
      		 <div id="delimit" align="center">
            <?php if($section == 'code') { ?>
            <p align='center'>Un code de vérification vous a été envoyé à l'adresse e-mail suivant : <?= $_SESSION['recup_mail'] ?></p>
           		
                <form align="center" action="recup_passwd.php"  method="post">
                  <p>Veillez entrez ici le code que vous avez recu dans vos boite e-mail</p>
                    <table>
                        <tr>
                            <td>
                                <input type="text" placeholder="Code de vérification" name="verif_code"/><br/><br/>
                            </td>
                            <td>
                                <input type="submit" value="Valider" name="verif_submit"/>
                            </td>
                         </tr>   
                   </table>
                </form>
                <?php } elseif($section == "changemdp") { ?>
                Nouveau mot de passe pour <?= $_SESSION['recup_mail'] ?>
                <form align="center" method="post" action="recup_passwd.php" class="form-pass">
                  <p><br/><br/>Veillez tapez un nouveau mot de passe pour votre compte !</p>
                    <table>
                        <tr>
                            <td>
                                <input type="password" placeholder="Nouveau mot de passe" name="change_mdp"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" placeholder="Confirmation du mot de passe" name="change_mdpc"/><br/><br/>
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                <input type="submit" value="Valider" name="change_submit"/>
                            </td>    
                         
                        </tr>   
                    </table>        
                </form>
                <?php } else { ?>
                <form align="center" method="post" action="recup_passwd.php">
                  	<p>Veillez entrez ici votre e-mail !</p
                    <table>
                        <tr>
                            <td>
                                <input type="email" placeholder="Votre adresse mail" name="recup_mail"/><br/><br/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="Valider" name="recup_submit"/>
                            </td>    
                            
                        </tr>    
                    </table>  
               
                </form>
          <?php } ?>
            <?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>'; } else { echo ""; }?> 
            
           		</div>
      			    <?php include_once '../HTML/footer_page.html'; ?> 
           </div>
    </body>
</html>
