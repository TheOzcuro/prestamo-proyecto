<?php 
include_once("conectar.php");
class registry extends mybsd {
    protected $cedula;
	protected $nombre;
    protected $apellido;
	protected $correo;
	function setDatos($cedula, $nombre, $apellido, $pass){
		$this->cedula=$cedula;
		$this->nombre=$nombre;
		$this->apellido=$apellido;
		$this->pass=$pass;
	}
	function Registrar()
	{
		$query="INSERT INTO `usuario`(`cedula`, `nombre`, `apellido`, `pass`, `rol`) VALUES ('$this->cedula','$this->nombre','$this->apellido','$this->pass', 'usuario')";
		return $this->execute($query);
	}
	function RegistrarUsers($cedula, $nombre, $apellido, $rol)
	{
		$query="INSERT INTO `usuario`(`cedula`, `nombre`, `apellido`, `rol`) VALUES ('$cedula','$nombre','$apellido','$rol')";
		return $this->execute($query);
	}
	function RegistrarPrestamo($fecha_creacion, $fecha_uso, $fecha_devolucion,$hora_inicial, $hora_final, $equipo_solicitado,
	$cantidad, $actividad, $salon, $cedula_solicitante)
	{
		$query="INSERT INTO `prestamo`(`fecha_creacion`, `fecha_uso`, `fecha_devolucion`,`hora_inicial`, `hora_final`, `equipo_solicitado`, `cantidad`,`actividad`, `salon`, `cedula_solicitante`, `estado`) VALUES ('$fecha_creacion', '$fecha_uso', '$fecha_devolucion', '$hora_inicial', '$hora_final', '$equipo_solicitado', '$cantidad','$actividad', '$salon', '$cedula_solicitante', 1)";
		return $this->execute($query);
	}
	function UpdateUsers($cedula, $nombre, $apellido, $rol, $cedula_origin)
	{
		$query="UPDATE `usuario` SET `cedula`='$cedula',`nombre`='$nombre',`apellido`='$apellido',`rol`='$rol' WHERE `cedula`='$cedula_origin'";
		if ($rol=="usuario") {
			$queryUser="UPDATE `prestamo` SET `cedula_solicitante`='$cedula' WHERE `cedula_solicitante`='$cedula_origin'";
			$this->execute($queryUser);
		}
		else if ($rol=="almacenista") {
			$queryAl="UPDATE `prestamo` SET `cedula_revisor`='$cedula' WHERE `cedula_revisor`='$cedula_origin'";
			$this->execute($queryAl);
		}
		return $this->execute($query);
	}
	function RegistrarPass($password,$cedula_origin)
	{
		$query="UPDATE `usuario` SET `pass`=$password WHERE `cedula`='$cedula_origin'";
		return $this->execute($query);
	}
	function VerifyPrestamo($cedula)
	{
		$query="SELECT `estado` FROM `prestamo` WHERE `cedula_solicitante`='$cedula' AND `estado`<>3 AND `estado`<>0";
		$array=$this->ListAll($this->execute($query), MYSQLI_NUM);
		$valide=1;
		for ($i=0; $i < count($array); $i++) { 
			if ($array[$i][0]==2) {
				$valide=0;
			}
		}
		if (count($array)>3) {
			$valide=0;
		}
		return $valide;
	}

	function UpdateEquipo($codigo_equipo, $codigo_bienes, $nombre_equipo, $estado, $grupo, $clase, $codigo_original)
	{
		$query="UPDATE `equipos` SET `codigo_equ`='$codigo_equipo',`codigo_bien`='$codigo_bienes',`nombre_equ`='$nombre_equipo',`estado`='$estado', `grupo`='$grupo', `clase`='$clase' WHERE `codigo_equ`='$codigo_original';
		UPDATE `prestamo` SET `equipo`='$codigo_equipo' WHERE `equipo`=$codigo_original";
		return $this->executeMultiple($query);
	}
	function UpdateGrupo($codigo_grupo, $nombre_grupo, $codigo_original)
	{
		$query="UPDATE `grupo` SET `grupo_id`='$codigo_grupo',`grupo_nombre`='$nombre_grupo' WHERE `grupo_id`='$codigo_original';
		UPDATE `equipos` SET `grupo`=$codigo_grupo WHERE `grupo`='$codigo_original'";
		return $this->executeMultiple($query);
	}
	function GetAllPrestamo($cedula)
	{
		$query="SELECT `fecha_creacion`, `fecha_entrega`, `fecha_devolucion`, `fecha_uso`, `hora_inicial`, `hora_final`, `equipo_solicitado`, `cantidad`,`actividad`, `salon`, `observacion`, `estado`, `cedula_revisor` FROM `prestamo` WHERE `cedula_solicitante`='$cedula'";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetAllPrestamoPendiente()
	{
		$query="SELECT `equipo`, `fecha_creacion`, `fecha_entrega`, `fecha_devolucion`, `fecha_uso`, `hora_inicial`, `hora_final`, `equipo_solicitado`, `cantidad`,  `actividad`, `salon`, `observacion`, `estado`, `cedula_solicitante`, `cedula_revisor`, `id` FROM `prestamo` WHERE `estado`=1";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetAllPrestamoRechazada()
	{
		$query="SELECT `equipo`, `fecha_creacion`, `fecha_entrega`, `fecha_devolucion`, `fecha_uso`, `hora_inicial`, `hora_final`, `equipo_solicitado`, `cantidad`,`actividad`, `salon`, `observacion`, `estado`, `cedula_solicitante`, `cedula_revisor`, `id` FROM `prestamo` WHERE `estado`=0";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetAllPrestamoAprobada()
	{
		$query="SELECT `equipo`, `fecha_creacion`, `fecha_entrega`, `fecha_devolucion`, `fecha_uso`, `hora_inicial`, `hora_final`, `equipo_solicitado`, `cantidad`,`actividad`, `salon`, `observacion`, `estado`, `cedula_solicitante`, `cedula_revisor`, `id` FROM `prestamo` WHERE `estado`=2";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetAllUsuarioPrestamo($cedula)
	{
		$query="SELECT `equipo`, `fecha_creacion`, `fecha_entrega`, `fecha_devolucion`, `fecha_uso`, `hora_inicial`, `hora_final`, `equipo_solicitado`, `cantidad`,`actividad`, `salon`, `observacion`, `estado`, `cedula_solicitante`, `cedula_revisor`, `id` FROM `prestamo` WHERE `cedula_solicitante`='$cedula' OR `cedula_revisor`='$cedula'";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetAllUsuarioPrestamoPendiente($cedula)
	{
		$query="SELECT `equipo`, `fecha_creacion`, `fecha_entrega`, `fecha_devolucion`, `fecha_uso`, `hora_inicial`, `hora_final`, `equipo_solicitado`, `cantidad`,`actividad`, `salon`, `observacion`, `estado`, `cedula_solicitante`, `cedula_revisor`, `id` FROM `prestamo` WHERE `cedula_solicitante`='$cedula' AND `estado`=1";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetAllUsuarioCronograma($fecha, $estado)
	{
		$query="SELECT `equipo`, `fecha_creacion`, `fecha_entrega`, `fecha_devolucion`, `fecha_uso`, `hora_inicial`, `hora_final`, `equipo_solicitado`, `cantidad`,`actividad`, `salon`, `observacion`, `estado`, `cedula_solicitante`, `cedula_revisor`, `id` FROM `prestamo` WHERE `fecha_creacion` LIKE '%$fecha%' AND `estado`=$estado";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetAllPrestamoDevuelta()
	{
		$query="SELECT `equipo`, `fecha_creacion`, `fecha_entrega`, `fecha_devolucion`, `fecha_uso`, `hora_inicial`, `hora_final`, `equipo_solicitado`, `cantidad`,`actividad`, `salon`, `observacion`, `estado`, `cedula_solicitante`, `cedula_revisor`, `id` FROM `prestamo` WHERE `estado`=3";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	
	function RegistrarClase($clase)
	{
		$query="INSERT INTO `clase`(`clase_nombre`) VALUES ('$clase')";
		return $this->execute($query);
	}
	function UpdateClase($clase, $id)
	{
		$query="UPDATE `clase` SET `clase_nombre`='$clase' WHERE `id`='$id'";
		return $this->execute($query);
	}
	function EliminarClase($id)
	{
		$query="DELETE FROM `clase` WHERE `id`='$id'";
		return $this->execute($query);
	}
	function RegistrarActividad($actividad)
	{
		$query="INSERT INTO `actividad`(`actividad`) VALUES ('$actividad')";
		return $this->execute($query);
	}
	function UpdateActividad($actividad, $id)
	{
		$query="UPDATE `actividad` SET `actividad`='$actividad' WHERE `id`='$id'";
		return $this->execute($query);
	}
	
	function EliminarActividad($id)
	{
		$query="DELETE FROM `actividad` WHERE `id`='$id'";
		return $this->execute($query);
	}
	function RegistrarSalon($salon)
	{
		$query="INSERT INTO `salon`(`salon_nombre`) VALUES ('$salon')";
		return $this->execute($query);
	}
	function UpdateSalon($salon, $id)
	{
		$query="UPDATE `salon` SET `salon_nombre`='$salon' WHERE `id`='$id'";
		return $this->execute($query);
	}
	function EliminarSalon($id)
	{
		$query="DELETE FROM `salon` WHERE `id`='$id'";
		return $this->execute($query);
	}
	function VerificarFecha($equipo, $fecha_uso)
	{
		$dato=explode(",",$equipo);
		$return="";
		for ($i=0; $i < count($dato); $i++) { 
			$query="SELECT `fecha_devolucion` FROM `prestamo` WHERE `equipo` LIKE '%$dato[$i]%' AND `estado`=2";
			$query_nombre="SELECT `nombre_equ` FROM `equipos` WHERE `codigo_equ`=$dato[$i]";
			$nombre_equipo=$this->ListAll($this->execute($query_nombre), MYSQLI_NUM);
			$fecha_devolucion=$this->ListAll($this->execute($query), MYSQLI_NUM);
			for ($y=0; $y < count($fecha_devolucion); $y++) { 
				if ($fecha_devolucion[$y][0]>$fecha_uso) {
					$return=$nombre_equipo[0][0].", ".$return;
				}
			}
		}
		return $return;
	}
	function Rechazar($id, $observacion, $cedula_revisor)
	{
		$query="UPDATE `prestamo` SET `equipo`='', `fecha_entrega`='', `estado`=0, `observacion`='$observacion',`cedula_revisor`=$cedula_revisor WHERE `id`='$id'";
		return $this->executeMultiple($query);
	}
	function VerificarPrestamo($cedula)
	{
		$query="SELECT `estado` FROM `prestamo` WHERE `cedula_solicitante`='$cedula' AND `estado`=2 AND `fecha_entrega`<>'0000-00-00'";
		return count($this->ListAll($this->execute($query), MYSQLI_NUM));
	}
	function VerificarFechaEquipo($cedula, $fecha_uso)
	{
		$query="SELECT `estado` FROM `prestamo` WHERE `cedula_solicitante`='$cedula' AND `estado`=2 AND `fecha_uso`='$fecha_uso'";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function Aprobar($id, $observacion, $cedula_revisor, $equipo)
	{
		$query="UPDATE `prestamo` SET `estado`=2, `equipo`='$equipo', `observacion`='$observacion',`cedula_revisor`=$cedula_revisor WHERE `id`='$id'";
		$equipos=explode(",",$equipo);
		for ($i=0; $i < count($equipos); $i++) { 
			$queryequ="UPDATE `equipos` SET `estado`='prestamo' WHERE `codigo_equ`=$equipos[$i]";
			$this->execute($queryequ);
		}
		return $this->executeMultiple($query);
	}
	function Entregar($id, $fecha_entregado, $observacion)
	{
		$query="UPDATE `prestamo` SET `fecha_entrega`='$fecha_entregado', `observacion`='$observacion' WHERE `id`='$id'";
		return $this->executeMultiple($query);
	}
	function Devuelto($id, $observacion, $cedula_revisor, $equipo, $fecha_aprobado)
	{
		$query="UPDATE `prestamo` SET `estado`=3, `fecha_devolucion`='$fecha_aprobado', `observacion`='$observacion',`cedula_revisor`=$cedula_revisor WHERE `id`='$id'";
		$this->executeMultiple($query);
		$equipos=explode(",",$equipo);
		for ($i=0; $i < count($equipos); $i++) { 
			$querypresta="SELECT `estado` FROM `prestamo` WHERE `equipo` LIKE '%$equipos[$i]%' AND `estado`=2";
			$presta=$this->ListAll($this->execute($querypresta), MYSQLI_NUM);
			if (count($presta)==0) {
				$queryequ="UPDATE `equipos` SET `estado`='bien' WHERE `codigo_equ`=$equipos[$i]";
				$this->execute($queryequ);
			}
		}
		
	}
	function ComprobarPrestamos()
	{
		$queryequipo="SELECT `codigo_equ` FROM `equipos`";
		$date=date("Y-m-d");
		$variable="";
		$equipos=$this->ListAll($this->execute($queryequipo), MYSQLI_NUM);
		for ($i=0; $i < count($equipos); $i++) { 
			$variable=$equipos[$i][0];
			$querypresta="SELECT * FROM `prestamo` WHERE `equipo` LIKE '%$variable%' AND `fecha_uso`='$date' AND `estado`=2";
			$querydevolucion="SELECT * FROM `prestamo` WHERE `equipo` LIKE '%$variable%' AND `fecha_devolucion`<'$date' AND `estado`=2";
			$prestamo=$this->ListAll($this->execute($querypresta), MYSQLI_NUM);
			$devolucion=$this->ListAll($this->execute($querydevolucion), MYSQLI_NUM);
			if (count($prestamo)>0 && count($devolucion)>0) {
				$variable=$prestamo[0][0];
				$query="UPDATE `prestamo` SET `estado`=1 `observacion`='El equipo solicitado no fue devuelto a tiempo' `fecha_entrega`='0000-00-00' WHERE `id`='$variable'";
			}
		}
	}
	function GetName($cedula)
	{
		$query="SELECT `nombre`, `apellido` FROM `usuario` WHERE `cedula`='$cedula'";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetTable($tabla)
	{
		$query="SELECT * FROM `$tabla`";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function VerificarEquipos($equipo, $clase, $estado)
	{
		$query="SELECT `clase` FROM `equipos` WHERE `codigo_equ`='$equipo' AND `clase`='$clase' AND `estado`='$estado'";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetTableUsuario()
	{
		$query="SELECT `cedula`, `nombre`, `apellido`, `rol`, `estado` FROM `usuario`";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetActividad() {
		$query="SELECT * FROM `actividad`";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetClasesBien() {
		$query="SELECT DISTINCT clase.id, clase.clase_nombre FROM `clase`, `equipos` WHERE clase.id=equipos.clase AND equipos.estado='bien';";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetSalon() {
		$query="SELECT * FROM `salon`";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetUser($cedula) {
		$query="SELECT `pass`, `rol`,`estado`, `cedula` FROM `usuario` WHERE `cedula`=$cedula";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function UpdateState($cedula, $estado)
	{
		$query="UPDATE `usuario` SET `estado`='$estado' WHERE `cedula`='$cedula'";
		return $this->execute($query);
	}
	
	function GetTableEquipo()
	{
		$query="SELECT `codigo_equ`, `codigo_bien`, `nombre_equ`, `estado`, `grupo`, `clase` FROM `equipos`";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function RegistrarEquipoInv($codigo_equipo, $codigo_bien, $nombre_equipo, $estado, $grupo, $clase)
	{
		$query="INSERT INTO `equipos`(`codigo_equ`, `codigo_bien`, `nombre_equ`, `estado`, `grupo`, `clase`) VALUES ('$codigo_equipo','$codigo_bien','$nombre_equipo','$estado', '$grupo', '$clase')";
		return $this->execute($query);
	}
	function RegistrarGrupo($codigo_grupo, $codigo_nombre)
	{
		$query="INSERT INTO `grupo`(`grupo_id`, `grupo_nombre`) VALUES ('$codigo_grupo','$codigo_nombre')";
		return $this->execute($query);
	}
	function UpdateTable($cedula)
	{
		$query="UPDATE `cliente` SET `cedula`='$this->cedula',`nombre`='$this->nombre',`apellido`='$this->apellido',`correo`='$this->correo' WHERE `cedula`='$cedula'";
		return $this->execute($query);
	}
	function Delete($cedula)
	{
		$query="DELETE FROM `usuario` WHERE `cedula`='$cedula'";
		return $this->execute($query);
	}
	function DeleteEquipo($codigo)
	{
		$query="DELETE FROM `equipos` WHERE `codigo_equ`='$codigo'";
		return $this->execute($query);
	}
	function DeleteGrupo($codigo)
	{
		$query="DELETE FROM `grupo` WHERE `grupo_id`='$codigo'";
		return $this->execute($query);
	}
	
}
?>