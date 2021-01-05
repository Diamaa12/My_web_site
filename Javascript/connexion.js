
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
    span.style.color = '#c50000';
    return false;
  }
  console.log(psd);
  console.log(psw);
  return true;
}
