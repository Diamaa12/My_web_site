<?php
session_start();

include_once 'function/function.php';
include_once 'function/reset_pass_class.php';

if(isset($_POST['submit'], $_POST['mail']) or isset($_POST['pseudo'])){
   $resetPass = new Reset_pass($_POST['mail'], $_POST['pseudo']) ;
   $toVerify = $resetPass->verif();
        if($toVerify == 'ok'){
            header("Location:http://localhost/Sites/NzereInfo/PHP/newpass.php");
            
        }
        else{
                
               $erreur = $toVerify;
         }
}

        
?>

<h2>"Reinitialiser votre mot de passe"</h2>
<p> Pour réinitialiser votre mot de passe veillez entrer votre email ou votre pseudo </p>
            <form  method="post" action="reset_pass.php">
                <input type="email" name="mail" placeholder="Votre email ici..."/><br/>
                <input type="text" name="pseudo" placeholder="Votre pseudo ici..."/><br/>
                <input type="submit" name="submit"value="Soumettre"><?php if($erreur){echo $erreur;}?>
            </form>
