<?php

/**
 *
 * Mantenimieto para la tabla institucion
 * aqui se realiza toda la logica sql para dicha tabla
 * se coloca el codigo de insertar, modificar y eliminar
 */
session_start();
if (!isset($_SESSION['s_username'])) {
	header('Location: index.php');
	exit();
} else {
	if (isset($_POST['action'])) {
		include 'conexion/pgsql.php';
		$conexion = new ConexionPGSQL();
		$conexion->conectar();
		$action = $_POST['action'];
		if ($action == "insertar") {
			//$idinstitucion = "10000";
			$resultado1 = $conexion->consulta("SELECT MAX(idinstitucion) AS idinstitucion FROM tinstitucion");
			//$filas = pg_numrows($resultado1);
			$idinstitucion = pg_result($resultado1, 0, 0);
			if ($idinstitucion == null && $idinstitucion == "")
				$idinstitucion = "10000";

			//$idinstitucion = $_POST['idinstitucion'];
			$siglas = $_POST['siglas'];
			$nombinst = $_POST['nombinst'];
			$idinstitucion++;
			$sql = $conexion->consulta("INSERT INTO tinstitucion VALUES ('$idinstitucion','$siglas','$nombinst')");
			if (!$sql) {
				$jsondata['title'] = "error";
				$jsondata['html'] = '<div class="alert alert-error"><strong>Error!</strong> No se pudo registrar la institución</div>';
				//echo "Consulta: " . $contador . "Fallo en la insercion de registro en la Base de Datos: " . mysql_error() . "<br>";
			} else {
				$jsondata['title'] = $idinstitucion;
				$jsondata['html'] = '<div class="alert alert-success"><strong>Correcto!</strong> Se ingreso correctamente la institución</div>';
			}
		}
		if ($action == "modificar") {
			$idinstitucion = $_POST['idinstitucion'];
			$siglas = $_POST['siglas'];
			$nombinst = $_POST['nombinst'];
			$sql = $conexion->consulta("UPDATE tinstitucion SET siglas='$siglas', nominst='$nombinst' WHERE idinstitucion='$idinstitucion';");
			if (!$sql) {
				$jsondata['title'] = "error";
				$jsondata['html'] = '<div class="alert alert-error"><strong>Error!</strong> No se pudo modificar la institución/div>';
				//echo "Consulta: " . $contador . "Fallo en la insercion de registro en la Base de Datos: " . mysql_error() . "<br>";
			} else {
				$jsondata['title'] = "correcto";
				$jsondata['html'] = '<div class="alert alert-success"><strong>Correcto!</strong> Se modifico los datos de Institución</div>';
			}
		}
		if ($action == "eliminar") {
			$idinstitucion = $_POST['idinstitucion'];
			$sql = $conexion->consulta("delete from tinstitucion where idinstitucion='$idinstitucion'");
			if (!$sql) {
				$jsondata['title'] = "error";
				$jsondata['html'] = '<div class="alert alert-error"><strong>Error!</strong> No se pudo eliminar</div>';
				//echo "Consulta: " . $contador . "Fallo en la insercion de registro en la Base de Datos: " . mysql_error() . "<br>";
			} else {
				$jsondata['title'] = "correcto";
				$jsondata['html'] = '<div class="alert alert-success"><strong>Correcto!</strong> Se elimino correctamente...</div>';
			}
		}
	}
	echo json_encode($jsondata);
}
?>
