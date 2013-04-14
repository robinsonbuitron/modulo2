<?php

$jsondata = NULL;
if (isset($_POST["peticion"])) {
	include_once 'conexion/pgsql.php';
	$conexion = new ConexionPGSQL();
	$conexion->conectar();
	$resultado = $conexion->consulta("select tp.nombre, tl.valor from tprovincia tp join tlectura tl on tl.ubigeo=tp.ubigeo where tl.idindicador='1001' and tl.idperiodo='119' and tl.anio='2013'");
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
echo json_encode($jsondata);
?>
