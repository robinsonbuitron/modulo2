<?php
session_start();
if (!isset($_SESSION['s_username'])) {
	header('Location: index.php');
	exit();
} else {
	?>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
		<thead>
			<tr>
				<th width="10%">E-mail</th>
				<th width="30%">Nombre y Apellidos</th>
				<th width="14%">Institucion</th>
				<th width="22%">Cargo</th>
				<th width="11%">Editar</th>
				<th width="13%">Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<?php
			include_once 'conexion/pgsql.php';
			$conexion = new ConexionPGSQL();
			$conexion->conectar();
			$resultado = $conexion->consulta("select tu.idusuario, ti.siglas, tp.nombprivi, tu.nomape from tusuario tu join tinstitucion ti on tu.idinstitucion=ti.idinstitucion join tprivilegios tp on tp.idprivilegios=tu.idprivilegios where tu.idusuario!='yarghu@gmail.com'");
			$filas = pg_numrows($resultado);
			if ($filas != 0) {
				for ($cont = 0; $cont < $filas; $cont++) {
					$dni = pg_result($resultado, $cont, 0);
					$institucion = pg_result($resultado, $cont, 1);
					$cargo = pg_result($resultado, $cont, 2);
					$nombre = pg_result($resultado, $cont, 3);
					echo "<tr id='$dni'>";
					echo "<td>$dni</td>";
					echo "<td>$nombre</td>";
					echo "<td>$institucion</td>";
					echo "<td>$cargo</td>";
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