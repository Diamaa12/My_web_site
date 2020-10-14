
/*
canvas.style.width = '13%';
canvas.style.height = '50%';
canvas.style.backgroundColor = 'orange';

var c = canvas.getContext('2d');


c.moveTo(50, 70);
c.lineTo(100, 10);
c.lineTo(150, 70);
c.lineTo(140, 70);
c.lineTo(140, 120);
c.lineTo(115, 120);
c.lineTo(115, 105);
c.lineTo(100, 105);
c.lineTo(100,120);
c.lineTo(63,120);
c.lineTo(63, 70);

c.strokeStyle = 'rgba(0, 50, 200, 0.9)';
c.stroke();
c.fillStyle = 'rgba(20, 20, 20, 0.9)';
c.fill();

var ul1 = document.getElementById('ul1');
var html = document.getElementById('html');
var header = document.getElementById('header1');
//var head = document.getElementById('head1');
var objet = header.parentNode




 var myFunction = function (){

  var div = document.createElement('div');

  div.id = 'div1';
  objet.insertBefore(div, header.nextSibling);
  div.style.position = 'relative';
  div.style.width = '100%';
  div.style.padding = '15px';
  div.style.backgroundColor = '#B1436C';

}

html.addEventListener('mouseover', myFunction);

ul1.addEventListener('click', function(){

  html.removeEventListener('mouseover',myFunction);
});

var canvas = document.getElementById('canvas');
canvas.style.backgroundColor = 'RGBa(210,10,10, 0.9)';

var c = canvas.getContext('2d');
c.fillStyle = ' #1d6397';

c.fillRect(1, 0, 200, 49);

c.fillStyle = ' #BFBFBF';
c.fillRect(201, 0, 298, 49);

c.font = 'bold 50px sans-serif';
c.fillStyle = '#BFBFBF';
c.fillText('Bombi',10, 40);

c.font = 'bold 50px  sans-serif';
c.fillStyle = '#1d6397';
c.fillText('Lafou.com',201, 40);*/
$(document).ready(function(){
    $('.menu').mouseover(function(){
        $('ul').toggleClass('active');
    })
})
