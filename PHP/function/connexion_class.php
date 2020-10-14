<?php 
include_once 'function.php';

class connexion{
    
    private $_pseudo; 
    private $_mdp;
    private $_bdd;
    
    public function __construct($pseudo, $mdp) {
        $this->_pseudo = htmlspecialchars($pseudo);
        $this->_mdp = htmlspecialchars($mdp);
        $this->_bdd = bdd();
    }
    
    public function verif(){
        
        
        $requete1 = $this->_bdd->prepare('SELECT id FROM Membres WHERE Pseudo=?');
        $requete1->execute(array($this->_pseudo));
        $resultat1 = $requete1->fetch();
        $_SESSION['id'] = $resultat1['id'];
    
        $requete = $this->_bdd->prepare('SELECT * FROM Membres WHERE Password=?');
        $requete->execute(array($_SESSION['id']));
       $resultat2 = $requete->fetch();
            
                if($resultat2){
                    $resultat = $resultat2['Password'];
                    if(password_verify($this->_mdp, $resultat)){
                        $requete2 = $this->_bdd->prepare('SELECT * FROM Membres WHERE Pseudo=?');
                        $requete2->execute(array($this->_pseudo));
                        
                        $userexist = $requete2->rowCount();
                            
                            if($userexist == 1) {
                               $userinfo = $requser->fetch();
                                $_SESSION['id'] = $userinfo['id'];
                                 $_SESSION['Pseudo'] = $userinfo['Pseudo'];
                                 return 'ok';
                                } 
                              else {
                                  $erreur = 'L\'utilisateur n\'existe pas ';
                                    return $erreur;
                              }
                              return 'ok';      
                     }                    
                    else{
                        $erreur = 'Mot de passe non identique';
                        return $erreur;
                    }
                }      
           
    }    
        
   
    
    public function session(){
        $requete = $this->_bdd->prepare('SELECT * FROM Membres WHERE Pseudo = ?');
        $requete->execute(array($this->_pseudo));
        $requete = $requete->fetch();
        $_SESSION['id'] = $requete['id'];
        $_SESSION['Pseudo'] = $this->_pseudo;
        
        return $_SESSION['Pseudo'];
    }
    
    
}