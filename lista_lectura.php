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
				<th width="40%">Indicador</th>
				<th width="15%">Localidad</th>
				<th width="5%">Anio</th>
				<th width="11%">Periodo</th>
				<th width="5%">Valor</th>
				<th width="11%">Editar</th>
				<th width="13%">Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<?php
			include_once 'conexion/pgsql.php';
			$conexion = new ConexionPGSQL();
			$conexion->conectar();
			$indicador = $_POST['indicador'];
			$resultado = $conexion->consulta("select ti.idindicador||td.ubigeo||tl.anio||tp.idperiodo, ti.descripcion, td.nombre||' - Provincia', tl.anio, tp.descripcion, tl.valor
											from tlectura tl join tindicador ti on tl.idindicador=ti.idindicador 
												join tprovincia td on td.ubigeo=tl.ubigeo
												join tperiodo tp on tp.idperiodo=tl.idperiodo 
											where ti.idindicador='$indicador' and ti.idinstitucion='" . $_SESSION["s_idinstitucion"] . "' union select ti.idindicador||td.ubigeo||tl.anio||tp.idperiodo, ti.descripcion, td.nombre||' - Distrito', tl.anio, tp.descripcion, tl.valor
											from tlectura tl join tindicador ti on tl.idindicador=ti.idindicador 
												join tdistrito td on td.ubigeo=tl.ubigeo
												join tperiodo tp on tp.idperiodo=tl.idperiodo 
											where ti.idindicador='$indicador' and ti.idinstitucion='" . $_SESSION["s_idinstitucion"] . "'");
			$filas = pg_numrows($resultado);
			if ($filas != 0) {
				for ($cont = 0; $cont < $filas; $cont++) {
					$codigo = pg_result($resultado, $cont, 0);
					$indicador = pg_result($resultado, $cont, 1);
					$ubigeo = pg_result($resultado, $cont, 2);
					$anio = pg_result($resultado, $cont, 3);
					$periodo = pg_result($resultado, $cont, 4);
					$valor = pg_result($resultado, $cont, 5);
					echo "<tr id='$codigo'>";
					echo "<td>$indicador</td>";
					echo "<td>$ubigeo</td>";
					echo "<td>$anio</td>";
					echo "<td>$periodo</td>";
					echo "<td>$valor</td>";
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