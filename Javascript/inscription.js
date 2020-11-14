
var form = document.querySelector('#forms');
console.log(form.pseudo);

//couter la fucus du pseudo
// Validation de input pseudo
form.pseudo.addEventListener('change', function(){
  validePseudo(this);
});

//Validation de input $email
form.mail.addEventListener('change', function(){
  valideMail(this);
});

//Validation de mot passe
form.mdp.addEventListener('change', function(){
  validePassword(this);
});


//Implementation du regex pour le pseudo
const validePseudo = function(pInput){
  var regPseudo = new RegExp('^[a-zA-Z0-9]{5,15}$', 'g');

  var testPseudo = regPseudo.test(pInput.value);

  console.log(testPseudo+'1');
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
const valideMail = function(mInput){
  var regMail = new RegExp('^[a-zA-Z0-9.-_]+[@]{1}[a-zA-Z0-9._-]+[.]{1}[a-z]{2,5}$', 'g');
  var tesMail = regMail.test(mInput.value);
  console.log(tesMail+'2');

  var small = mInput.nextElementSibling;

  if (tesMail) {
    small.innerHTML = 'E-mail valide';
    small.style.color = 'green';
    small.classList.remove('text-danger');
    small.classList.add('text-success');
  }
  else {
    small.innerHTML = 'E-mail invalide';
    small.style.color = 'red';
    small.classList.remove('text-success');
    small.classList.add('text-danger');
  }
}


//Implementation du regex pour le mot de passe
const validePassword = function(pInput){
  var small = pInput.nextElementSibling;

  var regPassword = new RegExp('^[a-zA-Z0-9]{8,60}[@#%&]{1,}$');
  var testPassword = regPassword.test(pInput.value);

  if (testPassword) {
    small.innerHTML = 'Password valide';
    small.style.color = 'green';
    small.classList.remove('text-danger');
    small.classList.add('text-success');
  }
  else {
    small.innerHTML = 'Invalide password,<br/> le mot de passe doit contenir au moins 8 caractères dont 1 spècial';
    small.style.color = 'red';
    small.classList.remove('text-success');
    small.classList.add('text-danger');
    console.log('regex non valide');
  }
}

var password2 = form.mdp2;
var small = password2.nextElementSibling;
console.log(password2, small);

password2.addEventListener('change', function(){
  comparePassword(this);
});

const comparePassword = function(mdp2Input){
  var regPassword = new RegExp('^[a-zA-Z0-9]{8,60}[@#%&]{1,}$');
  var md_valide = regPassword.test(mdp2Input.value);
  if (comparePassword) {
    small.innerHTML = 'Password corespond';
    small.style.color = 'green';
    small.classList.remove('text-danger');
    small.classList.add('text-success');
  }
  else {
    small.innerHTML = 'Password no correspond';
    small.style.color = 'red';
    small.classList.remove('text-success');
    small.classList.add('text-danger');

    console.log('Test pass 2');
  }

}

password2.addEventListener('change', function(){

  if (validePassword.localeCompare(comparePassword) != 0) {
    small.innerHTML = 'Password no correspond';
    small.style.color = 'red';
    small.classList.remove('text-success');
    small.classList.add('text-danger');

    console.log('Comparaison');
  }
  else {
    small.innerHTML = 'Password corespond';
    small.style.color = 'green';
    small.classList.remove('text-danger');
    small.classList.add('text-success');
  }

});
