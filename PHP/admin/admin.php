<?php
include_once '../function/compteur.php';

$bdd = bdd();

$requette = $bdd -> prepare('SELECT user_ip FROM online');
$requette->execute();


?>
<html>
    <head>
        <title>Page admin</title>
        <meta charset="utf-8"/>
      	<link rel="stylesheet" href="../../CSS/admin.css"/>
              
    </head>
        
     
    <body>
      <?php include_once '../../HTML/header-page.html'; ?>
      <h1>Bienvenue sur la page d'administration du site!</h1>
      		<div id="div_principal">
             <div id="div-first">
                <p> Actuellement <?php echo $user_nbr; ?> utilisateur en ligne 
                <a href="https://bombilafou.com">Go to index page</a></p>
                <p class="devel">Le site est atuellement en developpement</p>
                <?php while($ip = $requette->fetch()){$ip = $ip['user_ip']; echo '<li>'.$ip.'</p>';}  ?>
        	</div>
            <div id="div_twice">
              
             <?php 			
            if(isset($_GET['type']) AND $_GET['type'] == 'membre') {
               if(isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
                  $confirme = (int) $_GET['confirme'];
                  $req = $bdd->prepare('UPDATE Membres SET confirme_user = 1 WHERE id = ?');
                  $req->execute(array($confirme));
               }
               if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
                  $supprime = (int) $_GET['supprime'];
                  $req = $bdd->prepare('DELETE FROM Membres WHERE id = ?');
                  $req->execute(array($supprime));
               }
            } elseif(isset($_GET['type']) AND $_GET['type'] == 'commentaire') {
               if(isset($_GET['approuve']) AND !empty($_GET['approuve'])) {
                  $approuve = (int) $_GET['approuve'];
                  $req = $bdd->prepare('UPDATE commentaires SET approuve = 1 WHERE id = ?');
                  $req->execute(array($approuve));
               }
               if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
                  $supprime = (int) $_GET['supprime'];
                  $req = $bdd->prepare('DELETE FROM commentaires WHERE id = ?');
                  $req->execute(array($supprime));
               }
            }
            $membres = $bdd->prepare('SELECT * FROM Membres ORDER BY id DESC');
             $membres->execute();
            
           
            ?>
              <h3>Membres non confirmée</h3>
					         <ul>
                   <?php while($m = $membres->fetch()) { ?>
                    <li><?= $m['id'] ?> : <?= $m['Pseudo'] ?><?php if($m['confirme_user'] == 0) { ?> - <a href="admin.php?type=membre&confirme=<?= $m['id'] ?>">Confirmer</a><?php } ?> - <a href="admin.php?type=membre&supprime=<?= $m['id'] ?>">Supprimer</a></li>
                   <?php } ?>
                </ul>
                <br /><br />

                <?php 
                  $membres = $bdd->prepare('SELECT * FROM Membres WHERE confirme_user = 1');
                          $membres->execute();

                ?>
              <h3>Membres  confirmée</h3>
                 <ul>
                   <?php while($m = $membres->fetch()) { ?>
                    <li><?= $m['Pseudo']?></li>
                   <?php } ?>
                </ul>
                <br /><br />
              <h3>Commentaires</h3>
                <ul>
                   <?php
                   $commentaires = $bdd->prepare('SELECT * FROM commentaires ORDER BY id DESC LIMIT 0,5');
                   $commentaires->execute();
                   while($c = $commentaires->fetch()) { ?>
                    <li><?= $c['id'] ?> : <?= $c['membre'] ?> : <?= $c['contenue'] ?><?php if($c['approuve'] == 0) { ?> - <a href="admin.php?type=commentaire&approuve=<?= $c['id'] ?>">Approuver</a><?php } ?> - <a href="admin.php?type=commentaire&supprime=<?= $c['id'] ?>">Supprimer</a></li>
                   <?php } ?>
                </ul>
              
                         <?php        
                    
                    $articles = $bdd->query('SELECT * FROM Articles ORDER BY date_publication DESC');
                    ?>
                 <h3>Articles</h3>
                <ul>

                   <?php while($a = $articles->fetch()) { ?>
                   <li><a href="article.php?id=<?= $a['id'] ?>"><?= $a['titre'] ?></a></li>
                   <?php } ?>
                <ul>
            </div>
   

      			 <script type="text/javascript">
                        setTimeout( function(){ self.location.reload()}, 120000)
                    </script>
              <?php include_once '../../HTML/footer_page.html';?>
      	</div>
      
    </body>
</html>
