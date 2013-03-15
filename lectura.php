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
			<script class="include" src="js/jquery-1.9.1.min.js"></script>
			<script class="include" src="js/bootstrap.min.js"></script>
			<script class="include" src="js/mantenimiento_lectura.js"></script>
			<script type="text/javascript">
				$(function() {
					$("#menuLectura").addClass("active");
				});
			</script>
		</head>
		<body>
			<?php include './menu.php'; ?>
			<div class="container">
				<div class="row-fluid">
					<div class="span12 well">
						<div class="span7 form-horizontal">
							<div class="control-group">
								<label class="control-label">Nombre: </label>
								<div class="controls">
									<input id="txtNombre" class="span12" type="text" value="JUAN PEREZ PEREZ" disabled="">  
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Sector/Institucion: </label>
								<div class="controls">
									<input id="txtSector" class="span8" type="text" value="ATFFS" disabled=""> 
								</div>
							</div>
						</div>
						<div class="span5 form-horizontal">
							<div class="control-group">
								<label class="control-label">Cargo: </label>
								<div class="controls">
									<input id="txtZona" class="span14" type="text"   value="ADMINISTRADOR" disabled=""> 
								</div>
							</div>

						</div>

					</div>
				</div>

				<div class="row-fluid">
					<div class="span12 well">
						<div class="span7 form-horizontal">
							<div class="control-group">
								<label class="control-label">Seleccione Indicador: </label>
								<div class="controls">
									<select id="cbindicador" class="span12">
										<option>Especie de Flora y Fauna amenazado</option>
										<option>Intencion por cultivo</option>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Provincia : </label>
								<div class="controls">
									<select id="cbProvincia">

									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Distrito : </label>
								<div class="controls">
									<select id="cbDistrito">

									</select>
								</div>
							</div>
						</div>
						<div class="span5 form-horizontal">
							<div class="control-group">
								<label class="control-label">Anio: </label>
								<div class="controls">
									<select id="cbPeriodo" class="span12">
										<option>2017</option>
										<option>2016</option>
										<option>2015</option>
										<option>2014</option>
										<option>2013</option>
										<option selected>2013</option>
										<option>2012</option>
										<option>2011</option>
										<option>2010</option>
										<option>2009</option>
										<option>2008</option>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Periodo: </label>
								<div class="controls">
									<select id="cbPeriodo" class="span12">
										<option style="color: blue" disabled selected>Elija un Periodo</option>
										<optgroup label="Mensual">
											<option>Enero</option>
											<option>Febrero</option>
											<option>Marzo</option>
											<option>Abril</option>
											<option>Mayo</option>
											<option>Junio</option>
											<option>Julio</option>
											<option>Agosto</option>
											<option>Setiembre</option>
											<option>Octubre</option>
											<option>Noviembre</option>
											<option>Diciembre</option>
										</optgroup>
										<optgroup label="Semestral">
											<option>1er Semestre</option>
											<option>2do Semestre</option>
										</optgroup>
										<optgroup label="Trimestral">
											<option>1er Trimestre</option>
											<option>2do Trimestre</option>
											<option>3er Trimestre</option>
											<option>4to Trimestre</option>
										</optgroup>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Valor (%): </label>
								<div class="controls">
									<input id="txtValor" class="span14" type="text" placeholder="Valor"  > 
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
					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
						<thead>
							<tr>
								<th width="40%">Periodo</th>
								<th width="18%">Valor(%)</th>
								<th width="10%">Editar</th>
								<th width="10%">Eliminar</th>
							</tr>
						</thead>
						<tbody>
							<tr id="L0001">
								<td>2009</td>
								<td>20.5%</td>
								<td><a href="#myModal" data-toggle="modal">Editar</a></td>
								<td><a href="#">Eliminar</a></td>
							</tr>
							<tr id="L0002">
								<td>20010</td>
								<td>25.5%</td>
								<td><a href="#myModal" data-toggle="modal">Editar</a></td>
								<td><a href="#">Eliminar</a></td>
							</tr>
							<tr id="L0003">
								<td>2013</td>
								<td>214.5%</td>
								<td><a href="#myModal" data-toggle="modal">Editar</a></td>
								<td><a href="#">Eliminar</a></td>
							</tr>
						</tbody>
					</table>
					<div id="myModal" class="modal hide fade form-horizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h3 id="myModalLabel">Editar Indicador</h3>
						</div>
						<div class="modal-body">
							<input id="txtId" type="hidden">
							<div class="control-group">
								<label class="control-label">Pediodo:</label>
								<div class="controls">
									<input id="txtPeriodoE" readonly type="text">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Valor(%):</label>
								<div class="controls">
									<input id="txtValorE" type="text" class="span3" placeholder="Valor(%)">
								</div>
							</div>


						</div>
						<div class="modal-footer">
							<button id="btnEditar" type="button" class="btn btn-primary">Agregar</button>
							<button class="btnClose" data-dismiss="modal" aria-hidden="true">Cerrar</button>
						</div>
					</div>
				</div>
				<div id="prueba"></div>
			</div> <!-- /container -->
		</body>
	</html>
	<?php
}
?>