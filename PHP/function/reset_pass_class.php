<?php include_once 'function.php';


class Reset_pass{
  
    private $_pseudo;
    private $_mail;
    private $_db;
    
    public function __construct($mail, $user) {
        $this->_pseudo = htmlspecialchars($user);
        $this->_mail = htmlspecialchars($mail);
        $this->_db = bdd();  
    }
    
    public function verif(){
        
           $connexion = $this->_db->prepare('SELECT Pseudo, Mail FROM Membres WHERE Pseudo=? OR Mail=?');
           $connexion->execute(array($this->_pseudo , $this->_mail));
           while ($resultat = $connexion->fetch()){
               echo  $resultat['Pseudo'].$resultat['Mail'];
               $mailUser = array($resultat['Mail']);
               $pseudoUser = array($resultat['Pseudo']);
               
                 if (in_array($this->_mail, $mailUser) or in_array($this->_pseudo, $pseudoUser))
                            {
                                $_SESSION['Pseudo'] = $this->_pseudo;
                                $_SESSION['Mail'] = $this->_mail;
                                return 'ok';
                            }
                    else {
                                 
                                return'<h1>Donner renseigner non correct</h1>';
                             }
           }
   
    }

        
}