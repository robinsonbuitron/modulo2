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
				$idindicador = $_GET['idindicador'];
				$anio = $_GET['anio'];
				$idperiodo = $_GET['idperiodo'];
				if ($provincia == "xx") {
					$resultado = $conexion->consulta("select tl.ubigeo, td.nombre, ti.descripcion, tl.anio, tp.descripcion, tl.valor
														from tlectura tl join tindicador ti on tl.idindicador=ti.idindicador 
														join tprovincia td on td.ubigeo=tl.ubigeo
														join tperiodo tp on tp.idperiodo=tl.idperiodo 
														where tl.idindicador='$idindicador' and tl.anio='$anio' and tl.idperiodo='$idperiodo'");
				} else {
					$resultado = $conexion->consulta("select tl.ubigeo, td.nombre, ti.descripcion, tl.anio, tp.descripcion, tl.valor
														from tlectura tl join tindicador ti on tl.idindicador=ti.idindicador 
														join tdistrito td on td.ubigeo=tl.ubigeo
														join tperiodo tp on tp.idperiodo=tl.idperiodo 
														where tl.idindicador='$idindicador' and tl.anio='$anio' and tl.idperiodo='$idperiodo' and td.codprovincia='$provincia'");
				}
				$filas = pg_numrows($resultado);
				if ($filas != 0) {
					for ($cont = 0; $cont < $filas; $cont++) {
						$nombre = pg_result($resultado, $cont, 1);
						echo "<tr id='" . $ubigeo = pg_result($resultado, $cont, 0) . "'>";
						echo "<td>" . $ubigeo = pg_result($resultado, $cont, 1) . "</td>";
						echo "<td>" . $ubigeo = pg_result($resultado, $cont, 2) . "</td>";
						echo "<td>" . $ubigeo = pg_result($resultado, $cont, 3) . "</td>";
						echo "<td>" . $ubigeo = pg_result($resultado, $cont, 4) . "</td>";
						echo "<td><input class='span2' type='text' disabled value='" . $ubigeo = pg_result($resultado, $cont, 5) . "' /></td>";
						echo "</tr>";
					}
				} else {
					if ($provincia == "xx") {
						$resultado = $conexion->consulta("select ubigeo, nombre from tprovincia");
					} else {
						$resultado = $conexion->consulta("select ubigeo, nombre from tdistrito where codprovincia='$provincia'");
					}
					$filas = pg_numrows($resultado);
					$indicador = $_GET['indicador'];
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
			}
			?>
		</tbody>
	</table>
	<?php
}
?>