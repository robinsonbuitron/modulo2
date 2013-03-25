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
			<link href="css/DT_bootstrap.css" rel="stylesheet">
			<script class="include" src="js/jquery-1.9.1.min.js"></script>
			<script class="include" src="js/bootstrap.min.js"></script>
			<script class="include" src="js/llenar_lectura.js"></script>
			<script src="js/jquery.validate.min.js"></script>
			<script src="js/jquery.dataTables.min.js"></script>
			<script src="js/jquery.validate.min.js"></script>
			<script src="js/messages_es.js"></script>
			<script src="js/DT_bootstrap.js"></script>
			<style>
				body #myModal {
					/* new custom width */
					width: 750px;
					/* must be half of the width, minus scrollbar on the left (30px) */
					margin-left: -375px;
				}
			</style>
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

				<form id="frmInsertar" class="row-fluid">
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
										<option value='xx'>Todo</option>
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
										<optgroup label="Unico">
											<option value="119">Anual</option>
										</optgroup>
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
						</div>
						<div class="text-right">
							<a id="btnCargar" class='btn btn-success'>Cargar Datos</a>
							<a id="btnDescargarExcel" class='btn btn-info'>Descargar Excel</a>
							<a id="btnCargarExcel" class='btn btn-warning'>Cargar Excel</a>
						</div>
					</div>
				</form>

				<div>
					<form id="tablaInstitucion">

					</form>
					<!--					<div id="myModal" class="modal hide fade form-horizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
													<h3 id="myModalLabel">Editar Indicador</h3>
												</div>
												<form class="modal-body" id="tablaInstitucion">
						
												</form>
												<div class="modal-footer">
													<button id="btnEditar" type="button" class="btn btn-primary">Editar</button>
													<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
												</div>
											</div>-->
				</div>
				<div id="resultado"></div>
			</div> <!-- /container -->
		</body>
	</html>
	<?php
}
?>