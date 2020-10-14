function afficher(){
  var pseudo = document.forms['formulaire']['pseudo'];
  var mail = document.forms['formulaire']['mail'];
  var mail2 = document.forms['formulaire']['mail2'];
  var mdp = document.forms['formulaire']['mdp'];
  var mdp2 = document.forms['formulaire']['mdp2'];

  alert(pseudo.value, mail.value, mdp.value);
}
var rest = 5;
while (rest<15) {
  console.console.log(rest);
  rest+=1;
}
