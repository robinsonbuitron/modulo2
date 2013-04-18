<?php

$jsondata = null;
if (isset($_POST['peticion'])) {
	$peticion = $_POST['peticion'];
	$provincia = $_POST['provincia'];
	$indicador = $_POST['indicador'];
	$periodo = $_POST['periodo'];
	include_once 'conexion/pgsql.php';
	$conexion = new ConexionPGSQL();
	$conexion->conectar();
	if ($peticion == "historico") {
		$minimo = (float) $_POST['minimo'];
		$maximo = (float) $_POST['maximo'];
		$resultado = $conexion->consulta("select tl.anio, tl.valor from tlectura tl join tprovincia tp on tl.ubigeo=tp.ubigeo where tl.idindicador='$indicador' and tl.idperiodo='$periodo' and tp.codprovincia='$provincia'");
		$filas = pg_numrows($resultado);
		if ($filas != 0) {
			$jsondata = array();
			$jsondata["series"][0]["name"] = "Bajo";
			$jsondata["series"][0]["color"] = "red";
			$jsondata["series"][1]["name"] = "Medio";
			$jsondata["series"][1]["color"] = "yellow";
			$jsondata["series"][2]["name"] = "Alto";
			$jsondata["series"][2]["color"] = "green";
			for ($cont = 0; $cont < $filas; $cont++) {
				$valor = (float) pg_result($resultado, $cont, 1);
				$jsondata["series"][0]["data"][$cont] = 0;
				$jsondata["series"][1]["data"][$cont] = 0;
				$jsondata["series"][2]["data"][$cont] = 0;
				if ($valor < $minimo) {
					$jsondata["series"][0]["data"][$cont] = $valor;
				}
				if ($valor > $maximo) {
					$jsondata["series"][2]["data"][$cont] = $valor;
				}
				if ($valor <= $maximo && $valor >= $minimo) {
					$jsondata["series"][1]["data"][$cont] = $valor;
				}
				$jsondata["categories"][$cont] = pg_result($resultado, $cont, 0);
			}
		}
	}
	if ($peticion == "mapas") {
		$anio = $_POST['anio'];
		if ($provincia == 'xx') {
			$resultado = $conexion->consulta("select tl.ubigeo, tp.nombre, tl.valor from tprovincia tp join tlectura tl on tl.ubigeo=tp.ubigeo where tl.idindicador='$indicador' and tl.idperiodo='$periodo' and tl.anio='$anio'");
		} else {
			$resultado = $conexion->consulta("select tl.ubigeo, td.nombre, tl.valor from tdistrito td join tlectura tl on tl.ubigeo=td.ubigeo where tl.idindicador='$indicador' and tl.idperiodo='$periodo' and tl.anio='$anio' and td.codprovincia='$provincia'");
		}
		$filas = pg_numrows($resultado);
		if ($filas != 0) {
			$jsondata = array();
			for ($cont = 0; $cont < $filas; $cont++) {
				$ubigeo = pg_result($resultado, $cont, 0);
				$jsondata[$ubigeo]['nombre'] = pg_result($resultado, $cont, 1);
				$jsondata[$ubigeo]['valor'] = pg_result($resultado, $cont, 2);
			}
		}
	}
	if ($peticion == "barras") {
		$anio = $_POST['anio'];
		$minimo = (float) $_POST['minimo'];
		$maximo = (float) $_POST['maximo'];
		if ($provincia == 'xx') {
			$resultado = $conexion->consulta("select tp.nombre, tl.valor from tprovincia tp join tlectura tl on tl.ubigeo=tp.ubigeo where tl.idindicador='$indicador' and tl.idperiodo='$periodo' and tl.anio='$anio'");
		} else {
			$resultado = $conexion->consulta("select td.nombre, tl.valor from tdistrito td join tlectura tl on tl.ubigeo=td.ubigeo where tl.idindicador='$indicador' and tl.idperiodo='$periodo' and tl.anio='$anio' and td.codprovincia='$provincia'");
		}
		$filas = pg_numrows($resultado);
		if ($filas != 0) {
			$jsondata = array();
			$jsondata["series"][0]["name"] = "Bajo";
			$jsondata["series"][0]["color"] = "red";
			$jsondata["series"][1]["name"] = "Medio";
			$jsondata["series"][1]["color"] = "yellow";
			$jsondata["series"][2]["name"] = "Alto";
			$jsondata["series"][2]["color"] = "green";
			for ($cont = 0; $cont < $filas; $cont++) {
				$valor = (float) pg_result($resultado, $cont, 1);
				$jsondata["series"][0]["data"][$cont] = 0;
				$jsondata["series"][1]["data"][$cont] = 0;
				$jsondata["series"][2]["data"][$cont] = 0;
				if ($valor < $minimo) {
					$jsondata["series"][0]["data"][$cont] = $valor;
				}
				if ($valor > $maximo) {
					$jsondata["series"][2]["data"][$cont] = $valor;
				}
				if ($valor <= $maximo && $valor >= $minimo) {
					$jsondata["series"][1]["data"][$cont] = $valor;
				}
				$jsondata["categories"][$cont] = pg_result($resultado, $cont, 0);
			}
		}
	}
	if ($peticion == "circulares") {
		$anio = $_POST['anio'];
		if ($provincia == 'xx') {
			$resultado = $conexion->consulta("select tp.nombre, tl.valor from tprovincia tp join tlectura tl on tl.ubigeo=tp.ubigeo where tl.idindicador='$indicador' and tl.idperiodo='$periodo' and tl.anio='$anio'");
		} else {
			$resultado = $conexion->consulta("select td.nombre, tl.valor from tdistrito td join tlectura tl on tl.ubigeo=td.ubigeo where tl.idindicador='$indicador' and tl.idperiodo='$periodo' and tl.anio='$anio' and td.codprovincia='$provincia'");
		}
		$filas = pg_numrows($resultado);
		if ($filas != 0) {
			$jsondata = array();
			for ($cont = 0; $cont < $filas; $cont++) {
				$valor = (float) pg_result($resultado, $cont, 1);
				$nombre = pg_result($resultado, $cont, 0);
				$jsondata[$cont] = array($nombre, $valor);
			}
		}
	}
}
echo json_encode($jsondata);
?>
