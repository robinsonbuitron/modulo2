<?php

session_start();
if (!isset($_SESSION['s_username'])) {
	header('Location: index.php');
	exit();
} else {
	if (isset($_POST['peticion'])) {
		include_once 'conexion/pgsql.php';
		$conexion = new ConexionPGSQL();
		$conexion->conectar();
		$peticion = $_POST['peticion'];
		if ($peticion == "provincia") {
			$resultado = $conexion->consulta("select * from tprovincia");
			$filas = pg_numrows($resultado);
			if ($filas != 0) {
				echo '<option style="color: blue" disabled selected>Elija una Provincia</option>';
				for ($cont = 0; $cont < $filas; $cont++) {
					$codProvincia = pg_result($resultado, $cont, 0);
					$nombre = pg_result($resultado, $cont, 1);
					echo "<option value='" . $codProvincia . "'>" . $nombre . "</option>";
				}
			}
		}
		if ($peticion == "distrito") {
			$codProvincia = $_POST['codProvincia'];
			$resultado = $conexion->consulta("select ubigeo, nombre from tdistrito where codProvincia = '$codProvincia'");
			$filas = pg_numrows($resultado);
			if ($filas != 0) {
				for ($cont = 0; $cont < $filas; $cont++) {
					echo "<option value='" . pg_result($resultado, $cont, 0) . "'>" . pg_result($resultado, $cont, 1) . "</option>";
				}
			}
		}
	}
}
?>