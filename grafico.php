
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>MAPAS-SIARAPURIMAC</title>
		<script src="js/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/raphael-min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/highcharts.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/modules/exporting.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.min.css" />
		<script type="text/javascript" src="js/grafico.js"></script>
		<style type="text/css">
            html,
            body {
                height: 100%;
            }
            #wrap {
                min-height: 100%;
                height: auto !important;
                height: 100%;
                margin: 0 auto -60px;
            }
            #push,
            #footer {
                height: 60px;
            }
            #footer {
                background-color: #f5f5f5;
            }
            @media (max-width: 767px) {
                #footer {
                    margin-left: -20px;
                    margin-right: -20px;
                    padding-left: 20px;
                    padding-right: 20px;
                }
            }

            .container .credit {
                margin: 20px 0;
            }
        </style>
	</head>
    <body>
		<div class="container">
			<div class="row-fluid">
				<div class="span12 well">
					<div class="row-fluid">
						<div class="span8 form-horizontal">
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
							<div class="control-group">
								<label class="control-label">Tipo de Grafico:</label>
								<div class="controls">
									<select id="cbGrafico" class="span5">
										<option value="01">Mapas</option>
										<option value="02">Barras</option>
										<option value="03">Circulares</option>
										<option value="04">Historico</option>
									</select>
								</div>
							</div>
						</div>
						<div class="span4">
							<legend id="tituloLeyenda">Leyenda</legend>
							<div id="leyenda">

							</div>
							<div class="text-right">
								<a id="btnExcel" class='btn btn-success'>Descargar Excel</a>
							</div>
						</div>

					</div>

				</div>
				<div class="row-fluid">
					<div class="span3">
						<legend>Año</legend>
						<select id="cbAnio">
							<option>2016</option>
							<option>2015</option>
							<option>2014</option>
							<option selected>2013</option>
							<option>2012</option>
							<option>2011</option>
							<option>2010</option>
							<option>2009</option>
							<option>2008</option>
							<option>2007</option>
							<option>2006</option>
							<option>2005</option>
							<option>2004</option>
							<option>2003</option>
							<option>2002</option>
							<option>2001</option>
							<option>2000</option>
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
		<div id="footer">
            <div class="container">
                <p class="muted credit">Gobierno Regional de Apurimac - <strong>Proyecto SIAR</strong> <a href="http://siar.regionapurimac.gob.pe/indicadores/grafico.php">Indicadores Apurimac</a></p>
            </div>
        </div>
    </body>
</html>
