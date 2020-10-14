<?php
include_once '../function/function.php';
$bdd = bdd();
if(isset($_GET['id']) AND !empty($_GET['id'])) {
   $get_id = htmlspecialchars($_GET['id']);
   $article = $bdd->prepare('SELECT * FROM Articles WHERE id = ?');
   $article->execute(array($get_id));
   if($article->rowCount() == 1) {
      $article = $article->fetch();
      $titre = $article['titre'];
      $contenu = $article['contenue'];
      $date_publication = $article['date_publication'];
      $id = $article['id'];
   } else {
      die('Cet article n\'existe pas !');
   }
} else {
   die('Erreur');
}
?>
<!DOCTYPE html>
<html>
<head>
   <title>Accueil</title>
   <meta charset="utf-8">
</head>
<body>
    <h1><?= $titre ?></h1><p>Publiée le <?= $date_publication;?></p><br/>
    <img src="Avatar/<?= $id ?>.jpg" width="400" />
   <p><?= $contenu ?></p>
</body>
</html>
