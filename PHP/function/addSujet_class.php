<?php

include_once 'function.php';

class addSujet{
    
    private $_sujet;
    private $_name;
    private $_categorie;
    private $_bdd;
    
    public function __construct($name, $sujet, $categorie) {
        
        
       
        $this->_name = htmlspecialchars($name);
         $this->_sujet = htmlspecialchars($sujet);
         $this->_categorie = htmlspecialchars($categorie);
        $this->_bdd = bdd();
        
    }
    
    
    public function verif(){
        if(strlen($this->_name) > 5 and strlen($this->_name) < 60){
            var_dump($this->_name);
        
           if(strlen($this->_sujet) > 0){ /*Si on a bien un sujet*/
                
                return 'ok';
            }
            else {/*Si on a pas de contenu*/
                $erreur = 'Veuillez entrer le contenu du sujet';
                return $erreur;
            }
            return 'ok';
            
        }
         else{
            $erreur = 'Le nom du sujet doit contenir entre 5 et 20 caractéres';
            return $erreur;
        }
        
       
    }
    
  
    
    public function insert(){
       
         $requete1 = $this->_bdd->prepare('INSERT INTO sujet(Nom, Categorie) VALUES(:nom, :categorie)');
         $requete1->execute(array('nom'=> $this->_name, 'categorie'=> $this->_categorie));
         
        $requete2 = $this->_bdd->prepare('INSERT INTO postSujet(Proprio, Contenue, Sujet, Date) VALUES(:propri,:contenu,:sujet, NOW())');
        $requete2->execute(array('propri'=>$_SESSION['id'], 'contenu'=>$this->_sujet, 'sujet'=>$this->_name));
        
        return 1;
    }
    
}