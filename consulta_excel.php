<?php

header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=NOMBRE.xls");

if (isset($_POST['peticion'])) {
	if ($_POST['peticion'] == "historico") {
		$idprovincia = $_GET['idprovincia'];
		$idindicador = $_GET['idindicador'];
		$anio = $_GET['anio'];
		$idperiodo = $_GET['idperiodo'];
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
	}
}
?>
