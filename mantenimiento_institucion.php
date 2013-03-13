<?php
/**
 * @author yarghu Doe <yarghu@gmail.com>
 *@copyright (c) 2013, yarghu
 * Mantenimieto para la tabla institucion
 * aqui se realiza toda la logica sql para dicha tabla
 * se coloca el codigo de insertar, modificar y eliminar
 */
if (isset($_POST['action'])) {
	include 'conexion/pgsql.php';
	$conexion = new ConexionPGSQL();
	$conexion->conectar();
	$action = $_POST['action'];
	if ($action == "insertar") {
		$idinstitucion = $_POST['idinstitucion'];
		$siglas = $_POST['siglas'];
		$nombinst = $_POST['nombinst'];
		$sql = $conexion->consulta("INSERT INTO tinstitucion VALUES (E'$idinstitucion',E'$siglas',E'$nombinst')");
		if (!$sql) {
			$jsondata['title'] = "error";
			$jsondata['html'] = '<div class="alert alert-error"><strong>Error!</strong> No se pudo registrar el nuevo usuario</div>';
			//echo "Consulta: " . $contador . "Fallo en la insercion de registro en la Base de Datos: " . mysql_error() . "<br>";
		} else {
			$jsondata['title'] = "correcto";
			$jsondata['html'] = '<div class="alert alert-success"><strong>Correcto!</strong> Se ingreso un nuevo usuario</div>';
		}
	}
	if ($action == "modificar") {
		$idinstitucion = $_POST['idinstitucion'];
		$siglas = $_POST['siglas'];
		$nombinst = $_POST['nombinst'];
		$sql = $conexion->consulta("UPDATE tinstitucion SET siglas='$siglas', nominst='$nombinst' WHERE idinstitucion='$idinstitucion';");
		if (!$sql) {
			$jsondata['title'] = "error";
			$jsondata['html'] = '<div class="alert alert-error"><strong>Error!</strong> No se pudo modificar el usuario</div>';
			//echo "Consulta: " . $contador . "Fallo en la insercion de registro en la Base de Datos: " . mysql_error() . "<br>";
		} else {
			$jsondata['title'] = "correcto";
			$jsondata['html'] = '<div class="alert alert-success"><strong>Correcto!</strong> Se modifico un usuario</div>';
		}
	}
	if ($action == "eliminar") {
                $idinstitucion=$_POST['idinstitucion'];
		$sql = $conexion->consulta("delete from tinstitucion where idinstitucion='$idinstitucion'");
		if (!$sql) {
			$jsondata['title'] = "error";
			$jsondata['html'] = '<div class="alert alert-error"><strong>Error!</strong> No se pudo eliminar el usuario</div>';
			//echo "Consulta: " . $contador . "Fallo en la insercion de registro en la Base de Datos: " . mysql_error() . "<br>";
		} else {
			$jsondata['title'] = "correcto";
			$jsondata['html'] = '<div class="alert alert-success"><strong>Correcto!</strong> Se elimino un usuario</div>';
		}
	}
}
echo json_encode($jsondata);

?>
