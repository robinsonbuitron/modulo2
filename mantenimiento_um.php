<?php

/**
 * Mantenimieto para la tabla unidad de medida
 * aqui se realiza toda la logica sql para dicha tabla
 * se coloca el codigo de insertar, modificar y eliminar
 */
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
			//$idunidadmedida = "100";
			$resultado1 = $conexion->consulta("SELECT MAX(idunidadmedida) AS idunidadmedida FROM tunidadmedida");
			$idunidadmedida = pg_result($resultado1, 0, 0);
			if ($idunidadmedida == null && $idunidadmedida == "")
				$idunidadmedida = "100";

			$abreviatura = $_POST['abreviatura'];
			$descripcion = $_POST['descripcion'];
			$idunidadmedida++;
			$sql = $conexion->consulta("INSERT INTO tunidadmedida VALUES ('$idunidadmedida','$abreviatura','$abreviatura')");
			if (!$sql) {
				$jsondata['title'] = "error";
				$jsondata['html'] = '<div class="alert alert-error"><strong>Error!</strong> No se pudo registrar el nuevo registro</div>';
			} else {
				$jsondata['title'] = $idunidadmedida;
				$jsondata['html'] = '<div class="alert alert-success"><strong>Correcto!</strong> Se ingreso una nueva Unidad de Medida</div>';
			}
		}
		if ($action == "modificar") {
			$idunidadmedida = $_POST['unidadmedida'];
			$abreviatura = $_POST['abreviatura'];
			$descripcion = $_POST['descripcion'];
			$sql = $conexion->consulta("UPDATE tunidadmedida SET abreviatura='$abreviatura', descripcion='$descripcion' WHERE idunidadmedida='$idunidadmedida';");
			if (!$sql) {
				$jsondata['title'] = "error";
				$jsondata['html'] = '<div class="alert alert-error"><strong>Error!</strong> No se pudo modificar el registro</div>';
			} else {
				$jsondata['title'] = "correcto";
				$jsondata['html'] = '<div class="alert alert-success"><strong>Correcto!</strong> Se modifico el registro</div>';
			}
		}
		if ($action == "eliminar") {
			$idunidadmedida = $_POST['idunidadmedida'];
			$sql = $conexion->consulta("delete from tunidadmedida where idunidadmedida='$idunidadmedida'");
			if (!$sql) {
				$jsondata['title'] = "error";
				$jsondata['html'] = '<div class="alert alert-error"><strong>Error!</strong> No se pudo eliminar el registro seleccionado</div>';
				//echo "Consulta: " . $contador . "Fallo en la insercion de registro en la Base de Datos: " . mysql_error() . "<br>";
			} else {
				$jsondata['title'] = "correcto";
				$jsondata['html'] = '<div class="alert alert-success"><strong>Correcto!</strong> Se elimino una unidad de medida</div>';
			}
		}
	}
	echo json_encode($jsondata);
}
?>
