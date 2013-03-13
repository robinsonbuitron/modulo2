<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script class="include" src="js/jquery-1.9.1.min.js"></script>
		<script class="include" src="js/bootstrap.min.js"></script>
		<script class="include" src="js/mantenimiento_usuarios.js"></script>
    </head>
    <body>
		<div class="container">
			<div class="row-fluid">
				<div class="span12 well">
					<div class="span7 form-horizontal">
						<div class="control-group">
							<label class="control-label">DNI: </label>
							<div class="controls">
								<input id="txtCodigo" class="span6" type="text" placeholder="Codigo">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Nombre: </label>
							<div class="controls">
								<input id="txtNombre" class="span12" type="text" placeholder="Nombre">
							</div>
						</div>
					</div>
					<div class="span5 form-horizontal">
						<div class="control-group">
							<label class="control-label">Institucion: </label>
							<div class="controls">
								<select id="cbInstitucion" class="span12 cbInstitucion">
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Cargo: </label>
							<div class="controls">
								<select id="cbCargo" class="span10 cbCargo">
								</select>
							</div>
						</div>
					</div>
					<div class="text-right">
						<button id="btnAgregar" type="button" class="btn btn-primary">Agregar</button>
						<button type="button" class="btn">Limpiar</button>
					</div>
				</div>
			</div>
			<div>
				<div id="tablaUsuarios">
					<?php include './lista_usuarios.php'; ?>
				</div>
				<div id="myModal" class="modal hide fade form-horizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="myModalLabel">Editar Usuario</h3>
					</div>
					<div class="modal-body">
						<input id="txtId" type="hidden">
						<div class="control-group">
							<label class="control-label">Codigo:</label>
							<div class="controls">
								<input id="txtCodigoE" readonly type="text">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Nombre:</label>
							<div class="controls">
								<input id="txtNombreE" type="text" class="span3" placeholder="Nombre">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Institucion:</label>
							<div class="controls">
								<select id="cbInstitucionE" class="cbInstitucion">
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Cargo:</label>
							<div class="controls">
								<select id="cbCargoE" class="cbCargo">
								</select>
							</div>
						</div>
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