
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Raphaël · Australia</title>
		<script src="js/jquery-1.9.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/raphael-min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="js/data_abancay.js"></script>
		<script type="text/javascript" src="js/dibujar.js"></script>
		<script type="text/javascript" src="js/grafico.js"></script>
		<link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.min.css" />
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
									<select class="span5">
										<option>Mapas</option>
										<option>Barras</option>
										<option>Circulares</option>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Institucion:</label>
								<div class="controls">
									<select id="cbInstitucion" class="span6">
										<option style="color: blue" disabled selected>Elija una Institucion</option>
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
						<select>
							<option>2013</option>
							<option>2012</option>
							<option>2011</option>
						</select>
						<legend>Periodo</legend>
						<select id="cbPeriodo">
							<option style="color: blue" disabled selected>Elija un Periodo</option>
							<optgroup label="Unico">
								<option value="101">Anual</option>
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
						<select size="7">
							<option value="1" >Abancay</option>
							<option value="2">Andahuaylas</option>
							<option value="3">Antabamba</option>
							<option value="4">Aymaraes</option>
							<option value="5">Chicheros</option>
							<option value="6">Cotabambas</option>
							<option value="7">Grau</option>
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
