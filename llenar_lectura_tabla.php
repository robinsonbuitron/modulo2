<?php
session_start();
if (!isset($_SESSION['s_username'])) {
	header('Location: index.php');
	exit();
} else {
	?>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
		<thead>
			<tr>
				<th width="20%">Localidad</th>
				<th width="30%">Indicador</th>
				<th width="10%">Anio</th>
				<th width="15%">Periodo</th>
				<th width="15%">Valor</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (isset($_GET['excel'])) {
				header("Content-Type: application/vnd.ms-excel");

				header("Expires: 0");

				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

				header("content-disposition: attachment;filename=NOMBRE.xls");
			}
			if (isset($_GET['provincia'])) {
				include_once 'conexion/pgsql.php';
				$conexion = new ConexionPGSQL();
				$conexion->conectar();
				$provincia = $_GET['provincia'];
				if ($provincia == "xx") {
					$resultado = $conexion->consulta("select ubigeo, nombre from tprovincia");
				} else {
					$resultado = $conexion->consulta("select ubigeo, nombre from tdistrito where codprovincia='$provincia'");
				}
				$filas = pg_numrows($resultado);
				$indicador = $_GET['indicador'];
				$anio = $_GET['anio'];
				$periodo = $_GET['periodo'];
				if ($filas != 0) {
					for ($cont = 0; $cont < $filas; $cont++) {
						$ubigeo = pg_result($resultado, $cont, 0);
						$nombre = pg_result($resultado, $cont, 1);
						echo "<tr id='$ubigeo'>";
						echo "<td>$nombre</td>";
						echo "<td>$indicador</td>";
						echo "<td>$anio</td>";
						echo "<td>$periodo</td>";
						echo "<td><input class='span2' name='txtValor' type='text' /></td>";
						echo "</tr>";
					}
				}
			}
			?>
		</tbody>
	</table>
	<?php
}
?>