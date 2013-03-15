<?php

if (isset($_POST['peticion'])) {
	include_once 'conexion/pgsql.php';
	$conexion = new ConexionPGSQL();
	$conexion->conectar();
	$peticion = $_POST['peticion'];
	if ($peticion == "institucion") {
		$resultado = $conexion->consulta("select idinstitucion, Siglas from tinstitucion");
		$filas = pg_numrows($resultado);
		if ($filas != 0) {
			$jsondata = array();
			for ($cont = 0; $cont < $filas; $cont++) {
				$jsondata[$cont]['idinstitucion'] = pg_result($resultado, $cont, 0);
				$jsondata[$cont]['siglas'] = pg_result($resultado, $cont, 1);
			}
		}
	}
	if ($peticion == "cargo") {
		$resultado = $conexion->consulta("select idprivilegios, nombprivi from tprivilegios");
		$filas = pg_numrows($resultado);
		if ($filas != 0) {
			$jsondata = array();
			for ($cont = 0; $cont < $filas; $cont++) {
				$jsondata[$cont]['idprivilegios'] = pg_result($resultado, $cont, 0);
				$jsondata[$cont]['nombprivi'] = pg_result($resultado, $cont, 1);
			}
		}
	}
        
        if ($peticion == "unidad_medida") {
		$resultado = $conexion->consulta("select idunidadmedida, abreviatura from tunidadmedida");
		$filas = pg_numrows($resultado);
		if ($filas != 0) {
			$jsondata = array();
			for ($cont = 0; $cont < $filas; $cont++) {
				$jsondata[$cont]['idunidadmedida'] = pg_result($resultado, $cont, 0);
				$jsondata[$cont]['abreviatura'] = pg_result($resultado, $cont, 1);
			}
		}
	}
}
echo json_encode($jsondata);
?>
