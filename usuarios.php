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
			<script src="js/jquery.validate.min.js"></script>
			<script src="js/messages_es.js"></script>
			<script src="js/jquery.dataTables.min.js"></script>
			<script src="js/DT_bootstrap.js"></script>
			<script src="js/mantenimiento_usuarios.js"></script>
		</head>
		<body>
			<div class="container">
				<div class="alert alert-success">Bienvenido: <?php echo $_SESSION['s_username']; ?> puede cerrar session<a class="btn btn-link" href="logout.php">aqui</a></div>
				<form id="formInsertar" class="row-fluid">
					<div class="span12 well">
						<div class="span7 form-horizontal">
							<div class="control-group">
								<label class="control-label">DNI: </label>
								<div class="controls">
									<input id="txtCodigo" name="txtCodigo" maxlength="8" class="span6" type="text" placeholder="Codigo">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Nombre: </label>
								<div class="controls">
									<input id="txtNombre" name="txtNombre" class="span12" type="text" placeholder="Nombre">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Contraseña: </label>
								<div class="controls">
									<input id="txtPassword" name="txtPassword" type="password" placeholder="contraseña">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Confimar contraseña: </label>
								<div class="controls">
									<input id="txtPasswordR" name="txtPasswordR" type="password" placeholder="confirmar contraseña">
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
							<button id="btnLimpiar" type="button" class="btn">Limpiar</button>
						</div>
					</div>
				</form>
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
									<input id="txtNombreE" type="text" class="span3" placeholder="nombre">
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
	<?php
}
?>