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
	$resultado1 = $conexion->consulta("select nombprivi from tprivilegios where idprivilegios='" . $_SESSION["s_idprivilegios"] . "'");
	$filas1 = pg_numrows($resultado1);
	if ($filas1 != 0) {
		for ($cont = 0; $cont < $filas1; $cont++) {
			$cargo = pg_result($resultado1, $cont, 0);
		}
	}
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
									<input id="txtNombre" class="span12" type="text" value="<?php echo $_SESSION["s_nameape"]; ?>" disabled="">  
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Sector/Institucion: </label>
								<div class="controls">
									<input id="txtSector" class="span8" type="text" value="<?php echo $siglas; ?>" disabled=""> 
								</div>
							</div>
						</div>
						<div class="span5 form-horizontal">
							<div class="control-group">
								<label class="control-label">Cargo: </label>
								<div class="controls">
									<input id="txtZona" class="span14" type="text"   value="<?php echo $cargo; ?>" disabled=""> 
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
									<select id="cbIndicador" class="span12">
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
									<select id="cbAnio" class="span12">
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
											<option value="101">Enero</option>
											<option value="102">Febrero</option>
											<option value="103">Marzo</option>
											<option value="104">Abril</option>
											<option value="105">Mayo</option>
											<option value="106">Junio</option>
											<option value="107">Julio</option>
											<option value="108">Agosto</option>
											<option value="109">Setiembre</option>
											<option value="110">Octubre</option>
											<option value="111">Noviembre</option>
											<option value="112">Diciembre</option>
										</optgroup>
										<optgroup label="Semestral">
											<option value="113">1er Semestre</option>
											<option value="114">2do Semestre</option>
										</optgroup>
										<optgroup label="Trimestral">
											<option value="115">1er Trimestre</option>
											<option value="116">2do Trimestre</option>
											<option value="117">3er Trimestre</option>
											<option value="118">4to Trimestre</option>
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
								<th width="40%">Indicador</th>
								<th width="15%">Localidad</th>
								<th width="5%">Anio</th>
								<th width="15%">Periodo</th>
								<th width="5%">Valor(%)</th>
								<th width="10%">Editar</th>
								<th width="10%">Eliminar</th>
							</tr>
						</thead>
						<tbody>
							<tr id="L0001">
								<td>Especie de Flora y Fauna amenazado</td>
								<td>Abancay</td>
								<td>2009</td>
								<td>Junio</td>
								<td>20.5%</td>
								<td><a href="#myModal" data-toggle="modal">Editar</a></td>
								<td><a href="#">Eliminar</a></td>
							</tr>
							<tr id="L0002">
								<td>Especie de Flora y Fauna amenazado</td>
								<td>Chalhuanca</td>
								<td>2011</td>
								<td>1er Semestre</td>
								<td>25.5%</td>
								<td><a href="#myModal" data-toggle="modal">Editar</a></td>
								<td><a href="#">Eliminar</a></td>
							</tr>
							<tr id="L0003">
								<td>Intencion por cultivo</td>
								<td>Andahuaylas</td>
								<td>2012</td>
								<td>2do Trimestre</td>
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
								<label class="control-label">Indicador:</label>
								<div class="controls">
									<input id="txtIndicadorE" readonly type="text">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Localidad:</label>
								<div class="controls">
									<input id="txtDistritoE" readonly type="text">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Anio:</label>
								<div class="controls">
									<input id="txtAnioE" readonly type="text">
								</div>
							</div>
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
							<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
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