
/*var valider = document.getElementsByClassName('soumet');


var pseudo = document.getElementById('psd');
var pass = document.getElementById('pwd');

function alerter() {
  if (!pseudo.value && !pass.value) {
    var small document.getElementById('small');
    small.innerHTML = 'Veillez remplir tout le champs.';
    small.style.color = 'red';
  }
}

for (var i = 0; i < valider.length; i++) {
  valider[i].addEventListener("click", alerter, false);
}
*/

function afficher(){

  var pseudo = document.forms['formulaire']['pseudo'];
  var mail = document.forms['formulaire']['mail'];
  var mail2 = document.forms['formulaire']['mail2'];
  var password = document.forms['formulaire']['mdp'];
  var password2 = document.forms['formulaire']['mdp2'];

  console.log(pseudo, mail);
  return true;
}
