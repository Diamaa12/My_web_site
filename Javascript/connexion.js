function verifie(){
  var pseudo = document.forms['formulaire']['pseudo'];
  var mail = document.forms['formulaire']['mail'];
  var mail2 = document.forms['formulaire']['mail2'];
  var mdp = document.forms['formulaire']['mdp'];
  var mdp2 = document.forms['formulaire']['mdp2'];

  console.log(pseudo.value, mail.value, mdp.value);
}
