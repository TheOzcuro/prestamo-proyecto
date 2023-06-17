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


function Enviar() {
    var inputs=document.querySelectorAll('input');
    if (inputs[0].value!="" && inputs[1].value!="") {
        document.getElementById('login').submit();
    }
    else {
        alert('Existen campos vacios')
    }
}
function EnviarPass() {
    var inputs=document.querySelectorAll('input');
    if (inputs[0].value!="" && inputs[1].value!="") {
        if (inputs[0].value==inputs[1].value) {
            document.getElementById('login').submit();
        }
        else {
            alert('Las contraseñas no coinciden');
        }
       
    }
    else {
        alert('Existen campos vacios');
    }
}