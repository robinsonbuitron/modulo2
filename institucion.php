<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
                <link href="css/DT_bootstrap.css" rel="stylesheet">
		<script class="include" src="js/jquery-1.9.1.min.js"></script>
		<script class="include" src="js/bootstrap.min.js"></script>
		<script class="include" src="js/mantenimiento_institucion.js"></script>
                <script src="js/jquery.dataTables.min.js"></script>
		<script src="js/DT_bootstrap.js"></script>
    </head>
    <body>
		<div class="container">
			<div class="row-fluid">
				<div class="span12 well">
					<div class="span7 form-horizontal">
						<div class="control-group">
							<label class="control-label">Codigo: </label>
							<div class="controls">
                                                            <input id="txtidins" class="span6" type="text" placeholder="Codigo" disabled="">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Siglas : </label>
							<div class="controls">
								<input id="txtsiglas" class="span12" type="text" placeholder="Institucion">
							</div>
						</div>
					
						<div class="control-group">
					
                                                    <label class="control-label">Nombre Institucio: </label>
							<div class="controls">
								<input id="txtnominst" class="span12" type="text" placeholder="Abreviatura">
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
				<div id="tablaUsuarios">
					<?php include './lista_usuarios.php'; ?>
				</div>
				<div id="myModal" class="modal hide fade form-horizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="myModalLabel">Editar Institución</h3>
					</div>
					<div class="modal-body">
						<input id="txtId" type="hidden">
						<div class="control-group">
							<label class="control-label">Codigo:</label>
							<div class="controls">
								<input id="txtCodigoInsE" readonly type="text">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Institución:</label>
							<div class="controls">
								<input id="txtInstitucionE" type="text" class="span3" placeholder="Institucion">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Abreviatura:</label>
							<div class="controls">
								<input id="txtAbreviatura" type="text" placeholder="Abreviatura">
							</div>
						</div>
					
					</div>
					<div class="modal-footer">
						<button id="btnEditar" type="button" class="btn btn-primary">Agregar</button>
						<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
					</div>
				</div>
			</div>
		</div> <!-- /container -->
	</body>
</html>