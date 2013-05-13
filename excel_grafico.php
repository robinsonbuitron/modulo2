<?php

error_reporting(E_ALL);
set_include_path(get_include_path() . PATH_SEPARATOR . 'PHPExcel/');
include 'PHPExcel/PHPExcel/IOFactory.php';

if (isset($_GET['provincia'])) {
	include_once 'conexion/pgsql.php';
	$conexion = new ConexionPGSQL();
	$conexion->conectar();
	$provincia = $_GET['provincia'];
	$idindicador = $_GET['idindicador'];
	$anio = $_GET['anio'];
	$idperiodo = $_GET['idperiodo'];
	if ($provincia == "xx") {
		$resultado = $conexion->consulta("select td.ubigeo, td.nombre, ti.descripcion, tl.anio, tp.descripcion, tl.valor from tlectura tl join tindicador ti on tl.idindicador=ti.idindicador join tperiodo tp on tl.idperiodo=tp.idperiodo	join tprovincia td on tl.ubigeo=td.ubigeo where tl.idindicador='$idindicador' and tl.idperiodo='$idperiodo' and tl.anio='$anio'");
	} else {
		$resultado = $conexion->consulta("select td.ubigeo, td.nombre, ti.descripcion, tl.anio, tp.descripcion, tl.valor from tlectura tl join tindicador ti on tl.idindicador=ti.idindicador join tperiodo tp on tl.idperiodo=tp.idperiodo join tdistrito td on tl.ubigeo=td.ubigeo where tl.idindicador='$idindicador' and tl.idperiodo='$idperiodo' and tl.anio='$anio' and td.codprovincia='$provincia'");
	}
	$filas = pg_numrows($resultado);
	if ($filas != 0) {
		$objPHPExcel = PHPExcel_IOFactory::load('plantillas/indicadores.xls');
		for ($cont = 0; $cont < $filas; $cont++) {
			$contador = $cont + 11;
			$objPHPExcel->getActiveSheet()->setCellValue('B5', pg_result($resultado, $cont, 2));
			$objPHPExcel->getActiveSheet()->setCellValue('B6', pg_result($resultado, $cont, 4));
			$objPHPExcel->getActiveSheet()->setCellValue('B7', pg_result($resultado, $cont, 3));
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $contador, pg_result($resultado, $cont, 0));
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $contador, pg_result($resultado, $cont, 1));
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $contador, pg_result($resultado, $cont, 5));
		}
	}
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="datos hola.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
}
?>