<?php

if (isset($_POST['peticion'])) {
	if ($_POST['peticion'] == "historico") {
		$provincia = $_POST['provincia'];
		$indicador = $_POST['indicador'];
		$periodo = $_POST['periodo'];
		include_once 'conexion/pgsql.php';
		$conexion = new ConexionPGSQL();
		$conexion->conectar();
		$resultado = $conexion->consulta("select tl.valor, tl.anio from tlectura tl join tprovincia tp on tl.ubigeo=tp.ubigeo where tl.idindicador='$indicador' and tl.idperiodo='$periodo' and tp.codprovincia='$provincia'");
		$filas = pg_numrows($resultado);
		if ($filas != 0) {
			$jsondata = array();
			for ($cont = 0; $cont < $filas; $cont++) {
				$jsondata[$cont]["anio"] = pg_result($resultado, $cont, 1);
				$jsondata[$cont]["valor"] = pg_result($resultado, $cont, 0);
			}
		}
		echo json_encode($jsondata);
	}
} else {
	if (isset($_POST['provincia'])) {
		$provincia = $_POST['provincia'];
		$indicador = $_POST['indicador'];
		$anio = $_POST['anio'];
		$periodo = $_POST['periodo'];
		include_once 'conexion/pgsql.php';
		$conexion = new ConexionPGSQL();
		$conexion->conectar();
		if ($provincia == 'xx') {
			$resultado = $conexion->consulta("select tl.ubigeo, tp.nombre, tl.valor 
		from tprovincia tp join tlectura tl on tl.ubigeo=tp.ubigeo
		where tl.idindicador='$indicador' and tl.idperiodo='$periodo' and tl.anio='$anio'");
			$filas = pg_numrows($resultado);
			if ($filas != 0) {
				$jsondata = array();
				for ($cont = 0; $cont < $filas; $cont++) {
					$ubigeo = pg_result($resultado, $cont, 0);
					$jsondata[$ubigeo]['nombre'] = pg_result($resultado, $cont, 1);
					$jsondata[$ubigeo]['valor'] = pg_result($resultado, $cont, 2);
				}
			}
		} else {
			$resultado = $conexion->consulta("select tl.ubigeo, td.nombre, tl.valor 
		from tdistrito td join tlectura tl on tl.ubigeo=td.ubigeo
		where tl.idindicador='$indicador' and tl.idperiodo='$periodo' and tl.anio='$anio' and td.codprovincia='$provincia'");
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
		echo json_encode($jsondata);
	}
}
?>
