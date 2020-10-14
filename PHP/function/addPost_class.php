<?php


include_once 'function.php';

class addPost{
    
    private $_post;
    private $_name;
    private $_bdd;
    
    public function __construct($post, $postName) {
        
        
       
        $this->_name = htmlspecialchars($postName);
         $this->_post = htmlspecialchars($post);
        $this->_bdd = bdd();
        
    }
    
    
    public function verif(){
       
           if(strlen($this->_post) > 0){ /*Si on a bien un post*/
                
                return 'ok';
            }
            else {/*Si on a pas de contenu*/
                $erreur = 'Veuillez entrer le contenu du post';
                return $erreur;
            }
    }
    
  
    
    public function insert(){
      
        $requete2 = $this->_bdd->prepare('INSERT INTO postSujet(Proprio, Contenue, Sujet, Date) VALUES(:propri,:contenu,:sujet, NOW())');
        $requete2->execute(array('propri'=>$_SESSION['id'], 'contenu'=>$this->_post, 'sujet'=>$this->_name));
        
        return 1;
    }
    
}
