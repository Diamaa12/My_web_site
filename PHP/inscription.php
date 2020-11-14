<?php session_start();
include_once 'function/function.php';
include_once 'function/inscription_class.php';
include_once 'function/compteur.php';
$bdd = bdd();

$pseudo = !empty($_POST['pseudo'])? $_POST['pseudo']: "";
$email = !empty($_POST['mail'])? $_POST['mail']: "";
$confMail = !empty($_POST['mail2'])? $_POST['mail2']:"";
$pass = !empty($_POST['mdp'])? $_POST['mdp']: "";
$confpass = !empty($_POST['mdp2'])? $_POST['mdp2']: "";

if($pseudo and $email and $pass and $confpass){
    $inscription = new inscription_class($pseudo, $email, $confMail, $pass, $confpass);
    $erreur = $inscription->verifie();

                $key = "";
                $longuerKey = 15;
                for ($i=1; $i<$longuerKey;$i++){
                  $key .= mt_rand(0, 9) ;
                }
                  if($erreur =='ok' ){
//                    $inscription->enregistrement($key);

                    $key = $inscription->enregistrement($key);
                    $mail = $email; // Déclaration de l'adresse de destination.
                    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
                    {
                            $passage_ligne = "\r\n";
                    }
                    else
                    {
                            $passage_ligne = "\n";
                    }
                    //=====Déclaration des messages au format texte et au format HTML.
                    $message_txt = "Salut à tous, voici un e-mail envoyé par un script PHP.";
                    $message_html='
                    <html>
                         <meta charset="utf-8">
                            <body>
                            		<style>
                                    	div{
                                        	width:50%;
                                            position relative;
                                            left:25%;
                                            height:auto;
                                            font-family:sans-serif;
                                            font-weight:bold;
                                            font-size:1em;
                                        }
                                        img{
                                        	border-bottom:3px solid black;
                                            margin:20% auto;
                                        }
                                        p{
                                        	display:inline-block;
                                        }

                                    </style>
                                    <div align="center" >
                                            <img src="https://www.bombilafou.com/Images/fav-icon1/msi-icon-150x150.png"/>
                                            <br/><br/>
                                            <p>Veillez suivre ce lien pour confirmer votre compte!</p>
                                             <br/><br/>
                                             <a href="http://bombilafou.com/PHP/confirmation.php?pseudo='.urlencode($pseudo).'&key='.$key.'">Confirmez votre compte !</a>
                                            <br />

                                    </div>
                            </body>
                    </html>
                    ';
                    //==========

                    //=====Lecture et mise en forme de la pièce jointe.
                    $file = "../Images/Font-2.jpg";
                    $fichier   = fopen($file, "r");
                    $attachement = fread($fichier, filesize($file));
                    $attachement = chunk_split(base64_encode($attachement));
                    fclose($fichier);
                    //==========

                    //=====Création de la boundary.
                    $boundary = "-----=".md5(rand());
                    $boundary_alt = "-----=".md5(rand());
                    //==========

                    //=====Définition du sujet.
                    $sujet = "Reinitialisation de mot de passe !";
                    //=========

                    //=====Création du header de l'e-mail.
                    $header = "From: \"Bombilafou\"<supportb@bombilafou.com>".$passage_ligne;
                    $header.= "Reply-to: \"Bombilafou\"<supportb@bombilafou.com>".$passage_ligne;
                    $header.= "MIME-Version: 1.0".$passage_ligne;
                    $header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
                    //==========

                    //=====Création du message.
                    $message = $passage_ligne."--".$boundary.$passage_ligne;
                    $message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
                    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
                    //=====Ajout du message au format texte.
                    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
                    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
                    $message.= $passage_ligne.$message_txt.$passage_ligne;
                    //==========

                    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

                    //=====Ajout du message au format HTML.
                    $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
                    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
                    $message.= $passage_ligne.$message_html.$passage_ligne;
                    //==========

                    //=====On ferme la boundary alternative.
                    $message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
                    //==========



                    $message.= $passage_ligne."--".$boundary.$passage_ligne;

                    //=====Ajout de la pièce jointe.
                    //$message.= "Content-Type: image/jpeg; name=\"Font-2.jpg\"".$passage_ligne;
                    //$message.= "Content-Transfer-Encoding: base64".$passage_ligne;
                    //$message.= "Content-Disposition: attachment; filename=\"Font-2.jpg\"".$passage_ligne;
                    //$message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
                    //$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
                    //==========
                    //=====Envoi de l'e-mail.
                    mail($mail,$sujet,$message,$header);
                  $_SESSION['Pseudo'] = $inscription->session();
                  header('Location: finalisation_du_compte.php');


                    }
                    else {
                         echo '';

                     }


                     }





?>



<!DOCTYPE html>
<html>
     <?php include_once '../HTML/header-page.html';?>
    <meta charset='utf-8' />
    <meta name="author" content="Thibault Neveu">
    <link rel="stylesheet" type="text/css" href="../CSS/header_page.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/footer_page.css" />
    <link rel="shortcut icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="../CSS/inscription.css"/>
    <link href='http://fonts.googleapis.com/css?family=Karla' rel='stylesheet' type='text/css'>
   <body>
       <div align="center" id="div-item">

         <form  method="POST" action="" id="forms">
           <h2 style="color=white">Inscription</h2>
           <br />
            <table>
               <tr>
                  <td align="right">
                     <label for="pseudo">Pseudo :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
                     <small></small>
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mail">Mail :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($email)) { echo $email; } ?>" /><span id="error"></span>
                     <small></small>
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mail2">Confirmation du mail :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($confMail)) { echo $confMail; } ?>" />
                     <small></small>
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mdp">Mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
                     <small></small>
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mdp2">Confirmation du mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
                     <small></small>
                  </td>
               </tr>
               <tr>
                  <td></td>
                  <td align="center">
                     <br />
                     <input type="submit" name="forminscription" value="Je m'inscris" class="b_submit"  />
                  </td>
               </tr>
            </table>
                <p class="donner">En cliquant sur je m'<span>inscris, </span>vous accepter <a href="politique_de-confidentialite.php"> nos conditions d'utilisations</a> </p>
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>

      </div>
       <script style="text/javascript" src="../Javascript/inscription.js"></script>
       <?php include_once '../HTML/footer_page.html';?>
   </body>


</html>
