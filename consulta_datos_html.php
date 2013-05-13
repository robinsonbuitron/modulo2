<?php

session_start();
if (isset($_POST['peticion'])) {
	include_once 'conexion/pgsql.php';
	$conexion = new ConexionPGSQL();
	$conexion->conectar();
	$peticion = $_POST['peticion'];
	if ($peticion == "provincia") {
		$resultado = $conexion->consulta("select * from tprovincia");
		$filas = pg_numrows($resultado);
		if ($filas != 0) {
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
	if ($peticion == "indicador") {
		$resultado = $conexion->consulta("select idindicador, descripcion from tindicador where idinstitucion='" . $_SESSION["s_idinstitucion"] . "'");
		$filas = pg_numrows($resultado);
		if ($filas != 0) {
			for ($cont = 0; $cont < $filas; $cont++) {
				echo "<option value='" . pg_result($resultado, $cont, 0) . "'>" . pg_result($resultado, $cont, 1) . "</option>";
			}
		}
	}
	if ($peticion == "indicador_institucion") {
		$idinstitucion = $_POST['institucion'];
		$resultado = $conexion->consulta("select idindicador, descripcion from tindicador where idinstitucion='" . $idinstitucion . "'");
		$filas = pg_numrows($resultado);
		if ($filas != 0) {
			for ($cont = 0; $cont < $filas; $cont++) {
				echo "<option value='" . pg_result($resultado, $cont, 0) . "'>" . pg_result($resultado, $cont, 1) . "</option>";
			}
		}
	}
	if ($peticion == "institucion") {
		$resultado = $conexion->consulta("select idinstitucion, nominst ,Siglas from tinstitucion");
		$filas = pg_numrows($resultado);
		if ($filas != 0) {
			for ($cont = 0; $cont < $filas; $cont++) {
				echo "<option value='" . pg_result($resultado, $cont, 0) . "'>" . pg_result($resultado, $cont, 1) . " - " . pg_result($resultado, $cont, 2) . "</option>";
			}
		}
	}
	if ($peticion == "anio_indicador") {
		$indicador = $_POST["indicador"];
		$resultado = $conexion->consulta("select anio from tlectura where idindicador = '$indicador' GROUP BY anio");
		$filas = pg_numrows($resultado);
		if ($filas != 0) {
			for ($cont = 0; $cont < $filas; $cont++) {
				echo "<option value='" . pg_result($resultado, $cont, 0) . "'>" . pg_result($resultado, $cont, 0) . "</option>";
			}
		}
	}
	if ($peticion == "periodo_indicador") {
		$indicador = $_POST["indicador"];
		$anio = $_POST["anio"];
		$resultado = $conexion->consulta("select tl.idperiodo, tp.descripcion from tlectura tl join tperiodo tp on tl.idperiodo=tp.idperiodo where tl.idindicador = '$indicador' and tl.anio = '$anio' GROUP BY tl.idperiodo, tp.descripcion");
		$filas = pg_numrows($resultado);
		if ($filas != 0) {
			for ($cont = 0; $cont < $filas; $cont++) {
				echo "<option value='" . pg_result($resultado, $cont, 0) . "'>" . pg_result($resultado, $cont, 1) . "</option>";
			}
		}
	}
}
?>