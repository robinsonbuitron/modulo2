<?php

error_reporting(E_ALL);
set_include_path(get_include_path() . PATH_SEPARATOR . 'PHPExcel/');
include 'PHPExcel/PHPExcel/IOFactory.php';

if (isset($_GET['tipo'])) {
	$tipo = $_GET['tipo'];
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
		$numVariables = array();
		for ($cont = 0; $cont < $filas; $cont++) {
			$ubigeo = pg_result($resultado, $cont, 0);
			$jsondata[$ubigeo] = 0;
			$numVariables[$ubigeo] = 0;
		}
		$objPHPExcel = PHPExcel_IOFactory::load('excel/' . $file);
		if ($tipo == "variables") {
			$contador = 10;
			$aux = $objPHPExcel->getActiveSheet()->getCell('D' . $contador)->getValue();
			$ubigeo = $objPHPExcel->getActiveSheet()->getCell('A' . $contador)->getValue();
			while ($ubigeo != "" && $ubigeo != NULL) {
				if (is_numeric($aux)) {
					foreach ($jsondata as $key => $value) {
						if ($ubigeo == $key) {
							$jsondata[$key]+=$aux;
							$numVariables[$key]++;
						}
					}
				} else {
					$jsondata['html'] = 'Error al procesar las variables, por favor revise el archivo excel';
				}
				$contador++;
				$aux = $objPHPExcel->getActiveSheet()->getCell('D' . $contador)->getValue();
				$ubigeo = $objPHPExcel->getActiveSheet()->getCell('A' . $contador)->getValue();
			}
			//formula para el calculo de un indicador, apartir de variables
			foreach ($jsondata as $key => $value) {
				if ($key != "html") {
					$jsondata[$key] = round(($jsondata[$key] / ($numVariables[$key])), 2);
				}
			}
		}
		if ($tipo == "indicador") {
			$contador = 11;
			$aux = $objPHPExcel->getActiveSheet()->getCell('C' . $contador)->getValue();
			$ubigeo = $objPHPExcel->getActiveSheet()->getCell('A' . $contador)->getValue();
			while ($aux !== "" && $aux !== NULL) {
				foreach ($jsondata as $key => $value) {
					if ($ubigeo == $key) {
						$jsondata[$key] = $aux;
					}
				}
				$contador++;
				$aux = $objPHPExcel->getActiveSheet()->getCell('C' . $contador)->getValue();
				$ubigeo = $objPHPExcel->getActiveSheet()->getCell('A' . $contador)->getValue();
			}
		}
		echo json_encode($jsondata);
	}
}
?>
