
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>MAPAS-SIARAPURIMAC</title>
		<link rel="stylesheet" type="text/css" href="jqplot/jquery.jqplot.min.css" />
		<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="../excanvas.js"></script><![endif]-->
		<script src="js/jquery-1.9.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="jqplot/jquery.jqplot.min.js"></script>
		<script type="text/javascript" src="jqplot/plugins/jqplot.pieRenderer.min.js"></script>
		<script src="js/raphael-min.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.min.css" />
		<script type="text/javascript" src="jqplot/plugins/jqplot.barRenderer.min.js"></script>
		<script type="text/javascript" src="jqplot/plugins/jqplot.pieRenderer.min.js"></script>
		<script type="text/javascript" src="jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
		<script type="text/javascript" src="jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
		<script type="text/javascript" src="jqplot/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
		<script type="text/javascript" src="jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script>
		<script type="text/javascript" src="jqplot/plugins/jqplot.pointLabels.min.js"></script>
		<script type="text/javascript" src="jqplot/plugins/jqplot.donutRenderer.min.js"></script>
		<script type="text/javascript" src="js/grafico.js"></script>
	</head>
    <body>
		<div class="container">
			<div class="row-fluid">
				<div class="span12 well">
					<div class="row-fluid">
						<div class="span8 form-horizontal">
							<div class="control-group">
								<label class="control-label">Tipo de Grafico:</label>
								<div class="controls">
									<select id="cbGrafico" class="span5">
										<option value="01">Mapas</option>
										<option value="02">Barras</option>
										<option value="03">Circulares</option>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Institucion:</label>
								<div class="controls">
									<select id="cbInstitucion" class="span6">

									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Indicadores:</label>
								<div class="controls">
									<select id="cbIndicador" class="span8">
									</select>
								</div>
							</div>
						</div>
						<div class="span4">
							<legend>Leyenda</legend>
							<div id="leyenda">

							</div>
						</div>

					</div>

				</div>
				<div class="row-fluid">
					<div class="span3">
						<legend>Año</legend>
						<select id="cbAnio">
							<option>2013</option>
							<option>2012</option>
							<option>2011</option>
						</select>
						<legend>Periodo</legend>
						<select id="cbPeriodo">
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
						<legend>Localidad</legend>
						<select id="cbProvincia" size="8">
							<option selected value="xx" >Todo Apurimac</option>
						</select>
					</div>
					<div class="span9 text-center">
						<div id="chaptersMap">
						</div>
					</div>
				</div>
			</div>
		</div>
    </body>
</html>
