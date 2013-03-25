<?php

$provincia = '01';
$indicador = '1001';
$anio = '2013';
$periodo = '101';
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
?>
