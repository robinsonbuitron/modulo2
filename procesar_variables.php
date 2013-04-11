<?php

error_reporting(E_ALL);
set_include_path(get_include_path() . PATH_SEPARATOR . 'PHPExcel/');
include 'PHPExcel/PHPExcel/IOFactory.php';

if (isset($_GET['provincia'])) {
	include_once 'conexion/pgsql.php';
	$conexion = new ConexionPGSQL();
	$conexion->conectar();
	$provincia = $_GET['provincia'];
	$file = $_GET['file'];
	if ($provincia == "xx") {
		$resultado = $conexion->consulta("select ubigeo, nombre from tprovincia");
	} else {
		$resultado = $conexion->consulta("select ubigeo, nombre from tdistrito where codprovincia='$provincia'");
	}
	$filas = pg_numrows($resultado);
	if ($filas != 0) {
		$jsondata = array();
		for ($cont = 0; $cont < $filas; $cont++) {
			$ubigeo = pg_result($resultado, $cont, 0);
			$jsondata[$ubigeo] = 0;
		}
		$objPHPExcel = PHPExcel_IOFactory::load('variablesExcel/' . $file);
		$contador = 2;
		$aux = $objPHPExcel->getActiveSheet()->getCell('E' . $contador)->getValue();
		$ubigeo = $objPHPExcel->getActiveSheet()->getCell('B' . $contador)->getValue();
		while ($aux != "" && $aux != NULL) {
			//$valor+=$aux;
			foreach ($jsondata as $key => $value) {
				if ($ubigeo == $key) {
					$jsondata[$key]+=$aux;
				}
			}
			$contador++;
			$aux = $objPHPExcel->getActiveSheet()->getCell('E' . $contador)->getValue();
			$ubigeo = $objPHPExcel->getActiveSheet()->getCell('B' . $contador)->getValue();
		}
		//formula para el calculo de un indicador, apartir de variables
		foreach ($jsondata as $key => $value) {
			$jsondata[$key] = round(($jsondata[$key] / ($contador - 2)), 2);
		}
		echo json_encode($jsondata);
	}
}
?>
