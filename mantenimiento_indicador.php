<?php

session_start();
if (!isset($_SESSION['s_username'])) {
	header('Location: login.php');
	exit();
} else {
	if (isset($_POST['action'])) {
		include 'conexion/pgsql.php';
		$conexion = new ConexionPGSQL();
		$conexion->conectar();
		$action = $_POST['action'];
		if ($action == "insertar") {
			$resultado1 = $conexion->consulta("SELECT MAX(idindicador) AS idindicador FROM tindicador");
			$idindicador = pg_result($resultado1, 0, 0);
			if ($idindicador == null && $idindicador == "")
				$idindicador = "1000";
			$idunidadmedida = $_POST['idunidadmedida'];
			$idinstitucion = $_POST['idinstitucion'];
			$descripcion = $_POST['descripcion'];
			$valormin = $_POST['valorminimo'];
			$valormax = $_POST['valormaximo'];
			$idindicador++;

			$sql = $conexion->consulta("INSERT INTO tindicador VALUES (E'$idindicador',E'$idunidadmedida',E'$idinstitucion',E'$descripcion',E'$valormin',E'$valormax')");
			if (!$sql) {
				$jsondata['title'] = "error";
				$jsondata['html'] = '<div class="alert alert-error"><strong>Error!</strong> No se pudo registrar el Indicador</div>';
				//echo "Consulta: " . $contador . "Fallo en la insercion de registro en la Base de Datos: " . mysql_error() . "<br>";
			} else {
				$jsondata['title'] = $idindicador;
				$jsondata['html'] = '<div class="alert alert-success"><strong>Correcto!</strong> Se ingreso correctamente su nuevo indicador</div>';
			}
		}
		if ($action == "modificar") {
			$idindicador = $_POST['idindicador'];
			$idunidadmedida = $_POST['idunidadmedida'];
			$idinstitucion = $_POST['idinstitucion'];
			$descripcion = $_POST['descripcion'];
			$valormin = $_POST['valorminimo'];
			$valormax = $_POST['valormaximo'];
			$sql = $conexion->consulta("UPDATE tindicador SET idunidadmedida='$idunidadmedida', idinstitucion='$idinstitucion', descripcion='$descripcion', valorminimo='$valormin', valormaximo='$valormax'  WHERE idindicador='$idindicador';");
			if (!$sql) {
				$jsondata['title'] = "error";
				$jsondata['html'] = '<div class="alert alert-error"><strong>Error!</strong> No se pudo modificar el Indicador</div>';
				//echo "Consulta: " . $contador . "Fallo en la insercion de registro en la Base de Datos: " . mysql_error() . "<br>";
			} else {
				$jsondata['title'] = "correcto";
				$jsondata['html'] = '<div class="alert alert-success"><strong>Correcto!</strong> Se modifico un Indicador</div>';
			}
		}
		if ($action == "eliminar") {
			$idindicador = $_POST['idindicador'];
			$sql = $conexion->consulta("delete from tindicador where idindicador='$idindicador'");
			if (!$sql) {
				$jsondata['title'] = "error";
				$jsondata['html'] = '<div class="alert alert-error"><strong>Error!</strong> No se pudo eliminar el Indicador</div>';
				//echo "Consulta: " . $contador . "Fallo en la insercion de registro en la Base de Datos: " . mysql_error() . "<br>";
			} else {
				$jsondata['title'] = "correcto";
				$jsondata['html'] = '<div class="alert alert-success"><strong>Correcto!</strong> Se elimino un indicador</div>';
			}
		}
	}
	echo json_encode($jsondata);
}
?>
