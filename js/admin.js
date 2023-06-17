var array=[];
var arrayPrestamo=[];
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
    document.querySelector(localStorage.getItem('container')).style.display='block';
}
function Update(cedula,nombre,apellido,rol) {

    document.querySelector('#registrar_usuario_container').style.display='block';
    array=[cedula,nombre,apellido,rol];
    const check=document.querySelectorAll('.checkbox');
    for (let index = 0; index < 4; index++) {
        check[index].style.visibility ='visible';
        check[index].checked = true;
    }
    cedula=document.getElementById('cedula_usuario').value=array[0];
    document.getElementById('cedula_usuario').disabled=true;
    nombre=document.getElementById('nombre_usuario').value=array[1];
    document.getElementById('nombre_usuario').disabled=true;
    apellido=document.getElementById('apellido_usuario').value=array[2];
    document.getElementById('apellido_usuario').disabled=true;
    correo=document.getElementById('rol').value=array[3];
    document.getElementById('rol').disabled=true;
}
function UpdateEquipos(codigo_equ,codigo_bien,nombre_equ,estado,grupo,clase) {

    document.querySelector('#registrar_equipos_container').style.display='block';
    array=[codigo_equ,codigo_bien,nombre_equ,estado,grupo,clase];
    const check=document.querySelectorAll('.checkbox');
    for (let index = 0; index < check.length; index++) {
        check[index].style.visibility ='visible';
        check[index].checked = true;
    }
    
    cedula=document.getElementById('codigo_equipo').value=array[0];
    document.getElementById('codigo_equipo').disabled=true;
    nombre=document.getElementById('codigo_bienes').value=array[1];
    document.getElementById('codigo_bienes').disabled=true;
    apellido=document.getElementById('nombre_equipo').value=array[2];
    document.getElementById('nombre_equipo').disabled=true;
    correo=document.getElementById('estado').value=array[3];
    document.getElementById('estado').disabled=true;
    grupo=document.getElementById('grupo').value=array[4];
    document.getElementById('grupo').disabled=true;
    clase=document.getElementById('clase_select').value=array[5];
    document.getElementById('clase_select').disabled=true;
}
function UpdateGrupo(codigo_grupo,nombre_grupo) {

    document.querySelector('#registrar_grupo_container').style.display='block';
    array=[codigo_grupo,nombre_grupo];
    const check=document.querySelectorAll('.checkbox');
    for (let index = 0; index < check.length; index++) {
        check[index].style.visibility ='visible';
        check[index].checked = true;
    }
    cedula=document.getElementById('codigo_grupo').value=array[0];
    document.getElementById('codigo_grupo').disabled=true;
    nombre=document.getElementById('nombre_grupo').value=array[1];
    document.getElementById('nombre_grupo').disabled=true;
}
function Registrar() {
    var cedula=document.getElementById('cedula_usuario').value;
    var nombre=document.getElementById('nombre_usuario').value;
    var apellido=document.getElementById('apellido_usuario').value;
    var rol=document.getElementById('rol').value;
    if (cedula!="" && nombre!="" && apellido!="" && rol!="") {
        if (array.length>0) {
            if (cedula!=array[0] || nombre!=array[1] || apellido!=array[2] || rol!=array[3] ) {
                document.getElementById('cedula_original').value=array[0];
                document.querySelector('#registrar').action='../control/c_modificar.php';
                const input=document.querySelectorAll('.registrar_input');
                for (let index = 0; index < input.length; index++) {
                    input[index].disabled= false
                }
                document.querySelector('#registrar').submit();
            }
            else {
                alert("Debe ser algun cambio para modificar");
            }
        }
        else {
            document.querySelector('#registrar').submit();
        }
        
    }
    else {
        alert("Existen campos vacios, por favor rellenelos")
    }
}
function RegistrarEquipo() {
    var codigo_equipo=document.getElementById('codigo_equipo').value;
    var codigo_bien=document.getElementById('codigo_bienes').value;
    var nombre_equipo=document.getElementById('nombre_equipo').value;
    var estado=document.getElementById('estado').value;
    var grupo=document.getElementById('grupo').value;
    var clase=document.getElementById('clase_select').value;
    if (codigo_equipo!="" && nombre_equipo!="" && estado!="" && clase!="") {
        if (array.length>0) {
            if (codigo_equipo!=array[0] || codigo_bien!=array[1] || nombre_equipo!=array[2] || estado!=array[3] || grupo!=array[4] || clase!=array[5]) {
                document.getElementById('codigo_original').value=array[0];
                document.querySelector('#registrar_equipo').action='../control/c_modificarEquipo.php';
                const input=document.querySelectorAll('.registrar_input');
                for (let index = 0; index < input.length; index++) {
                    input[index].disabled= false
                }
                document.querySelector('#registrar_equipo').submit();
            }
            else {
                alert("Debe ser algun cambio para modificar");
            }
        }
        else {
           document.querySelector('#registrar_equipo').submit();
        }
        
    }
    else {
        alert("Existen campos vacios, por favor rellenelos")
    }
}


function RegistrarSalon() {
    var actividad=document.getElementById('salon_inf').value;
    if (actividad!="") {
        if (array.length>0) {
            if (actividad!=array[1]) {
                document.getElementById('id_salon').value=array[0];
                document.querySelector('#salon_form').action='../control/c_modificarSalon.php';
                const input=document.querySelectorAll('.registrar_input');
                for (let index = 0; index < input.length; index++) {
                    input[index].disabled= false
                }
                document.getElementById('salon_form').submit();
            }
            else {
                alert("Tiener que hacer algun cambio")
            }
        }   
        else {
            document.getElementById('salon_form').submit();
        }
       
    }
    else {
        alert('Hay un campo vacio por favor rellenelo')
    }
}


function UpdateSalon(id, salon) {
    document.querySelector('#salon_form_container').style.display='block';
    array=[id,salon];
    const check=document.querySelectorAll('.checkbox');
    for (let index = 0; index < check.length; index++) {
        check[index].style.visibility ='visible';
        check[index].checked = true;
    }
    nombre=document.getElementById('salon_inf').value=array[1];
    document.getElementById('salon_inf').disabled=true;
}


function EliminarSalon(id) {
    document.getElementById('id_salon').value=id;
    document.querySelector('#salon_form').action='../control/c_eliminarSalon.php';
    document.getElementById('salon_form').submit();
}

function EliminarClase(id) {
    document.getElementById('id_clase').value=id;
    document.querySelector('#clase_form').action='../control/c_eliminarClase.php';
    document.getElementById('clase_form').submit();
}

function RegistrarActividad() {
    var actividad=document.getElementById('actividad_inf').value;
    if (actividad!="") {
        if (array.length>0) {
            if (actividad!=array[1]) {
                document.getElementById('id').value=array[0];
                document.querySelector('#actividad_form').action='../control/c_update_actividad.php';
                const input=document.querySelectorAll('.registrar_input');
                for (let index = 0; index < input.length; index++) {
                    input[index].disabled= false
                }
                document.getElementById('actividad_form').submit();
            }
            else {
                alert("Tiener que hacer algun cambio")
            }
        }   
        else {
            document.getElementById('actividad_form').submit();
        }
       
    }
    else {
        alert('Hay un campo vacio por favor rellenelo')
    }
}
function RegistrarClase() {
    var clase=document.getElementById('clase_inf').value;
    if (clase!="") {
        if (array.length>0) {
            if (clase!=array[1]) {
                document.getElementById('id_clase').value=array[0];
                document.querySelector('#clase_form').action='../control/c_modificarClase.php';
                const input=document.querySelectorAll('.registrar_input');
                for (let index = 0; index < input.length; index++) {
                    input[index].disabled= false
                }
                document.getElementById('clase_form').submit();
            }
            else {
                alert("Tiener que hacer algun cambio")
            }
        }   
        else {
            document.getElementById('clase_form').submit();
        }
       
    }
    else {
        alert('Hay un campo vacio por favor rellenelo')
    }
}


function UpdateActividad(id, actividad) {
    document.querySelector('#actividad_form_container').style.display='block';
    array=[id,actividad];
    const check=document.querySelectorAll('.checkbox');
    for (let index = 0; index < check.length; index++) {
        check[index].style.visibility ='visible';
        check[index].checked = true;
    }
    nombre=document.getElementById('actividad_inf').value=array[1];
    document.getElementById('actividad_inf').disabled=true;
}
function UpdateClase(id, actividad) {
    document.querySelector('#clase_form_container').style.display='block';
    array=[id,actividad];
    const check=document.querySelectorAll('.checkbox');
    for (let index = 0; index < check.length; index++) {
        check[index].style.visibility ='visible';
        check[index].checked = true;
    }
    nombre=document.getElementById('clase_inf').value=array[1];
    document.getElementById('clase_inf').disabled=true;
}
function EliminarActividad(id) {
    document.getElementById('id').value=id;
    document.querySelector('#actividad_form').action='../control/c_eliminarActividad.php';
    document.getElementById('actividad_form').submit();
}
function AñadirEquipo() {
    const indice=document.getElementById('equipo_prestamo').selectedIndex;
    document.getElementById(indice).hidden=true;
    var id_equipo=document.getElementById('equipo_prestamo').value;
    var texto=document.getElementById(indice).innerHTML;
    const div= document.createElement('div');
    div.innerHTML=texto;
    div.id=id_equipo;
    div.title='Has click para eliminar';
    div.addEventListener("click", function(){ RemoveEquipo(id_equipo, indice); });
    document.getElementById('equipo_prestamo').value="";
    document.querySelector('.container_equipos_añadidos').appendChild(div);
}
function AgruparEquipo() {
    var div=document.querySelector('.container_equipos_añadidos').querySelectorAll('div');
   var agrupar="";
   for (let index = 0; index < div.length; index++) {
        if (index==0) {
            agrupar=div[index].id;
        }
        else {
            agrupar=agrupar+","+div[index].id;
        }
    
   }
   document.getElementById("agrupar_equipo").value=agrupar;
}
function RemoveEquipo(id, indice) {
    document.getElementById(id).remove();
    document.getElementById(indice).hidden=false;
}
function RegistrarGrupo() {
    var codigo_equipo=document.getElementById('codigo_grupo').value;
    var nombre_equipo=document.getElementById('nombre_grupo').value;
    if (codigo_equipo!="" && nombre_equipo!="") {
        if (array.length>0) {
            if (codigo_equipo!=array[0] || nombre_equipo!=array[1]) {
                document.getElementById('codigo_original_grupo').value=array[0];
                document.querySelector('#registrar_grupo').action='../control/c_modificarGrupo.php';
                const input=document.querySelectorAll('.registrar_input');
                for (let index = 0; index < input.length; index++) {
                    input[index].disabled= false
                }
                document.querySelector('#registrar_grupo').submit();
            }
            else {
                alert("Debe ser algun cambio para modificar");
            }
        }
        else {
            document.querySelector('#registrar_grupo').submit();
        }
        
    }
    else {
        alert("Existen campos vacios, por favor rellenelos")
    }
}
function Modificar() {
    if (cedula!="" && nombre!="" && apellido!="" && correo!="") {
        if (cedula!=array[0] || nombre!=array[1] || apellido!=array[2] || correo!=array[3] ) {
            document.querySelector('#registrar').action='../control/c_modificar.php';
            document.querySelector('#registrar').submit();
        }
        else {
            alert("Debe ser algun cambio para modificar");
        }
        
    }
    else {
        alert('Existen campos vacios');
    }
}
function OrdenarEquipo(valor) {
    var nuevo="";
    nuevo=valor.split(",");
    for (let index = 0; index < nuevo.length; index++) {
        const div= document.createElement('div');
        var equipo = nuevo[index].split(".");
        div.innerHTML=equipo[0]+" ";
        div.title=equipo[1];
        div.style.display="inline";
        document.getElementById('equipo_entregado').appendChild(div);
    }

}
function Vermas(...args) {
    arrayPrestamo=args;
    parrafos=document.querySelectorAll('.parrafo');
    document.querySelector(".informacion_container").style.display='grid';
    var contador=args.length;
    contador=contador-1
    OrdenarEquipo(args[0]);
    console.log(args);
    for (let index = 1; index < contador; index++) {
        if (index==11 && args[index]==0) {
            parrafos[index].innerHTML="Rechazado";
            document.getElementById('asigar_equipo').style.display='none';
            document.getElementById('devolver').style.display='none';
            document.getElementById('rechazar').style.display='none';
            document.getElementById('eliminar').style.display='none';
        }
        else if (index==11 && args[index]==1) {
            parrafos[index].innerHTML="Pendiente";
            document.getElementById('asigar_equipo').style.display='block';
            document.getElementById('rechazar').style.display='block';
            document.getElementById('devolver').style.display='none';
            document.getElementById('eliminar').style.display='none';
        }
        else if (index==11 && args[index]==2 && args[2]!="") {
            parrafos[index].innerHTML="En Prestamo";
            document.getElementById('asigar_equipo').style.display='none';
            document.getElementById('eliminar').style.display='none';
            document.getElementById('rechazar').style.display='none';
            document.getElementById('cancelar').style.display='block';
            document.getElementById('devolver').style.display='block';
        }
        else if (index==11 && args[index]==2 && args[2]=="") {
            parrafos[index].innerHTML="Aprobado";
            document.getElementById('asigar_equipo').style.display='none';
            document.getElementById('eliminar').style.display='none';
            document.getElementById('rechazar').style.display='none';
            document.getElementById('cancelar').style.display='block';
            document.getElementById('entregar').style.display='block';
            document.getElementById('devolver').style.display='none';
        }
        else if (index==11 && args[index]==3) {
            parrafos[index].innerHTML="Devuelto";
            document.getElementById('asigar_equipo').style.display='none';
            document.getElementById('devolver').style.display='none';
            document.getElementById('rechazar').style.display='none';
            document.getElementById('eliminar').style.display='none';
        }
        else if (index==15 && args[index]==0) {
            parrafos[index].innerHTML=''
        }
        else if (index==15 && args[index]==1) {
            parrafos[index].innerHTML='Director/a'
        }
        else {
            parrafos[index].innerHTML=args[index];
        }
        
    }
}
function VentanaRechazar(container){
 document.querySelector('.blackcover').style.display='block';
 document.querySelector(container).style.display='block';
 if (container==".asigar_equipo") {
    document.querySelector(".equipo_asignado").innerHTML=arrayPrestamo[7];
 }
}
function Rechazar() {
    document.getElementById('cedula_pendiente').value=arrayPrestamo[16];
    document.getElementById('form_pendiente').submit();
}
function Devolver() {
    console.log(arrayPrestamo);
    document.getElementById('cedula_devuelto').value=arrayPrestamo[16];
    document.getElementById('equipo_devuelto').value=arrayPrestamo[17];
    document.getElementById('fecha_devuelto').value=formatDate();
    document.getElementById('form_devuelto').submit();
}
function Entregar() {
    console.log(arrayPrestamo);
    document.getElementById('cedula_entregado').value=arrayPrestamo[16];
    document.getElementById('cedula_entregado_solicitante').value=arrayPrestamo[12];
    document.getElementById('fecha_entregado').value=formatDate();
    document.getElementById('form_entregado').submit();
}
function Aprobar() {
    console.log(arrayPrestamo);
    document.getElementById('cedula_aprobado').value=arrayPrestamo[16];
    document.getElementById('cedula_solicitante').value=arrayPrestamo[12];
    document.getElementById('fecha_de_uso').value=arrayPrestamo[4];
    document.getElementById('fecha_aprobado').value=formatDate();
    AgruparEquipo();
    if (document.getElementById('agrupar_equipo').value!="") {
        document.getElementById('form_aprobado').submit();
    }
    else {
        alert("Tiene que elegir un equipo para realizar el prestamo")
    }
}
function PDFusuario(cedula) {
    document.getElementById('cedula_usuario').value=cedula;
    document.getElementById('registrar').action='usuarioPDF.php';
    document.getElementById('registrar').submit();
}
function PDFUsuarioPendiente(cedula) {
    document.getElementById('cedula_pendiente').value=cedula;
    document.getElementById('form_pendiente').action='solicitudes_pendientePDF.php';
    document.getElementById('form_pendiente').submit();
}
function PDFUsuarioFecha(form) {
    document.getElementById(form).submit();
}
function VentanaRechazarCerrar(container){
    document.querySelector('.blackcover').style.display='none';
    document.querySelector(container).style.display='none';
   }
function Cerrar() {
    document.querySelector(".informacion_container").style.display='none';
    parrafos=document.querySelectorAll('.parrafo');
    div=parrafos[0].querySelectorAll('div');
    for (let index = 0; index < div.length; index++) {
        div[index].remove();
    }
}
function Check(numero, check, input) {
    console.log
    if (check.checked) {
        document.getElementById(input).disabled=true;
        document.getElementById(input).value=array[numero];
    }
    else {
        if (document.getElementById(input).value=="prestamo") {
            if (numero==3) {    
                alert("El equipo se encuentra en prestamo no puede cambiarle el estado");
                document.getElementById(input).disabled=true;
                check.checked=true;
            }
            else {
                document.getElementById(input).disabled=false;
                document.getElementById(input).value="";
            }
        }
        else {
            document.getElementById(input).disabled=false;
            document.getElementById(input).value="";
        }
        
        
        
    }
}
function Eliminar(cedula) {
    document.querySelector('#registrar').action='../control/c_eliminar.php';
    document.getElementById('cedula_usuario').value=cedula;
    document.querySelector('#registrar').submit();
}
function EliminarEquipos(codigo) {
    document.querySelector('#registrar_equipo').action='../control/c_eliminarEquipo.php';
    document.getElementById('codigo_equipo').value=codigo;
    document.querySelector('#registrar_equipo').submit();
}
function EliminarGrupo(codigo) {
    document.querySelector('#registrar_grupo').action='../control/c_eliminarGrupo.php';
    document.getElementById('codigo_grupo').value=codigo;
    document.querySelector('#registrar_grupo').submit();
}
document.getElementById('actividad').addEventListener('click', function() {
    for (let index = 0; index < container_tabla.length; index++) {
        container_tabla[index].style.display="none";
    }
    document.querySelector('.tabla_actividad').style.display='block';
    localStorage.setItem('container', ".tabla_actividad");
})
document.getElementById('clase').addEventListener('click', function() {
    for (let index = 0; index < container_tabla.length; index++) {
        container_tabla[index].style.display="none";
    }
    document.querySelector('.tabla_clase').style.display='block';
    localStorage.setItem('container', ".tabla_clase");
})
document.getElementById('salon').addEventListener('click', function() {
    for (let index = 0; index < container_tabla.length; index++) {
        container_tabla[index].style.display="none";
    }
    document.querySelector('.tabla_salon').style.display='block';
    localStorage.setItem('container', ".tabla_salon");
})
document.getElementById('boton_usuario').addEventListener('click', function() {
    for (let index = 0; index < container_tabla.length; index++) {
        container_tabla[index].style.display="none";
    }
    document.querySelector('.tabla_usuario').style.display='block';
    localStorage.setItem('container', ".tabla_usuario");
})
document.getElementById('boton_equipo').addEventListener('click', function() {
    for (let index = 0; index < container_tabla.length; index++) {
        container_tabla[index].style.display="none";
    }
    document.querySelector('.tabla_equipo').style.display='block';
    localStorage.setItem('container', ".tabla_equipo");
})
document.getElementById('boton_grupo').addEventListener('click', function() {
    for (let index = 0; index < container_tabla.length; index++) {
        container_tabla[index].style.display="none";
    }
    document.querySelector('.tabla_grupo').style.display='block';
    localStorage.setItem('container', ".tabla_grupo");
})
document.getElementById('solicitudes_prestamo').addEventListener('click', function() {
    for (let index = 0; index < container_tabla.length; index++) {
        container_tabla[index].style.display="none";
    }
    document.querySelector('#tabla_pendiente').style.display='block';
    localStorage.setItem('container', "#tabla_pendiente");
})
document.getElementById('prestamo_activo').addEventListener('click', function() {
    for (let index = 0; index < container_tabla.length; index++) {
        container_tabla[index].style.display="none";
    }
    document.querySelector('#tabla_aprobado').style.display='block';
    localStorage.setItem('container', "#tabla_aprobado");
})
document.getElementById('prestamo_devuelto').addEventListener('click', function() {
    for (let index = 0; index < container_tabla.length; index++) {
        container_tabla[index].style.display="none";
    }
    document.querySelector('#tabla_devuelto').style.display='block';
    localStorage.setItem('container', "#tabla_devuelto");
})
document.getElementById('solicitudes_rechazadas').addEventListener('click', function() {
    for (let index = 0; index < container_tabla.length; index++) {
        container_tabla[index].style.display="none";
    }
    document.querySelector('#tabla_rechazado').style.display='block';
    localStorage.setItem('container', "#tabla_rechazado");
})
document.querySelector('.agregar').addEventListener('click', function () {
    document.querySelector('#registrar_usuario_container').style.display='block';
})
document.querySelector('.agregar_equipo').addEventListener('click', function () {
    document.querySelector('#registrar_equipos_container').style.display='block';
})
document.querySelector('.agregar_grupo').addEventListener('click', function () {
    document.querySelector('#registrar_grupo_container').style.display='block';
})
document.querySelector('.agregar_actividad').addEventListener('click', function () {
    document.querySelector('#actividad_form_container').style.display='block';
})
document.querySelector('.agregar_clase').addEventListener('click', function () {
    document.querySelector('#clase_form_container').style.display='block';
})
document.querySelector('#agregar_salon').addEventListener('click', function () {
    document.querySelector('#salon_form_container').style.display='block';
})
document.querySelector('#equipo_prestamo').addEventListener('change', function () {
    console.log()
})
document.querySelector('.cerrar').addEventListener('click', function () {
    const check=document.querySelectorAll('.checkbox');
    for (let index = 0; index < 4; index++) {
        check[index].style.visibility ='hidden';
        check[index].checked = false;
    }
    document.querySelector('#registrar').action='../control/c_registrar.php';
    document.querySelector('#registrar_usuario_container').style.display='none';
    const input=document.querySelectorAll('.registrar_input');
        for (let index = 0; index < input.length; index++) {
        input[index].value="";
        input[index].disabled=false;
    }
    array=[];
})
document.querySelector('.cerrar_equipo').addEventListener('click', function () {
    const check=document.querySelectorAll('.checkbox');
    for (let index = 0; index < check.length; index++) {
        check[index].style.visibility ='hidden';
        check[index].checked = false;
    }
    document.querySelector('#registrar_equipo').action='../control/c_registrar_equipo.php';
    document.querySelector('#registrar_equipos_container').style.display='none';
    const input=document.querySelectorAll('.registrar_input');
        for (let index = 0; index < input.length; index++) {
        input[index].value="";
        input[index].disabled=false;
    }
    array=[];
})
document.querySelector('.cerrar_actividad').addEventListener('click', function () {
    const check=document.querySelectorAll('.checkbox');
    for (let index = 0; index < check.length; index++) {
        check[index].style.visibility ='hidden';
        check[index].checked = false;
    }
    document.querySelector('#actividad_form_container').action='../control/c_registrar_actividad.php';
    document.querySelector('#actividad_form_container').style.display='none';
    const input=document.querySelectorAll('.registrar_input');
        for (let index = 0; index < input.length; index++) {
        input[index].value="";
        input[index].disabled=false;
    }
    array=[];
})
document.querySelector('.cerrar_clase').addEventListener('click', function () {
    const check=document.querySelectorAll('.checkbox');
    for (let index = 0; index < check.length; index++) {
        check[index].style.visibility ='hidden';
        check[index].checked = false;
    }
    document.querySelector('#clase_form').action='../control/c_registrarClase.php';
    document.querySelector('#clase_form_container').style.display='none';
    const input=document.querySelectorAll('.registrar_input');
        for (let index = 0; index < input.length; index++) {
        input[index].value="";
        input[index].disabled=false;
    }
    array=[];
    console.log(array);
})
document.querySelector('.cerrar_salon').addEventListener('click', function () {
    const check=document.querySelectorAll('.checkbox');
    for (let index = 0; index < check.length; index++) {
        check[index].style.visibility ='hidden';
        check[index].checked = false;
    }
    document.querySelector('#salon_form_container').action='../control/c_registrar_salon.php';
    document.querySelector('#salon_form_container').style.display='none';
    const input=document.querySelectorAll('.registrar_input');
        for (let index = 0; index < input.length; index++) {
        input[index].value="";
        input[index].disabled=false;
    }
    array=[];
})
document.querySelector('.cerrar_grupo').addEventListener('click', function () {
    const check=document.querySelectorAll('.checkbox');
    for (let index = 0; index < check.length; index++) {
        check[index].style.visibility ='hidden';
        check[index].checked = false;
    }
    document.querySelector('#registrar_grupo').action='../control/c_registrar_grupo.php';
    document.querySelector('#registrar_grupo_container').style.display='none';
    const input=document.querySelectorAll('.registrar_input');
        for (let index = 0; index < input.length; index++) {
        input[index].value="";
        input[index].disabled=false;
    }
    array=[];
})
document.querySelector('.cerrar_equipo').addEventListener('click', function () {
    const check=document.querySelectorAll('.checkbox');
    for (let index = 0; index < 4; index++) {
        check[index].style.visibility ='hidden';
        check[index].checked = false;
    }
    document.querySelector('#registrar').action='../control/c_registrar.php';
    document.querySelector('#registrar_usuario_container').style.display='none';
    const input=document.querySelectorAll('.registrar_input');
        for (let index = 0; index < input.length; index++) {
        input[index].value="";
        input[index].disabled=false;
    }
    array=[];
})


function KeyTexto() {
    var x=new RegExp("[A-Za-z-ñ]+")
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
function State(cedula, estado) {
    document.getElementById('cedula_usuario').value=cedula;
    document.getElementById('cedula_original').value=estado;
    document.getElementById('registrar').action='../control/c_estado.php';
    document.getElementById('registrar').submit();
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
document.querySelector('#cedula_usuario').addEventListener("keypress", KeyNumeros);
document.querySelector('#nombre_usuario').addEventListener("keypress", KeyTexto);
document.querySelector('#apellido_usuario').addEventListener("keypress", KeyTexto);
Onload();