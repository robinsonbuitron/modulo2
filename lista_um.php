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
				<th width="10%">id</th>
				<th width="10%">Unidad</th>
				<th width="50%">Descripcion</th>
				<th width="15%">Editar</th>
				<th width="15%">Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<?php
			include_once 'conexion/pgsql.php';
			$conexion = new ConexionPGSQL();
			$conexion->conectar();
			$resultado = $conexion->consulta("select idunidadmedida, abreviatura, descripcion from tunidadmedida");
			$filas = pg_numrows($resultado);
			if ($filas != 0) {
				for ($cont = 0; $cont < $filas; $cont++) {
					$idunidadmedida = pg_result($resultado, $cont, 0);
					$abreviatura = pg_result($resultado, $cont, 1);
					$descripcion = pg_result($resultado, $cont, 2);
					echo "<tr id='$idunidadmedida'>";
					echo "<td>$idunidadmedida</td>";
					echo "<td>$abreviatura</td>";
					echo "<td>$descripcion</td>";
					echo "<td><a href='#myModal' data-toggle='modal' class='btn-small btn-success'><i class='icon-edit'></i><strong> Editar</strong></a></td>";
					echo "<td><a href='#' class='btn-small btn-danger'><i class='icon-trash'></i><strong> Eliminar</strong></a></td>";
					echo "</tr>";
				}
			}
			?>
		</tbody>
	</table>
	<?php
}
?>