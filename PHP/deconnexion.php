<?php

session_start();
session_unset();
session_destroy();?>
<!DOCTYPE html>
<html lang="fr">
  <body>
    <link rel="stylesheet" href="../CSS/deconnexion.css"/>
    <div id="conteneur">
		<?php include_once '../HTML/header-page.html';?>
      	<div>

		<h2>Vous vous êtes déconnecté, veillez cliquer <a href="connexion1.php">ici</a> pour vous connecter de nouveau</h2>
      </div>
      <?php include_once '../HTML/footer_page.html';?>
    </div>
    </body>
</html>


