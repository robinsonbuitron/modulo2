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
				<th width="10%">Codigo</th>
				<th width="18%">Siglas</th>
				<th width="40%">Nombre Institucion</th>
				<th width="10%">Editar</th>
				<th width="10%">Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<?php
			include_once 'conexion/pgsql.php';
			$conexion = new ConexionPGSQL();
			$conexion->conectar();
			$resultado = $conexion->consulta("select ti.idinstitucion, ti.siglas, ti.nominst from tinstitucion ti");
			$filas = pg_numrows($resultado);
			if ($filas != 0) {
				for ($cont = 0; $cont < $filas; $cont++) {
					$idinstitucion = pg_result($resultado, $cont, 0);
					$siglas = pg_result($resultado, $cont, 1);
					$nombinst = pg_result($resultado, $cont, 2);
					echo "<tr id='$idinstitucion'>";
					echo "<td>$idinstitucion</td>";
					echo "<td>$siglas</td>";
					echo "<td>$nombinst</td>";
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