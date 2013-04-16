<?php

error_reporting(E_ALL);
set_include_path(get_include_path() . PATH_SEPARATOR . 'PHPExcel/');
include 'PHPExcel/PHPExcel/IOFactory.php';

if (isset($_GET['tipo'])) {
	$tipo = $_GET["tipo"];
	if ($tipo == "indicador") {
		$provincia = $_GET['provincia'];
		$idindicador = $_GET['idindicador'];
		$indicador = $_GET['indicador'];
		$anio = $_GET['anio'];
		$idperiodo = $_GET['idperiodo'];
		$periodo = $_GET["periodo"];
		include_once 'conexion/pgsql.php';
		$conexion = new ConexionPGSQL();
		$conexion->conectar();
		if ($provincia == "xx") {
			$resultado = $conexion->consulta("select ubigeo, nombre from tprovincia");
		} else {
			$resultado = $conexion->consulta("select ubigeo, nombre from tdistrito where codprovincia='$provincia'");
		}
		$filas = pg_numrows($resultado);
		if ($filas != 0) {
			$objPHPExcel = PHPExcel_IOFactory::load('plantillas/indicadores.xls');
			$objPHPExcel->getActiveSheet()->setCellValue('B5', $indicador);
			$objPHPExcel->getActiveSheet()->setCellValue('B6', $periodo);
			$objPHPExcel->getActiveSheet()->setCellValue('B7', $anio);
			$objPHPExcel->getActiveSheet()->setCellValue('F5', $idindicador);
			$objPHPExcel->getActiveSheet()->setCellValue('F6', $idperiodo);
			$contador = 11;
			for ($cont = 0; $cont < $filas; $cont++) {
				$objPHPExcel->getActiveSheet()->setCellValue('A' . $contador, pg_result($resultado, $cont, 0));
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $contador, pg_result($resultado, $cont, 1));
				$contador++;
			}
		}
	}
	if ($tipo == "variables") {
		$provincia = $_GET['provincia'];
		$indicador = $_GET['indicador'];
		$anio = $_GET['anio'];
		$idperiodo = $_GET['idperiodo'];
		$periodo = $_GET["periodo"];
		include_once 'conexion/pgsql.php';
		$conexion = new ConexionPGSQL();
		$conexion->conectar();
		if ($provincia == "xx") {
			$resultado = $conexion->consulta("select ubigeo, nombre from tprovincia");
		} else {
			$resultado = $conexion->consulta("select ubigeo, nombre from tdistrito where codprovincia='$provincia'");
		}
		$filas = pg_numrows($resultado);
		if ($filas != 0) {
			$objPHPExcel = PHPExcel_IOFactory::load('plantillas/variables.xls');
			$objPHPExcel->getActiveSheet()->setCellValue('A4', 'VARIABLES DE ' . $indicador);
			$objPHPExcel->getActiveSheet()->setCellValue('B6', $anio);
			$objPHPExcel->getActiveSheet()->setCellValue('F6', $periodo);
			$objPHPExcel->getActiveSheet()->setCellValue('F7', $idperiodo);
			$contador = 10;
			for ($cont = 0; $cont < $filas; $cont++) {
				$objPHPExcel->getActiveSheet()->setCellValue('A' . $contador, pg_result($resultado, $cont, 0));
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $contador, pg_result($resultado, $cont, 1));
				$contador++;
			}
		}
	}
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="' . $tipo . " " . $indicador . '.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
}
?>
