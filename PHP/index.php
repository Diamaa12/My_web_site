<?php
session_start();

include_once 'function/function.php';
$bdd = bdd();
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
      
       header("Location: http://localhost/Sites/NzereInfo/PHP/profil.php?id=".$_SESSION['id']);
            echo 'donner traite avec succés';
      } else {
         $erreur = "Mauvais Pseudo ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
<!DOCTYPE html>
<html lang="fr">
<?php include_once '../HTML/header-page.html';?>
<link rel="stylesheet" href="CSS/menu2.css" />
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin&display=swap" rel="stylesheet"> 
<body>
   
     <?php if (isset($_SESSION['Pseudo'])){echo '<h4 class="connect">bonjour '.$_SESSION['Pseudo'].' <br/><a href="deconnexion.php">Se deconnecter</a></h4>';}else{    echo '<h4 class="connect"><a href="connexion1.php">Se connecter</a></h4>';}?>
     
    <div id="div-principal">
        <div id="div-first">
            <ul>
                <li> Leyssare</li>
                <li>Kouraboulou</li>
                <li>Kowli</li>
            </ul>
        </div>
        <div id="div-twice">
            <ul>
                <li id="li-first"><h2>Premier article</h2>
                    <p><img src="../Images/Font-2.jpg" alt="SiteLogo"/>    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        
                    </p>
                </li>
                <li id="li-twice"><h2>Deuxième article</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Aenean sed adipiscing diam donec adipiscing tristique risus nec. Porta non pulvinar neque laoreet suspendisse interdum consectetur libero. Dictum sit amet justo donec. Faucibus a pellentesque sit amet porttitor eget dolor. Amet risus nullam eget felis. Posuere urna nec tincidunt praesent semper feugiat nibh sed pulvinar. Erat velit scelerisque in dictum non. Cursus mattis molestie a iaculis at erat pellentesque adipiscing commodo. Enim blandit volutpat maecenas volutpat blandit aliquam etiam erat.

Gravida arcu ac tortor dignissim convallis aenean et tortor. Luctus accumsan tortor posuere ac ut consequat. Ultricies mi eget mauris pharetra et. Magna fringilla urna porttitor rhoncus dolor purus non. Quisque egestas diam in arcu cursus. Libero justo laoreet sit amet cursus sit amet. Vitae suscipit tellus mauris a diam. Ut tellus elementum sagittis vitae et. Pharetra pharetra massa massa ultricies mi quis. Vitae congue mauris rhoncus aenean vel. Vitae congue mauris rhoncus aenean. In hendrerit gravida rutrum quisque non tellus orci. Cursus euismod quis viverra nibh. Id porta nibh venenatis cras sed felis eget. Arcu vitae elementum curabitur vitae nunc sed velit. Auctor eu augue ut lectus. Venenatis a condimentum vitae sapien pellentesque habitant morbi. Sit amet justo donec enim diam vulputate ut pharetra. Ultricies leo integer malesuada nunc vel risus commodo viverra maecenas. Pellentesque eu tincidunt tortor aliquam nulla facilisi cras fermentum odio.
                    </p>
                </li>
                <li id="li-three"><h2>Troisième artcile</h2>
                <p>Video qui explique comment formater son pc nunc vel risus commodo viverra maecenas accumsan lacus vel facilisis volutpat est velit egestas dui id ornare arcu odio ut sem nulla pharetra diam sit amet nisl suscipit adipiscing bibendum est ultricies integer quis auctor elit sed vulputate mi sit amet mauris commodo quis imperdiet massa tincidunt<br/>
                    <object width="420" height="315"
data=https://www.youtube.com/embed/wPSJ245H4OU>
                    </object>    
                </p>
                </li>
                <li id="li-furth"><h2>Quatrième article</h2>
                         <p>Video qui explique comment formater son pc nunc vel risus commodo viverra maecenas accumsan lacus vel facilisis volutpat est velit egestas dui id ornare arcu odio ut sem nulla pharetra diam sit amet nisl suscipit adipiscing bibendum est ultricies integer quis auctor elit sed vulputate mi sit amet mauris commodo quis imperdiet massa tincidunt<br/>
                    <object width="420" height="315"
data=https://www.youtube.com/embed/wPSJ245H4OU>
                    </object>    
                </p>
                </li>
            </ul>
        </div>
        <section id="secs-one"> <h3>ici nous allons y publier d'autres types d'énvènement</h3><br/>
            <p>nunc vel risus commodo viverra maecenas accumsan lacus vel facilisis volutpat est velit egestas dui id ornare arcu odio ut sem nulla pharetra diam sit amet nisl suscipit adipiscing bibendum est ultricies integer quis auctor elit sed vulputate mi sit amet mauris commodo quis imperdiet massa tincidunt nunc pulvinar sapien et ligula ullamcorper malesuada proin libero nunc consequat interdum varius sit amet mattis vulputate enim nulla aliquet porttitor lacus luctus accumsan tortor posuere ac ut consequat semper viverra nam libero justo laoreet sit amet cursus sit amet dictum sit amet justo donec enim diam vulputate ut pharetra sit amet aliquam id diam maecenas ultricies mi eget mauris pharetra et ultrices neque ornare aenean euismod elementum nisi quis eleifend quam adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque viverra justo nec ultrices dui sapien eget mi proin sed libero</p>
        </section>
    </div>
    <div id="div-2"> 
    <aside id="first-aside">
            <h3>Danger lieu aux réseau sociaux</h3>
            <p>
              En quelques mots, les réseaux sociaux sont des communautés d’utilisateurs sur internet, proposées par des entreprises à but mercantile. Les utilisateurs sont donc clients de ces entreprises.

Aussi, le but de ces derniers est de captiver au maximum l’attention des internautes pour leur faire passer le plus de temps possible sur les plateformes. Et ceci pour plusieurs raisons :

    Plus d’amis = plus d’argent : plus le réseau est actif, et plus il a de chance de faire venir de nouveaux utilisateurs, qui vont à leur tour être actif et rendre (par effet boule de neige) le réseau toujours plus attractif.
    Maximiser le temps passé = plus de publicités affichées, et donc moins de temps passé chez la concurrence.
    Enfin, plus vous êtes présent sur le réseau social = plus vous voyez de publicité, et donc meilleur sont les revenus pour l’entreprise.

Pour atteindre ces objectifs, ces entreprises utilisent des stratagèmes dont quelques unes seront évoquées plus bas dans cet article. Une partie de ces méthodes sont également utilisées par d’autres entreprises comme des éditeurs de logiciels, pour lesquels il faudra installer certains logiciels de nettoyage pour éviter que Windows ne ralentit.

Du côté utilisateur, la guerre des navigateurs internet que se livrent Google, Mozilla et Microsoft (Cf. Guerre des navigateurs WEB) a pour but d’éduquer l’internaute pour qu’ils se plient aux règles de l’entreprise. Au final, ces méthodes fonctionnent relativement bien, puisque nous faisons quasiment tout sur Facebook, Twitter ou Google.

Ainsi, les deux problèmes qui peuvent se poser avec la multiplication des réseaux sociaux, et leur usage fréquent, sont la perte de la gestion sur la collecte et l’emploi de nos données privées et l’addiction. 
            </p>
        </aside>
    <aside id="second-aside">
            <h3>Connexion</h3>
            <form method="POST" action="index.php">
                <input type="text" placeholder="Votre Pseudo" name="user"/><br/>
                <input type="password" placeholder="Votre mot de passe" name="pass"/><br/>
                <input type="submit" value="Connexion" name="submit"/>
                  <?php 
                        if(isset($erreur)){
                            echo '<p style="color:#FF0000">'.$erreur.'</p>';
                        }
                        ?>
                   
            </form>
            <p><a href="http://localhost/Sites/NzereInfo/PHP/recup_passwd.php">Mot de passe oublier?</a><br/><br/> <a href="inscription.php"> Pas encore membres?</a></p>
           
        </aside>
      </div>  
    
<?php include_once '../HTML/footer_page.html';?>
        <script type="text/javascript" src="../Javascript/footer.js"> </script>
       
</body>

</html>


