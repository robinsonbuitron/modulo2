<?php
header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=NOMBRE.xls");
?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
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
		if (isset($_GET['provincia'])) {
			include_once 'conexion/pgsql.php';
			$conexion = new ConexionPGSQL();
			$conexion->conectar();
			$provincia = $_GET['provincia'];
			$idindicador = $_GET['idindicador'];
			$anio = $_GET['anio'];
			$idperiodo = $_GET['idperiodo'];
			if ($provincia == "xx") {
				$resultado = $conexion->consulta("
			select td.nombre, ti.descripcion, tl.anio, tp.descripcion, tl.valor
			from tlectura tl join tindicador ti on tl.idindicador=ti.idindicador
				join tperiodo tp on tl.idperiodo=tp.idperiodo
				join tprovincia td on tl.ubigeo=td.ubigeo
			where tl.idindicador='$idindicador' and tl.idperiodo='$idperiodo' and tl.anio='$anio'");
				$filas = pg_numrows($resultado);
				if ($filas != 0) {
					for ($cont = 0; $cont < $filas; $cont++) {
						print '<tr>';
						print '<td>' . pg_result($resultado, $cont, 0) . '</td>';
						print '<td>' . pg_result($resultado, $cont, 1) . '</td>';
						print '<td>' . pg_result($resultado, $cont, 2) . '</td>';
						print '<td>' . pg_result($resultado, $cont, 3) . '</td>';
						print '<td>' . pg_result($resultado, $cont, 4) . '</td>';
						print '</tr>';
					}
				}
			} else {
				$resultado = $conexion->consulta("
			select td.nombre, ti.descripcion, tl.anio, tp.descripcion, tl.valor
			from tlectura tl join tindicador ti on tl.idindicador=ti.idindicador
				join tperiodo tp on tl.idperiodo=tp.idperiodo
				join tdistrito td on tl.ubigeo=td.ubigeo
			where tl.idindicador='$idindicador' and tl.idperiodo='$idperiodo' and tl.anio='$anio' and td.codprovincia='$provincia'");
				$filas = pg_numrows($resultado);
				if ($filas != 0) {
					for ($cont = 0; $cont < $filas; $cont++) {
						print '<tr>';
						print '<td>' . pg_result($resultado, $cont, 0) . '</td>';
						print '<td>' . pg_result($resultado, $cont, 1) . '</td>';
						print '<td>' . pg_result($resultado, $cont, 2) . '</td>';
						print '<td>' . pg_result($resultado, $cont, 3) . '</td>';
						print '<td>' . pg_result($resultado, $cont, 4) . '</td>';
						print '</tr>';
					}
				}
			}
		}
		?>
	</tbody>
</table>