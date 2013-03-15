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
				<th width="5%%">id</th>
				<th width="20%">Institucion</th>
				<th width="30%">Indicador</th>
				<th width="10%">Unidad </th>
				<th width="10%">Valor_Min</th>
				<th width="10%">Valor_Max</th>
				<th width="10%">Editar</th>
				<th width="10%">Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<?php
			include_once 'conexion/pgsql.php';
			$conexion = new ConexionPGSQL();
			$conexion->conectar();
			$resultado = $conexion->consulta("select tid.idindicador, ti.siglas, tid.descripcion, tu.abreviatura, tid.valorminimo,tid.valormaximo from tindicador tid join tinstitucion ti on tid.idinstitucion=ti.idinstitucion join tunidadmedida tu on tu.idunidadmedida=tid.idunidadmedida");
			$filas = pg_numrows($resultado);
			if ($filas != 0) {
				for ($cont = 0; $cont < $filas; $cont++) {
					$idindicador = pg_result($resultado, $cont, 0);
					$institucion = pg_result($resultado, $cont, 1);
					$indicador = pg_result($resultado, $cont, 2);
					$unidadmedida = pg_result($resultado, $cont, 3);
					$valormin = pg_result($resultado, $cont, 4);
					$valormax = pg_result($resultado, $cont, 5);
					echo "<tr id='$idindicador'>";
					echo "<td>$idindicador</td>";
					echo "<td>$institucion</td>";
					echo "<td>$indicador</td>";
					echo "<td>$unidadmedida</td>";
					echo "<td>$valormin</td>";
					echo "<td>$valormax</td>";
					echo "<td><a href='#myModal' data-toggle='modal'>Editar</a></td>";
					echo "<td><a href='#'>Eliminar</a></td>";
					echo "</tr>";
				}
			}
			?>
		</tbody>
	</table>
	<?php
}
?>