<?php

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
			include 'lib/Encrypter.php';
			$DNI = $_POST['dni'];
			$idprivilegios = $_POST['idprivilegios'];
			$idinstitucion = $_POST['idinstitucion'];
			$nomape = $_POST['nomape'];
			$password = Encrypter::encrypt($_POST['password']);
			$sql = $conexion->consulta("INSERT INTO tusuario VALUES (E'$DNI',E'$idinstitucion',E'$idprivilegios',E'$nomape',E'$password')");
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
			$DNI = $_POST['dni'];
			$idprivilegios = $_POST['idprivilegios'];
			$idinstitucion = $_POST['idinstitucion'];
			$nomape = $_POST['nomape'];
			$sql = $conexion->consulta("UPDATE tusuario SET idinstitucion='$idinstitucion', idprivilegios='$idprivilegios', nomape='$nomape' WHERE idusuario='$DNI';");
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
			$DNI = $_POST['dni'];
			$sql = $conexion->consulta("delete from tusuario where idusuario='$DNI'");
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