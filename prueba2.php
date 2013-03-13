
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Raphaël · Australia</title>
		<script src="js/jquery-1.9.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/raphael-min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="js/data_abancay.js"></script>
		<script type="text/javascript" src="js/dibujar.js"></script>
		<link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.min.css" />
		<!--		<link rel="stylesheet" type="text/css" media="all" href="css/style_mapa.css" />-->
	</head>
    <body>
		<div class="container">
			<div class="row-fluid">
				<div class="span12">
					<div class="span8">
						<div class="offset4 well form-horizontal">
							<div class="control-group">
								<label class="control-label">Tipo de Grafico:</label>
								<div class="controls">
									<select class="span10">
										<option>Mapas</option>
										<option>Barras</option>
										<option>Circulares</option>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Anio:</label>
								<div class="controls">
									<select class="span8">
										<option>2013</option>
										<option>2012</option>
										<option>2011</option>
									</select>
								</div>
							</div>
						</div>
						<div id="chaptersMap">
						</div>
					</div>
					<div class="span4">
						<div class="well">
							<strong>Leyenda</strong>
							<ul>
								<li>Bajo < 10%</li>
								<li>Medio <= 10% < 15%</li>
								<li>Alto 15%<=</li>
							</ul>
						</div>
						<div class="">
							<h4>Indicadores</h4>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th width="80%">Nombre Indicador</th>
										<th width="20%"></th>
									</tr>
								</thead>
								<tbody>
									<tr id="U0001">
										<td>Rendimiento Principales Cultivos</td>
										<td>
											<label class="text-center">
												<input type="radio" name="optionsRadios" value="option1">
											</label>
										</td>
									</tr>
									<tr id="U0001">
										<td>Intencion de Siembra por Cultivo</td>
										<td>
											<label class="text-center">
												<input type="radio" name="optionsRadios" value="option1" checked>
											</label>
										</td>
									</tr>
									<tr id="U0001">
										<td>Especies de Flora y Fauna Amenzada	</td>
										<td>
											<label class="text-center">
												<input type="radio" name="optionsRadios" value="option1">
											</label>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
    </body>
</html>
