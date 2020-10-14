<?php session_start();
include_once 'function/function.php';
$bdd = bdd();
$password = !empty($_POST['pass'])? $_POST['pass']:"";
$rePassword = !empty($_POST['repass'])? $_POST['repass']:"";
    if(isset($password, $rePassword, $_POST['submit'])){

        if($password == $rePassword){
            $passHashed = password_hash($password, PASSWORD_BCRYPT);
            $connexion = $bdd->prepare('UPDATE Membres SET Password=? WHERE Pseudo=? ');
            $connexion->execute(array($passHashed, $_SESSION['Pseudo']));

            echo $_SESSION['Pseudo'];
            header('Location:http://localhost/Sites/NzereInfo/PHP/index.php');

        }
         else {
            echo 'Les mot de passe ne sont pas identique';
        }
    } 
 else {
        echo 'Veillez remplir les champs ';
}
?>

<form  method="post" action="newpass.php">
    <input type="password" name="pass" placeholder="Nouveau mot de passe..."/><br/>
    <input type="password" name="repass" placeholder="Repeter le mot de passe..."/><br/>
                <input type="submit" name="submit"value="Soumettre">
            </form>
