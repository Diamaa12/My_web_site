
<!DOCTYPE html>
<html lang="fr">
   <body>
     <div id="conteneur">
<?php include_once '../HTML/header-page.html';
 include_once 'function/compteur.php';      
       ?>
		<link rel="stylesheet" href="../CSS/a_propos.css" />
    	<link href="https://fonts.googleapis.com/css?family=Libre+Franklin&display=swap" rel="stylesheet"> 
   
        <div class="item"align="center">
            <h2>À propos </h2>
            <img src="https://bombilafou.com/Images/a_propos.png" width="300" alt="photo"/>
          <h3>Qui suis-je?</h3>
            <p>Mon nom est Mamadou Diallo, je suis un passionné de  l'informatique depuis mon jeune âge, le developpement web est devenu au fil des années l'un de domaine qui m'a de plus intéressé, mes languages de programmations favories sont:</p>
              <ul>
                <li>HTML</li>
                <li>CSS</li>
                <li>JAVASCRIPT</li>
                <li>PHP</li>
                <li>MySQL</li>
              </ul>
           <p>Je compte me specialiser sur ce dernier dans les années à venir  </p>
       		<h3>Me contacter</h3><p><a href="mailto:m-cherif@bombilafou.com">E-mail: s.admin@bombilafou.com</a><br/>Tel:+49 177 69 735 </p>
    	</div>
      <?php include_once '../HTML/footer_page.html';?>
      </div>
       <script>
           var balise = document.getElementByName('li');
           balise.addEventListener('mouseover', changeCouleur);
           function changeCouleur(){
               this.style.backgroundColor = 'orange';
           }
       
       </script>
    </body>
</html>