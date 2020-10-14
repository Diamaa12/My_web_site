<?php
session_start();
include_once '../HTML/header-page.html';

if(isset($_SESSION['Pseudo'])){

                     echo '<p align="center">Inscription effectuée avec succés <br/>Un lien de confirmation vous a été envoyer par mail<br/>'
                    . 'Veuillez visiter votre boite Email pour confirmer votre compte</p>';
    
}
include_once '../HTML/footer_page.html';

