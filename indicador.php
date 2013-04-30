<?php
session_start();
if (!isset($_SESSION['s_username'])) {
	header('Location: index.php');
	exit();
} else {
	include_once 'conexion/pgsql.php';
	$conexion = new ConexionPGSQL();
	$conexion->conectar();
	$resultado = $conexion->consulta("select Siglas from tinstitucion where idinstitucion='" . $_SESSION["s_idinstitucion"] . "'");
	$filas = pg_numrows($resultado);
	if ($filas != 0) {
		for ($cont = 0; $cont < $filas; $cont++) {
			$siglas = pg_result($resultado, $cont, 0);
		}
	}
	?>
	<!DOCTYPE html>
	<html lang="es">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<title></title>
			<link href="css/bootstrap.min.css" rel="stylesheet">
			<link href="css/DT_bootstrap.css" rel="stylesheet">
			<script class="include" src="js/jquery-1.9.1.min.js"></script>
			<script class="include" src="js/bootstrap.min.js"></script>
			<script src="js/jquery.dataTables.min.js"></script>
			<script src="js/jquery.validate.min.js"></script>
			<script src="js/messages_es.js"></script>
			<script src="js/DT_bootstrap.js"></script>
			<script class="include" src="js/mantenimiento_indicador.js"></script>
			<script type="text/javascript">
				$(function() {
					$("#menuIndicador").addClass("active");
				});
			</script>
		</head>
		<body>
			<?php include './menu.php'; ?>
			<div class="container">
				<form id="formInsertar" class="row-fluid">
					<div class="span12 well">
						<div class="span7 form-horizontal">
							<div class="control-group">
								<label class="control-label">Institucion: </label>
								<div class="controls">
									<input id="txtInstitucion" class="span8" type="text" value="<?php echo $siglas; ?>" disabled=""> 
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Ingrese Indicador: </label>
								<div class="controls">
									<input id="txtIndicador" name="txtIndicador" class="span12" type="text" placeholder="descripcion Indicador">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Unidad Medida: </label>
								<div class="controls">
									<select id="cbUnidadMedida" class="span12 cbUnidadMedida">
									</select>
								</div>
							</div>
						</div>
						<div class="span5 form-horizontal">
							<div class="control-group">
								<label class="control-label">Valor Minimo: </label>
								<div class="controls">
									<input id="txtValorMin" name="txtValorMin" class="span6" type="text" placeholder="Valor Minimo">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Valor Maximo: </label>
								<div class="controls">
									<input id="txtValorMax" name="txtValorMax" class="span6" type="text" placeholder="Valor Máximo">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Semaforización Rojo: </label>
								<div class="controls">
									<select id="cbColor" class="span6">
										<option value="minimo">Minimo</option>
										<option value="maximo">Maximo</option>
									</select>
								</div>
							</div>
						</div>
						<div class="text-right">
							<button id="btnAgregar" type="button" class="btn btn-primary">Agregar</button>
							<button id="btnLimpiar" type="button" class="btn">Limpiar</button>
						</div>
					</div>
				</form>
				<div>
					<div id="tablaUsuarios">
						<?php include './lista_indicador.php'; ?>
					</div>
					<div id="myModal" class="modal hide fade form-horizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h3 id="myModalLabel">Editar Indicador</h3>
						</div>
						<div class="modal-body">
							<form id="formEditar">
								<input id="txtId" type="hidden">
								<div class="control-group">
									<label class="control-label">Codigo:</label>
									<div class="controls">
										<input id="txtIdindicadorE" readonly type="text">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Institucion: </label>
									<div class="controls">
										<input id="txtInstitucionE" type="text" readonly> 
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Indicador:</label>
									<div class="controls">
										<input id="txtIndicadorE" name="txtIndicadorE" type="text" class="span3" placeholder="Descripcion Indicador">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Unidad Medida: </label>
									<div class="controls">
										<select id="cbUnidadMedidaE" class="cbUnidadMedida">
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Valor Minimo: </label>
									<div class="controls">
										<input id="txtValorMinE" name="txtValorMinE" class="span1" type="text" placeholder="Valor Minimo">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Valor Maximo: </label>
									<div class="controls">
										<input id="txtValorMaxE" name="txtValorMaxE"  class="span1" type="text" placeholder="Valor Máximo">
									</div>
								</div>
								<div class="control-group">
								<label class="control-label">Semaforización Rojo: </label>
								<div class="controls">
									<select id="cbColorE" class="span2">
										<option value="minimo">Minimo</option>
										<option value="maximo">Maximo</option>
									</select>
								</div>
							</div>
							</form>
						</div>
						<div class="modal-footer">
							<button id="btnEditar" type="button" class="btn btn-primary">Editar</button>
							<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
						</div>
					</div>
				</div>
				<div id="resultado">

				</div>
			</div> <!-- /container -->
		</body>
	</html>
	<?php
}
?>