<?php
header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=NOMBRE.xls");

if (isset($_GET['idEstacion'])) {
	$IDEstacion = $_GET['idEstacion'];
	$fechaInicio = $_GET['fechaInicio'];
	$fechaFin = $_GET['fechaFin'];
	if ($IDEstacion == "472B16EA" || $IDEstacion == "472B059C") {
		?>
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
			<thead>
				<tr>
					<th class="span1">Nro</th>
					<th class="span2">Estacion</th>
					<th class="span3">Fecha</th>
					<th class="span1">TempMax</th>
					<th class="span1">TempMin</th>
					<th class="span1">Humedad</th>
					<th class="span1">HumeMax</th>
					<th class="span1">HumeMin</th>
					<th class="span1">PreciHoraria</th>
					<th class="span1">PreciDiaria</th>
					<th class="span1">Presion</th>
				</tr>
			</thead>
			<tbody>
				<?php
				include "conexion/pgsql.php";
				$conexion = new ConexionPGSQL();
				$conexion->conectar();

				$resultado = $conexion->consulta("select * from sprConsultaEntreFechas('$IDEstacion','$fechaInicio','$fechaFin');");
				if (!$resultado) {
					echo "<b>Error de busqueda</b>";
					exit;
				}
				$contador = 1;
				$filas = pg_numrows($resultado);
				if ($filas == 0) {
					echo "No se encontro ningun registro\n";
					exit;
				} else {
					for ($cont = 0; $cont < $filas; $cont++) {
						$estacion = pg_result($resultado, $cont, 0);
						$fecha = pg_result($resultado, $cont, 1);
						$variable1 = pg_result($resultado, $cont, 2);
						$variable2 = pg_result($resultado, $cont, 3);
						$variable3 = pg_result($resultado, $cont, 4);
						$variable4 = pg_result($resultado, $cont, 5);
						$variable5 = pg_result($resultado, $cont, 6);
						$variable6 = pg_result($resultado, $cont, 7);
						$variable7 = pg_result($resultado, $cont, 8);
						$variable8 = pg_result($resultado, $cont, 9);
						echo '<tr>';
						echo '<td>' . $contador . '</td>';
						echo '<td>' . $estacion . '</td>';
						echo '<td>' . $fecha . '</td>';
						echo '<td>' . $variable1 . '</td>';
						echo '<td>' . $variable2 . '</td>';
						echo '<td>' . $variable3 . '</td>';
						echo '<td>' . $variable4 . '</td>';
						echo '<td>' . $variable5 . '</td>';
						echo '<td>' . $variable6 . '</td>';
						echo '<td>' . $variable7 . '</td>';
						echo '<td>' . $variable8 . '</td>';
						echo '</tr>';
						$contador++;
					}
				}
				?>
			</tbody>
		</table>
		<?php
	}
	if ($IDEstacion == "472AE494") {
		?>
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
			<thead>
				<tr>
					<th class="span1">Nro</th>
					<th class="span2">Estacion</th>
					<th class="span3">Fecha</th>
					<th class="span2">NivMaxAguaDiaria</th>
					<th class="span2">NivMinAguaDiaria</th>
					<th class="span2">NivMaxAguaHoraria</th>
					<th class="span2">NivMinAguaHoraria</th>
					<th class="span2">NivAguaInstantanea</th>
				</tr>
			</thead>
			<tbody>
				<?php
				include "conexion/pgsql.php";
				$conexion = new ConexionPGSQL();
				$conexion->conectar();

				$resultado = $conexion->consulta("select * from sprConsultaEntreFechasChapimarca('$IDEstacion','$fechaInicio','$fechaFin');");
				if (!$resultado) {
					echo "<b>Error de busqueda</b>";
					exit;
				}
				$contador = 1;
				$filas = pg_numrows($resultado);
				if ($filas == 0) {
					echo "No se encontro ningun registro\n";
					exit;
				} else {
					for ($cont = 0; $cont < $filas; $cont++) {
						$estacion = pg_result($resultado, $cont, 0);
						$fecha = pg_result($resultado, $cont, 1);
						$variable1 = pg_result($resultado, $cont, 2);
						$variable2 = pg_result($resultado, $cont, 3);
						$variable3 = pg_result($resultado, $cont, 4);
						$variable4 = pg_result($resultado, $cont, 5);
						$variable5 = pg_result($resultado, $cont, 6);
						echo '<tr>';
						echo '<td>' . $contador . '</td>';
						echo '<td>' . $estacion . '</td>';
						echo '<td>' . $fecha . '</td>';
						echo '<td>' . $variable1 . '</td>';
						echo '<td>' . $variable2 . '</td>';
						echo '<td>' . $variable3 . '</td>';
						echo '<td>' . $variable4 . '</td>';
						echo '<td>' . $variable5 . '</td>';
						echo '</tr>';
						$contador++;
					}
				}
				?>
			</tbody>
		</table>
		<?php
	}
}
?>
