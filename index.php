<?php
session_start();

include_once 'PHP/function/function.php';

include_once 'PHP/function/compteur.php';

$bdd = bdd();

//Pagination
$articlesPages = 5;
$articlesTotaleReq = $bdd->query('SELECT id FROM Articles');
$allArticles = $articlesTotaleReq->rowCount();
$allPages = ceil($allArticles/$articlesPages);

if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0  AND $_GET['page'] <= $allPages){
  $_GET['page'] = intval($_GET['page']);
  $pageCourante = $_GET['page'];
}
 else {
    $pageCourante = 1;
}
$depart = ($pageCourante-1)* $articlesPages;


//Page de connexion
if(isset($_POST['submit'])) {
   $mailconnect = htmlspecialchars($_POST['user']);
   $mdpconnect = htmlspecialchars($_POST['pass']);
   if(!empty($mailconnect) AND !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM Membres WHERE Pseudo = ?");
      $requser->execute(array($mailconnect));
      
      $userexist = $requser->rowCount();
     
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         
         if(password_verify($mdpconnect, $userinfo['Password'])){
             echo 'Les mot de passe sont egal'; 
         }
        else {
             echo 'Les mot de passe sont different';
        }
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['Pseudo'] = $userinfo['Pseudo'];
      
       header("Location: http://localhost/Sites/mywebsite/PHP/profil.php?id=".$_SESSION['id']);
            echo 'donner traite avec succés';
      } else {
         $erreur = "Mauvais Pseudo ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
    
//articles
$articles = $bdd->query("SELECT *,DATE_FORMAT(date_publication, '%d/%m/%Y %H:%i:%s') AS date FROM Articles ORDER BY id DESC LIMIT ".$depart.','.$articlesPages);



?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        
            <link rel="stylesheet" href="CSS/menu2.css" />
            <link rel="stylesheet" href="CSS/header_page.css" />
            <link rel="stylesheet" href="CSS/footer_page.css" />
            <link href="https://fonts.googleapis.com/css?family=Libre+Franklin&display=swap" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
             <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d3b78d246336b8a"></script>
             <script src="Javascript/jquery-ias.min.js"></script>  
    </head>

<body onload="confidentialite()">
    <?php include_once 'HTML/header-page.html';?>




    <?php if (isset($_SESSION['Pseudo'])){echo '<h4 class="connect">bonjour '.$_SESSION['Pseudo'].' <br/><a href="PHP/deconnexion.php">Se deconnecter</a></h4>';}else{    echo '<h4 class="connect"><a href="PHP/connexion1.php">Se connecter</a></h4>';}?>
    <div id="div-principal">
 
     
        <div id="allArticles">
            <?php 
                while($art = $articles->fetch()){
                    ?>
            <div id="article">
                <h3 class="titre"><?= $art['titre']?></h3><p class="para1"> Auteur, <?= $art['auteur']?>,&nbsp Publiée le&nbsp <?= $art['date']?></p>
          
                 </b><br />
                  
                  <img src="PHP/admin/<?= $art['image'] ?>" />


                <br/>
                    <p class="para2"><?= $art['contenue']?></p>
                
            </div>
            <?php }?>
              </div>
            <div id="pagination">Pages suivants,
                <?php
            
                        for($i=1;$i<=$allPages;$i++) {
                 if($i == $pageCourante) {
                    echo $i.' ';
                    
                  
                 }
                  elseif ($i == $pageCourante+1) {
                      echo '<a href="index.php?page='.$i.'" class="next">'.$i.'</a> ';
                  }
                 else {
                    echo '<a href="index.php?page='.$i.'">'.$i.' </a> ';
                 }
              }
              ?>
            </div>

       
        
  



    </div>

    <aside class="first-aside">
        <h3>Pages Membres</h3>
        <p>
            Site web actuellement en construction
          <img id="construction"src="Images/404-page.jpg" alt="construction"/>
        </p>
    </aside>
    <aside class="second-aside">
        <h3>Connexion</h3>
        <form method="POST" action="index.php">
            <input type="text" placeholder="Votre Pseudo" name="user" /><br />
            <input type="password" placeholder="Votre mot de passe" name="pass" /><br />
            <input type="submit" value="Connexion" name="submit" />
            <?php 
                        if(isset($erreur)){
                            echo '<p style="color:#FF0000">'.$erreur.'</p>';
                        }
                        ?>

        </form>
        <p><a href="PHP/recup_passwd.php">Mot de passe oublier?</a><br /><br /> <a href="PHP/inscription.php"> Pas encore membres?</a></p>

    </aside>
    	<!-- Go to www.addthis.com/dashboard to customize your tools -->
       


  <?php include_once 'HTML/footer_page.html';?>

</body>

</html>
