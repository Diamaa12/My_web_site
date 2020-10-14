
<?php session_start();       
 include_once 'function/connexion_class.php';
include_once 'function/function.php';
$bdd = bdd();
if(isset($_POST['user']) AND isset($_POST['pass'])){
    
    $connexion = new connexion($_POST['user'],$_POST['pass']);
     $verif = $connexion->verif();
    if($verif =="ok"){
      if($connexion->session()){
          header('Location: index.php');
      }
    }
    else {
        $erreur = $verif; 
    } 
}

?>  


<!DOCTYPE html>
<html>
<body>
  <div id="conteneur">
    <?php include_once '../HTML/header-page.html';?>
    

        <link rel="stylesheet" href="../CSS/connexion.css">
 <h1>Connexion</h1>
    
            <div class="madiv1">
                <form method="POST" action="connexion.php">
                    
                        <input name="user" type="text" placeholder="Pseudo..." required /><br>
                        <input name="pass" type="password" placeholder="Mot de passe..." required /><br>
                        <input type="submit"  value="Connexion !" />
                        <?php 
                        if(isset($erreur)){
                            echo $erreur;
                        }
                        ?>
                   
                </form> 
                <p><a href="reset_pass.php">Mot de passe oublier? </a> </p>
                
            </div>
    	 <?php include_once '../HTML/footer_page.html';?>
    </div>
</body>

</html>