
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

function valider(){

  var psd = document.forms['formulaire']['mailconnect'];
  var psw = document.forms['formulaire']['mdpconnect'];

  var span = document.getElementById('small');

  if(psd.value == ''){
    psd.style.border = 'thick solid red';

    span.innerHTML = 'Veillez remplir le champs pseudo.';
    span.style.color = 'red';
    return false;
  }


  if (psw.value == '') {
    psw.style.border = 'thick solid red';
    span.innerHTML = 'Veillez remplir le champs mot de passe.';
    span.style.color = 'red';
    return false;
  }
  console.log(psd);
  console.log(psw);
  return true;
}
