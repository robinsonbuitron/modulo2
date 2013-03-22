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
				<th width="50%">Indicador</th>
				<th width="15%">Localidad</th>
				<th width="5%">Anio</th>
				<th width="15%">Periodo</th>
				<th width="15%">Valor</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (isset($_POST['provincia'])) {
				include_once 'conexion/pgsql.php';
				$conexion = new ConexionPGSQL();
				$conexion->conectar();
				$resultado = $conexion->consulta("select ubigeo, nombre from tprovincia");
				$filas = pg_numrows($resultado);
				$indicador = $_POST['indicador'];
				$anio = $_POST['anio'];
				$periodo = $_POST['periodo'];
				if ($filas != 0) {
					for ($cont = 0; $cont < $filas; $cont++) {
						$ubigeo = pg_result($resultado, $cont, 0);
						$nombre = pg_result($resultado, $cont, 1);
						echo "<tr id='$ubigeo'>";
						echo "<td>$indicador</td>";
						echo "<td>$nombre</td>";
						echo "<td>$anio</td>";
						echo "<td>$periodo</td>";
						echo "<td><input id='txtValor' class='span1' name='txtValor' type='text' /></td>";
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