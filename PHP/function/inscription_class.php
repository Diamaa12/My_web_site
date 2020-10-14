<?php
include_once 'function.php';
class inscription_class{
    private $_pseudo;
    private $_mail;
    private $_confmail;
    private $_password;
    private $_confpass;
    private $_key;
    
    private $_db;


    public function __construct ($user, $email, $confMail,  $password, $confpass){
        $pseudo = htmlspecialchars($user);
         $mail = htmlspecialchars($email);
         $confMail = htmlspecialchars($confMail);
         $password = htmlspecialchars($password);
         $confpass = htmlspecialchars($confpass);
         
         $this->_pseudo = $pseudo;
         $this->_mail = $mail;
         $this->_confmail = $confMail;
         $this->_password = $password;
         $this->_confpass = $confpass;
         $this->_db = bdd();
         
        
         
        
    }
    
    
    public function verifie(){
            if(strlen($this->_pseudo) > 5 and strlen($this->_pseudo) < 20){
               
                if($this->_mail == $this->_confmail){
                    if(strlen($this->_password) > 5 and $this->_password == $this->_confpass){
                         if(filter_var($this->_mail, FILTER_VALIDATE_EMAIL)) {
                            $reqmail = $this->_db->prepare("SELECT * FROM Membres WHERE Mail = ?");
                            $reqmail->execute(array($this->_mail));
                            $mailexist = $reqmail->rowCount();
                                    if($mailexist == 0) {
                                        return 'ok';
                                    }
                                else {
                                        $erreur = "Adresse mail déjà utilisée !";
                                        return $erreur;
                                    }
                                 return 'ok';
                            }
                            else{
                                $erreur = 'Adresse email non valide';
                                return $erreur;
                            }
                            return 'ok';
                           
                        }
                        else {
                            $erreur = 'Mot de passe falsch';
                            return  $erreur;
                        }
                        return 'ok';
                    }
                else {
                    $erreur = 'Vos mails ne correspond pas';
                    return $erreur;
                }
             return 'ok';
            } 
        else {
            $erreur = 'Le pseudo doit contenir entre 6 et 20 caractéres';
             return $erreur;
            }
        
    }
    
    public function enregistrement($key){
        //$date = date('d/m/Y H:i:s');;
        $this->_key = $key;
                     $passHashed = password_hash($this->_password, PASSWORD_BCRYPT);
                    $requete = $this->_db->prepare('INSERT INTO Membres(Pseudo, Mail, Password, confirme_key, confirme_user, Date) VALUES(?, ?, ?,?, 0, NOW())');
                    $requete->execute(array(
                     $this->_pseudo,
                     $this->_mail,
                     $passHashed,
                      $this->_key
                    
                     
            ));
     
        return $this->_key;
    }
    
    public function session()
    {
        $requete = $this->_db->prepare('SELECT id FROM Membres WHERE Pseudo = :Pseudo');
        $requete->execute(array('Pseudo' => $this->_pseudo));
        $requete = $requete->fetch();
        $_SESSION['id'] = $requete['id'];
        $_SESSION['Pseudo'] = $this->_pseudo;
        
       
        return $_SESSION['Pseudo'];;
    }
}
