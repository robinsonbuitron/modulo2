<?php
header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=NOMBRE.xls");
?>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
	<thead>
		<tr>
			<th class="span1">Nro</th>
			<th class="span4">Estacion</th>
			<th class="span4">Variable</th>
			<th class="span2">Fecha</th>
			<th class="span1">Valor</th>
		</tr>
	</thead>
	<tbody>
<?php
if (isset($_GET['idVariable'])) {
	$idVariable = $_GET['idVariable'];
	$fechaInicio = $_GET['fechaInicio'];
	$fechaFin = $_GET['fechaFin'];
	require('conexion/pgsql.php');
	$conexion = new ConexionPGSQL();
	$conexion->conectar();

	$resultado = $conexion->consulta("select * from sprConsultaEntreFechasVariable('$idVariable','$fechaInicio','$fechaFin')");
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
			$variable = pg_result($resultado, $cont, 1);
			$fecha = pg_result($resultado, $cont, 2);
			$valor = pg_result($resultado, $cont, 3);
			echo '<tr>';
			echo '<td>' . $contador . '</td>';
			echo '<td>' . $estacion . '</td>';
			echo '<td>' . $variable . '</td>';
			echo '<td>' . $fecha . '</td>';
			echo '<td>' . $valor . '</td>';
			echo '</tr>';
			$contador++;
		}
	}
}
?>
	</tbody>
</table>