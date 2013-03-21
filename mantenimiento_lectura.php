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
			$indicador = $_POST['indicador'];
			$ubigeo = $_POST['ubigeo'];
			$anio = $_POST['anio'];
			$periodo = $_POST['periodo'];
			$valor = $_POST['valor'];
			$sql = $conexion->consulta("INSERT INTO tlectura VALUES ('$indicador','$ubigeo','$periodo','$anio','$valor')");
			if (!$sql) {
				$jsondata['title'] = "error";
				$jsondata['html'] = '<div class="alert alert-error"><strong>Error!</strong> No se pudo registrar el nuevo usuario</div>';
				//echo "Consulta: " . $contador . "Fallo en la insercion de registro en la Base de Datos: " . mysql_error() . "<br>";
			} else {
				$jsondata['title'] = $indicador;
				$jsondata['html'] = '<div class="alert alert-success"><strong>Correcto!</strong> Se ingreso un nuevo usuario</div>';
			}
		}
		if ($action == "modificar") {
			$indicador = $_POST['indicador'];
			$ubigeo = $_POST['ubigeo'];
			$anio = $_POST['anio'];
			$periodo = $_POST['periodo'];
			$valor = $_POST['valor'];
			$sql = $conexion->consulta("UPDATE tlectura SET valor='$valor' WHERE idindicador='$indicador' and ubigeo='$ubigeo' and idperiodo='$periodo' and anio='$anio'");
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
			$idinstitucion = $_POST['idinstitucion'];
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
}
?>
