
var form = document.querySelector('#forms');
console.log(form.pseudo);

//couter la fucus du pseudo
// Validation de input pseudo
form.pseudo.addEventListener('change', function(){
  validePseudo(this);
});

//Validation de input $email
form.mail.addEventListener('change', function(){
  validePseudo(this);
});

//Validation de mot passe
form.mdp.addEventListener('change', function(){
  validePseudo(this);
});


//Implementation du regex pour le pseudo
const validePseudo = function(pInput){
  var regPseudo = new RegExp('^[a-zA-Z0-9]{5,15}$', 'g');

  var testPseudo = regPseudo.test(pInput.value);

  console.log(testPseudo);
  var small = pInput.nextElementSibling;
  if (testPseudo) {
    small.innerHTML = 'Pseudo valide';
    small.style.color = 'green';
    small.classList.remove('text-danger');
    small.classList.add('text-success');
  }
  else {
    small.innerHTML = 'Pseudo invalide';
    small.style.color = 'red';
    small.classList.remove('text-success');
    small.classList.add('text-danger');
  }

}

//Implementation du regex pour l'$email


//Implementation du regex pour le mot de passe