<?php

if (isset($_POST['tipo'])) {
	$tipo = $_POST['tipo'];
	if ($tipo == "metereologico") {
		require 'conexion/pgsql.php';
		$conexion = new ConexionPGSQL();
		$conexion->conectar();

		$IDEstacion = $_POST['idEstacion'];
		$fechaInicio = $_POST['fechaInicio'];
		$fechaFin = $_POST['fechaFin'];

		$resultado = $conexion->consulta("select * from sprConsultaEntreFechas('$IDEstacion','$fechaInicio','$fechaFin');");
		if (!$resultado) {
			echo "<b>Error de busqueda</b>";
			exit;
		}
		$dataPlotVariable1 = array();
		$dataPlotVariable2 = array();
		$dataPlotVariable3 = array();
		$dataPlotVariable4 = array();
		$dataPlotVariable5 = array();
		$dataPlotVariable6 = array();
		$dataPlotVariable7 = array();
		$dataPlotVariable8 = array();

		$title = "error";
		if ($IDEstacion == "472B16EA") {
			$title = "Estacion Metereologica de Huacullo";
		}
		if ($IDEstacion == "472B059C") {
			$title = "Estacion Metereologica de Antabamba";
		}

		$contador = 1;
		$filas = pg_numrows($resultado);
		if ($filas == 0) {
			echo "<div class='alert alert-error' id='mensaje'>";
			echo "<strong>Error:<strong> No se encontraron datos en esta estacion ";
			echo "</div>";
		} else {
			for ($cont = 0; $cont < $filas; $cont++) {
				//$estacion = pg_result($resultado, $cont, 0);
				$fecha = pg_result($resultado, $cont, 1);
				$variable1 = pg_result($resultado, $cont, 2);
				$variable2 = pg_result($resultado, $cont, 3);
				$variable3 = pg_result($resultado, $cont, 4);
				$variable4 = pg_result($resultado, $cont, 5);
				$variable5 = pg_result($resultado, $cont, 6);
				$variable6 = pg_result($resultado, $cont, 7);
				$variable7 = pg_result($resultado, $cont, 8);
				$variable8 = pg_result($resultado, $cont, 9);
				if (((float) $variable1) != -999.00) {
					array_push($dataPlotVariable1, array($fecha, (float) $variable1));
				}
				if (((float) $variable2) != -999.00) {
					array_push($dataPlotVariable2, array($fecha, (float) $variable2));
				}
				if (((float) $variable3) != -999.00) {
					array_push($dataPlotVariable3, array($fecha, (float) $variable3));
				}
				if (((float) $variable4) != -999.00) {
					array_push($dataPlotVariable4, array($fecha, (float) $variable4));
				}
				if (((float) $variable5) != -999.00) {
					array_push($dataPlotVariable5, array($fecha, (float) $variable5));
				}
				if (((float) $variable6) != -999.00) {
					array_push($dataPlotVariable6, array($fecha, (float) $variable6));
				}
				if (((float) $variable7) != -999.00) {
					array_push($dataPlotVariable7, array($fecha, (float) $variable7));
				}
				if (((float) $variable8) != -999.00) {
					array_push($dataPlotVariable8, array($fecha, (float) $variable8));
				}
				$contador++;
			}
			$jsondata['title'] = $title;
			$jsondata['data1'] = $dataPlotVariable1;
			$jsondata['data2'] = $dataPlotVariable2;
			$jsondata['data3'] = $dataPlotVariable3;
			$jsondata['data4'] = $dataPlotVariable4;
			$jsondata['data5'] = $dataPlotVariable5;
			$jsondata['data6'] = $dataPlotVariable6;
			$jsondata['data7'] = $dataPlotVariable7;
			$jsondata['data8'] = $dataPlotVariable8;
		}
	}
	//aqui se realiza el grafico para las estaciones hidrometricas
	if ($tipo == 'hidrometrico') {
		require 'conexion/pgsql.php';
		$conexion = new ConexionPGSQL();
		$conexion->conectar();

		$IDEstacion = $_POST['idEstacion'];
		$fechaInicio = $_POST['fechaInicio'];
		$fechaFin = $_POST['fechaFin'];

		$resultado = $conexion->consulta("select * from sprConsultaEntreFechasChapimarca('$IDEstacion','$fechaInicio','$fechaFin');");
		if (!$resultado) {
			echo "<b>Error de busqueda</b>";
			exit;
		}
		$dataPlotVariable1 = array();
		$dataPlotVariable2 = array();
		$dataPlotVariable3 = array();
		$dataPlotVariable4 = array();
		$dataPlotVariable5 = array();

		$title = "Estacion Hidrometereologica de Santa Rosa Chapimarca";

		$contador = 1;
		$filas = pg_numrows($resultado);
		if ($filas == 0) {
			echo "<div class='alert alert-error' id='mensaje'>";
			echo "<strong>Error:<strong> No se encontraron datos en esta estacion ";
			echo "</div>";
		} else {
			for ($cont = 0; $cont < $filas; $cont++) {
				//$estacion = pg_result($resultado, $cont, 0);
				$fecha = pg_result($resultado, $cont, 1);
				$variable1 = pg_result($resultado, $cont, 2);
				$variable2 = pg_result($resultado, $cont, 3);
				$variable3 = pg_result($resultado, $cont, 4);
				$variable4 = pg_result($resultado, $cont, 5);
				$variable5 = pg_result($resultado, $cont, 6);
				if (((float) $variable1) != -999.00) {
					array_push($dataPlotVariable1, array($fecha, (float) $variable1));
				}
				if (((float) $variable2) != -999.00) {
					array_push($dataPlotVariable2, array($fecha, (float) $variable2));
				}
				if (((float) $variable3) != -999.00) {
					array_push($dataPlotVariable3, array($fecha, (float) $variable3));
				}
				if (((float) $variable4) != -999.00) {
					array_push($dataPlotVariable4, array($fecha, (float) $variable4));
				}
				if (((float) $variable5) != -999.00) {
					array_push($dataPlotVariable5, array($fecha, (float) $variable5));
				}
				$contador++;
			}
			$jsondata['title'] = $title;
			$jsondata['data1'] = $dataPlotVariable1;
			$jsondata['data2'] = $dataPlotVariable2;
			$jsondata['data3'] = $dataPlotVariable3;
			$jsondata['data4'] = $dataPlotVariable4;
			$jsondata['data5'] = $dataPlotVariable5;
		}
	}
}
echo json_encode($jsondata);
?>
