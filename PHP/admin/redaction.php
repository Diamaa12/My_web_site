<?php
include_once '../function/function.php';
$bdd =bdd();
//$id = $bdd->prepare('SELECT id FROM Articles');
if(isset($_POST['article_titre'], $_POST['article_contenu'], $_POST['auteur'])) {
   if(!empty($_POST['article_titre']) AND !empty($_POST['article_contenu'])) {
      
      $article_titre = htmlspecialchars($_POST['article_titre']);
      $article_contenu = htmlspecialchars($_POST['article_contenu']);
      
      $auteur = htmlspecialchars($_POST['auteur']);
  
 
       

        
           //Traitement d'VATAR
  
   if(isset($_FILES['miniature']) AND !empty($_FILES['miniature']['name'])) {
   $tailleMax = 2097152;
   $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
   if($_FILES['miniature']['size'] <= $tailleMax) {
      $extensionUpload = strtolower(substr(strrchr($_FILES['miniature']['name'], '.'), 1));
      if(in_array($extensionUpload, $extensionsValides)) {
          $tmp_name = $_FILES['miniature']['tmp_name'];
       
         $chemin = 'Avatar/'.$_FILES['miniature']['name'];
        $image = move_uploaded_file($tmp_name, $chemin);
        if($image){
            
                
                $ins = $bdd->prepare('INSERT INTO Articles (titre, contenue, auteur, image, date_publication) VALUES (?, ?, ?,?, NOW())');
                $ins->execute(array($article_titre, $article_contenu, $auteur, $chemin));

        }
        else {
            $msg = "Une erreur au niveau de votre requete ";
        }
 
      } else {
         $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
      }
   } else {
      $msg = "Votre photo de profil ne doit pas dépasser 2Mo";
   }
}
}


   
    
    }

        else {
           $message = 'Veuillez remplir tous les champs';
        }
        
?>
<!DOCTYPE html>
<html>
<head>
   <title>Rédaction</title>
   <meta charset="utf-8">
</head>
<body>
   <form method="POST"  enctype="multipart/form-data">
       <input type="text" name="auteur" placeholder="auteur"/><br/><br/>
      <input type="text" name="article_titre" placeholder="Titre" /><br /><br />
      <input type="file" name="miniature"/><br /><br />
      <textarea name="article_contenu" placeholder="Contenu de l'article"></textarea><br /><br />
      <input type="submit" value="Envoyer l'article" />
   </form>
   <br />
      <?php if(isset($msg)) { echo $msg; } ?>
   <?php if(isset($message)) { echo $message; }
   ?>
    
   
</body>
</html>