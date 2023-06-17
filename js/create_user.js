function KeyTexto() {
    var x=new RegExp("[A-Za-z-ñ]+")
    if (x.test(event.key)) {
    }
    else {
        event.preventDefault();
    }
}
function KeyVarchar() {
    var x=new RegExp("[0-9-A-Za-z-ñ]+")
    if (x.test(event.key)) {
    }
    else {
        event.preventDefault();
    }
}
function KeyNumeros() {
    var x=new RegExp("[0-9]+")
    if (x.test(event.key)) {
    }
    else {
        event.preventDefault();
    }
}
var input=document.querySelectorAll('input');

input[0].addEventListener('keypress',KeyNumeros);
input[1].addEventListener('keypress',KeyTexto);
input[2].addEventListener('keypress',KeyTexto);
input[3].addEventListener('keypress',KeyVarchar);
input[4].addEventListener('keypress',KeyVarchar);
function Send() {
    if (input[0].value!="" && input[1].value!="" && input[2].value!="" && input[3].value!="" && input[4].value!="" && input[3].value==input[4].value) {
        document.getElementById('crear').submit();
    }
    else if (input[0].value!="" && input[1].value!="" && input[2].value!="" && input[3].value!="" && input[4].value!="" && input[3].value!=input[4].value) {
        alert('Las contraseñas no coinciden');
    }
    else {
        alert('Existen campos vacios por favor verifique')
    }
}