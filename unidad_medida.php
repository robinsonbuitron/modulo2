<?php
session_start();
if (!isset($_SESSION['s_username'])) {
	header('Location: login.php');
	exit();
} else {
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
			<script class="include" src="js/mantenimiento_um.js"></script>
			<script src="js/jquery.dataTables.min.js"></script>
			<script src="js/DT_bootstrap.js"></script>
			<script type="text/javascript">
				$(function() {
					$("#menuUMedida").addClass("active");
				});
			</script>
		</head>
		<body>
			<?php include './menu.php'; ?>
			<div class="container">
				<div id="frmInsertar" class="row-fluid">
					<div class="span12 well">
						<div class="span7 form-horizontal">
							<div class="control-group">
								<label class="control-label">Unidad de medida: </label>
								<div class="controls">
									<input id="txtabreviatura" class="span12" type="text" placeholder="Unida de medida">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Descrpcion: </label>
								<div class="controls">
									<input id="txtdescripcion" class="span12" type="text" placeholder="Descripcion">
								</div>
							</div>
						</div>
						<div class="text-right">
							<button id="btnAgregar" type="button" class="btn btn-primary">Agregar</button>
							<button id="btnLimpiar"type="button" class="btn">Limpiar</button>
						</div>
					</div>
				</div>

				<div>
					<div id="tablaInstitucion">
						<?php include './lista_um.php'; ?>
					</div>
					<div id="myModal" class="modal hide fade form-horizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h3 id="myModalLabel">Editar Unidad de Medida</h3>
						</div>
						<div class="modal-body">
							<input id="txtId" type="hidden">
							<div class="control-group">
								<label class="control-label">Codigo:</label>
								<div class="controls">
									<input id="txtidunidadmedidaE" readonly type="text">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Sigla:</label>
								<div class="controls">
									<input id="txtabreviaturaE" type="text" class="span3" placeholder="Unidad de Medida">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Nombre de Institucion:</label>
								<div class="controls">
									<input id="txtdescripcionE" class="span4" type="text" placeholder="Descripcion">
								</div>
							</div>

						</div>
						<div class="modal-footer">
							<button id="btnEditar" type="button" class="btn btn-primary">Agregar</button>
							<button class="btnCerrar" data-dismiss="modal" aria-hidden="true">Cerrar</button>
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