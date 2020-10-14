<?php
session_start();
include_once 'function/function.php';
include_once 'function/addPost_class.php';
include_once 'function/compteur.php';

$bdd = bdd();?>
<!DOCTYPE html>
<html>
  <body>
    <div id="conteneur">
 <?php include_once '../HTML/header-page.html';?>
    <title>index page</title>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="../CSS/indexForum.css">
    <link rel="stylesheet" href="../CSS/header_page.css">
    <link rel="stylesheet" href="../CSS/footer_page.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../Javascript/jquery.wysibb.min.js"></script>
    <link rel="stylesheet" href="https://bombilafou.com/CSS/wbbtheme.css" />
   


<?PHP

if(!isset($_SESSION['Pseudo'])){
   
    echo '<div id="conteneur1"><p class="infopara">Vous n\'êtes pas encore membres? Veillez cliquer<a href="inscription.php"><span color="green"> ici</span></a>  pour vous inscrire<br/><br/>'
    . 'Ou bien si vous êtes déjà membres cliquer <a href="connexion1.php"> <span color="green"> ici</span> </a> pour vous connecter de nouveau</p></div>';
}
 else {
     
            if(isset($_POST['sujet']) and isset($_POST['postName'])){
          $addPost = new addPost($_POST['sujet'], $_POST['postName']) ;
          $toVerify = $addPost->verif();
               if($toVerify == 'ok'){
                   if($addPost->insert()){
                       
                   }
                   else {
                       echo 'L\'enregistremet du Post n\'est pas réussit';
                   }

               }
               else{
                       $erreur = $toVerify;
                }
       }

     ?>
		   <div id="cforum">
       			 <h1 class="msgacueil">Bienvenue sur l'espace d'entre aide</h1>
        
            	<h3 class="h31">Bonjour <p id="para5"><span><?php echo $_SESSION['Pseudo'];?></span><a href="deconnexion.php">, deconnexion</a></p></h3>
                            <p class="para4">Ici, vous pouvez posez des questions ou apporter des réponses aux autres membres<br/> dans différents sujets</p>
         <?php 
                if(isset($_GET['categorie'])){
                    $_GET['categorie'] = htmlspecialchars($_GET['categorie']);
                    ?>
                        <div class="categories">
                            <h2><?php echo $_GET['categorie'];?></h2>
                            <a href="addSujet.php?categorie=<?php echo $_GET['categorie'];?>">Ajouter un sujet</a>
                            <?php
                                $res = $bdd->prepare('SELECT * FROM sujet WHERE categorie=:categorie');
                                $res->execute(array('categorie'=>$_GET['categorie']));
                                
                                while ($reponse = $res->fetch()){
                                    ?>
                                         <div id="sujet">
                                             <a href="indexForum.php?sujet=<?php echo $reponse['Nom']?>"><h1><?php echo $reponse['Nom']?></h1></a>
                                        </div>
                                  <?php
                                }   
                            ?>
                        </div>
                    <?php
                
                }
                  else if(isset($_GET['sujet'])){
                    $_GET['sujet'] = htmlspecialchars($_GET['sujet']);
                    ?>
                        <div class="sujet">
                            <h2>Sujet actuel: <?php  echo $_GET['sujet'];?></h2><br/>
                            <a href="addSujet.php">Ajouter un nouveau sujet</a>
                        </div>
                    <?php
                    $requete = $bdd->prepare("SELECT *,DATE_FORMAT(Date, '%d/%m/%Y %H:%i:%s') AS date FROM postSujet WHERE Sujet=:sujet");
                    $requete->execute(array('sujet'=>$_GET['sujet']));
                    while ($reponse = $requete->fetch()){
                   
                        ?>
            <div class="post">
                <?php   $requete3 = $bdd->prepare("SELECT * FROM Membres WHERE id=:id ");
                        $requete3->execute(array('id'=>$reponse['Proprio']));
                        $membres = $requete3->fetch();
                        
                         echo '<p class="para5"><strong> '.$membres['Pseudo']. '</strong> a répondue le '. $reponse['date'].'</p>';
                         $requser2 = $bdd->prepare('SELECT * FROM Profils WHERE membres_id = ?');
                         $requser2->execute(array($membres['id']));
                         $userinfo2 = $requser2->fetch();?>
                <img class="avatar" src="Avatar/<?php echo $userinfo2['Avatars']?> " alt="Avatar" /> <?php 
                        
                             echo '<br>';
                            echo '<p class="contenue">'.$reponse['Contenue'].'</p>';
                        ?>
                </div>
              
            <?php
            
                    }?>
            <script>
                                $(function() {
                                    var button = {buttons:"bold,｜,italic,｜,underline,｜, img,｜,link,｜, code,｜, quote"}
                            $(".wysibb").wysibb(button);
                            })
            </script>
            <h4 id="repondre">Répondre au sujet</h4><br>
            <form class="postForm"method="post" action="indexForum.php?sujet=<?php echo $_GET['sujet']; ?>">
                        <textarea class="wysibb" name="sujet" placeholder="Votre message..." ></textarea>
                        <input type="hidden" name="postName" value="<?php echo $_GET['sujet']; ?>" /><br/>
                         <input type="submit" value="Ajouter à la conversation" />
                        <?php 
                        if(isset($erreur)){
                            echo $erreur;
                        }
                        ?>
                    </form> 
            
            <?php
              
                }
                else {
             
              $requete = $bdd->prepare('SELECT Nom FROM categories');
                     $requete->execute();
                     while ($reponse = $requete->fetch())
                     {
                          ?>  
                             <div class="categories">
                                 <a href="indexForum.php?categorie=<?php echo $reponse['Nom']; ?>"><?php echo $reponse['Nom']; ?></a>
                             </div>
                    <?php 
                     }
                    } 
             
  
}
       
  ?>         
        </div>
           <?php include_once '../HTML/footer_page.html';?>
        </div>
    </body>
    
</html>
  