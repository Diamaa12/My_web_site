<?php

session_start();
include_once 'function/function.php';
include_once 'function/addSujet_class.php';
include_once 'function/compteur.php';
$bdd = bdd();

if(isset($_POST['sujetName']) and isset($_POST['sujet'])){
   $addSujet = new addSujet($_POST['sujetName'], $_POST['sujet'], $_POST['categorie']) ;
   $toVerify = $addSujet->verif();
        if($toVerify == 'ok'){
            if($addSujet->insert()){
                header('Location: indexForum.php?sujet='.$_POST['sujetName']);
            }
            else {
                echo 'L\'enregistremet du sujet n\'est pas réussit';
            }
            
        }
        else{
                $erreur = $toVerify;
         }
}

      
?>

<!DOCTYPE html>
<html>
    <?php include_once '../HTML/header-page.html';?>
    <link rel="stylesheet" href="../CSS/connexion.css">
    <link rel="stylesheet" href="../CSS/addSujet.css">
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../Javascript/jquery.wysibb.min.js"></script>
    <link rel="stylesheet" href="../CSS/wbbtheme.css" />
<body>
                <script>
                                $(function() {
                                    var button = {buttons:"bold,｜,italic,｜,underline,｜, img,｜,link,｜, code,｜, quote"}
                            $(".wysibb").wysibb(button);
                            })
            </script>
    <h2 align="center">Ajouter un sujet </h2>
   
            <div id="div_sujet" align="center">
                <?php  echo '<p>Bonjour <strong>'.$_SESSION['Pseudo'].'</strong><a href="deconnexion.php">Deconnexion<a></p>';?>
                <form  method="POST" action="addSujet.php?categorie=<?php echo $_GET['categorie'];?>">
                    
                        <input name="sujetName" type="text" placeholder="Nom du sujet..." required /><br>
                        <textarea class="wysibb" name="sujet" placeholder="Contenue du sujet..."></textarea></br>
                        <input type="hidden" value="<?php echo $_GET['categorie'];?>" name="categorie">
                        <input type="submit" value=" Ajouter le sujet" />
                        <?php if($erreur){echo $erreur;}?>
             </form> 
                
            </div>
</body>
 <?php include_once '../HTML/footer_page.html';?>
</html>