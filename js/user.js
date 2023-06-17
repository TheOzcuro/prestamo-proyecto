var array=[];
const container_tabla=document.querySelectorAll('.container_tabla');
function Menu() {
    tablas=document.querySelectorAll(".container_tabla");
    var submenu=document.querySelector('.submenu');
    if (submenu.style.marginLeft=="" || submenu.style.marginLeft=='-280px') {
        localStorage.setItem('menu', "1");
        submenu.style.marginLeft='0px';
        for (let index = 0; index < tablas.length; index++) {
            tablas[index].style.marginLeft="0px";
            
        }
    }
    else {
        submenu.style.marginLeft='-280px';
        for (let index = 0; index < tablas.length; index++) {
            tablas[index].style.marginLeft="-200px";
        }
        localStorage.removeItem('menu')
    }
    
}

function Onload() {
    var submenu=document.querySelector('.submenu');
    tablas=document.querySelectorAll(".container_tabla");
    if (localStorage.getItem('menu')=="1") {
        submenu.style.marginLeft='0px';
    }
    else {
        for (let index = 0; index < tablas.length; index++) {
            tablas[index].style.marginLeft="-200px";
        }
    }
    document.querySelector(localStorage.getItem('container')).style.display='grid';
}
function formatDate() {
    var d = new Date,
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}

function AñadirEquipo() {
    if (document.getElementById('clase_select').value!="" && document.getElementById('cantidad').value!=0) {
        const indice=document.getElementById('clase_select').selectedIndex;
        document.getElementById(indice).hidden=true;
        var id_equipo=document.getElementById('clase_select').value+" "+document.getElementById('cantidad').value;
        var texto=document.getElementById(indice).innerHTML;
        const div= document.createElement('div');
        div.innerHTML="Nombre: "+texto+" Cantidad: "+document.getElementById('cantidad').value;
        div.id=id_equipo;
        div.title='Has click para eliminar';
        div.addEventListener("click", function(){ RemoveEquipo(id_equipo, indice); });
        document.getElementById('clase_select').value="";
        document.getElementById('cantidad').value=0;
        document.querySelector('.container_equipos').appendChild(div);
    }
    else {
        alert("Elija por favor la clase y ponga una cantidad");
    }
   
}
function AgruparEquipo() {
    var div=document.querySelector('.container_equipos').querySelectorAll('div');
    var agrupar="";
    var equipo='';
    var cantidad='';
   for (let index = 0; index < div.length; index++) {
        agrupar="";
        if (index==0) {
            agrupar=div[index].id.split(" ");
            equipo=agrupar[0];
            cantidad=agrupar[1];
        }
        else {
            agrupar=div[index].id.split(" ");
            equipo=agrupar[0]+","+equipo;
            cantidad=agrupar[1]+","+cantidad;
        }
    
   }
   document.getElementById("equipos_texto").value=equipo;
   document.getElementById("equipos_cantidad").value=cantidad;
   console.log(document.getElementById("equipos_texto").value);
   console.log(document.getElementById("equipos_cantidad").value);
}

function RemoveEquipo(id, indice) {
    document.getElementById(id).remove();
    document.getElementById(indice).hidden=false;
}

function RegistrarSolicitud() {
    var input=document.querySelectorAll('.registrar_input');
    console.log(input);
    var div=document.querySelector('.container_equipos').querySelectorAll('div');
    var todayDate = formatDate();
    if (input[0].value!="" && input[1].value!="" && input[2].value!="" && input[3].value!="" && input[4].value!="" && input[5].value!="" && div.length>0) {
        if (input[0].value>todayDate) {
            document.getElementById('fecha_hoy').value=todayDate;
            document.getElementById('cantidad').disabled=false;
            AgruparEquipo();
            document.querySelector('#prestamo').submit();
        }
        else {
            alert("La fecha de uso tiene que ser mayor al a fecha actual");
        }
            

        
        
    }
    else {
        alert("Existen campos vacios, por favor rellenelos")
    }
}
function Check(numero, check, input) {
    console.log
    if (check.checked) {
        document.getElementById(input).disabled=true;
        document.getElementById(input).value=array[numero];
    }
    else {
        document.getElementById(input).disabled=false;
        document.getElementById(input).value="";
    }
}
document.getElementById('boton_usuario').addEventListener('click', function() {
    for (let index = 0; index < container_tabla.length; index++) {
        container_tabla[index].style.display="none";
    }
    document.querySelector('#prestamo-container').style.display='grid';
    localStorage.setItem('container', "#prestamo-container");
})
document.getElementById('boton_grupo').addEventListener('click', function() {
    for (let index = 0; index < container_tabla.length; index++) {
        container_tabla[index].style.display="none";
    }
    document.querySelector('.tabla_prestamo').style.display='block';
    localStorage.setItem('container', ".tabla_prestamo");
})
function Vermas(...args) {
    parrafos=document.querySelectorAll('.parrafo');
    console.log(args);
    document.querySelector(".informacion_container").style.display='grid';
    for (let index = 0; index < args.length; index++) {
        if (index==10 && args[index]==0) {
            parrafos[index].innerHTML="Rechazado";
        }
        else if (index==10 && args[index]==1) {
            parrafos[index].innerHTML="Pendiente";
        }
        else if (index==10 && args[index]==2) {
            parrafos[index].innerHTML="En Prestamo";
        }
        else if (index==10 && args[index]==3) {
            parrafos[index].innerHTML="Devuelto";
        }
        else {
            parrafos[index].innerHTML=args[index];
        }
        
    }
}
function Cerrar() {
    document.querySelector(".informacion_container").style.display='none';
    parrafos=document.querySelectorAll('.parrafo');
    for (let index = 0; index < args.length; index++) {
        parrafos[index].innerHTML="";
    }
}
document.querySelector('#img_user').addEventListener('click', function() {
    if (document.getElementById('cantidad').value!=0) {
        var numero=parseInt(document.getElementById('cantidad').value);
        var total=numero-1;
        document.getElementById('cantidad').value=total;
    }
    else {
        alert('La cantidad no puede ser menor a 0');
    }
    
})
document.querySelector('#img_add').addEventListener('click', function() {
    console.log(document.getElementById('cantidad').value);
    const indice=document.getElementById('clase_select').selectedIndex;
    var option=document.getElementById(indice);
    if (indice!="") {
        if (option.className!="" && document.getElementById('cantidad').value<option.className) {
            var numero=parseInt(document.getElementById('cantidad').value);
            var total=numero+1;
            document.getElementById('cantidad').value=total;
        }
        else {
            alert('La cantidad no puede ser mayor a '+option.className);
        }
    }
    else {
        alert('Nececita primero escoger la clase de equipo que quiere')
    }
   
    
})
Onload();