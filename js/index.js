var parrafo
var lista
parrafo=document.querySelectorAll('.parrafo_container');
lista=document.querySelectorAll('li');

lista[0].addEventListener('click', function() {
    parrafo[0].style.display='block';
    parrafo[1].style.display='none';
    parrafo[2].style.display='none';
})
lista[1].addEventListener('click', function() {
    parrafo[2].style.display='block';
    parrafo[0].style.display='none';
    parrafo[1].style.display='none';
})
lista[2].addEventListener('click', function() {
    parrafo[1].style.display='block';
    parrafo[0].style.display='none';
    parrafo[2].style.display='none';
})