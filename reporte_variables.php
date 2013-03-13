<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="css/DT_bootstrap.css" rel="stylesheet">
		<link href="datepicker/css/datepicker.css" rel="stylesheet">
		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="datepicker/js/bootstrap-datepicker.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/DT_bootstrap.js"></script>
    </head>
    <body>
		<form class="well form-inline" method="post" action="#">
			<label>Variable:</label>
			<select class="span4" name="IDVariable" id="variable">
				<option disabled>Elegir: </option>
				<option value='N_AIRTEMP'>TEMPERATURA DEL AIRE HORARIA</option>
				<option value='N_MINAT'>TEMPERATURA DEL AIRE MAXIMA DIARIA</option>
				<option value='N_MAXAT'>TEMPERATURA DEL AIRE MINIMA DIARIA</option>
				<option value='N_HUMEDAD'>HUMEDAD RELATIVA HORARIA</option>
				<option value='N_MINRH'>HUMEDAD RELATIVA MINIMA DIARIA</option>
				<option value='N_LLUVIA'>PRECIPITACION HORARIA</option>
				<option value='N_DAYRAIN'>PRECIPITACION DIARIA</option>
				<option value='N_MAXRH'>HUMEDAD RELATIVA MAXIMA DIARIA</option>
				<option value='N_PRESATM'>PRESION ATMOSFERICA HORARIA</option>
				<option value='N_RADSOLAR'>RADIACIÓN SOLAR HORARIA</option>
				<option value='N_VELVIENTO'>VELOCIDAD DEL VIENTO HORARIA</option>
				<option value='N_DIRVIENTO'>DIRECCION DEL VIENTO HORARIA</option>
				<option value='N_RACHA'>VELOCIDAD DE LA RACHA DIARIA</option>
				<option value='N_DIRRACHA'>DIRECCION DE LA RACHA DIARIA</option>
				<option value='N_HOJAHUMED'>HOJA HUMEDAD HORARIA</option>
				<option value='N_SUELOHUMED'>SUELO HUMEDO HORARIA</option>
				<option value='N_NIVELAGUA'>NIVEL DEL AGUA INSTANTANIA</option>
				<option value='N_MINNIVEL'>NIVEL DEL AGUA MINIMA DIARIA</option>
				<option value='N_MAXNIVEL'>NIVEL DEL AGUA MAXIMA DIARIA</option>
				<option value='N_NIVELMEDIO'>NIVEL DEL AGUA HORARIA</option>
				<option value='N_WTEMP'>TEMPERATURA DEL AGUA HORARIA</option>
				<option value='N_OXIGENO'>OXIGENO DISUELTO HORARIO</option>
				<option value='N_COND'>CONDUCTIVILIDAD HORARIA</option>
				<option value='N_RADSOLARHR'>RADIACIÓN SOLAR HORARIA2</option>
				<option value='N_AIRTEMP_INST'>TEMPERATURA DEL AIRE INSTANTANEA</option>
				<option value='N_HUMEDAD_INST'>HUMEDAD RELATIVA INSTANTANEA</option>
				<option value='N_SOILTEMP'>TEMPERATURA DEL SUELO HORARIA</option>
				<option value='N_RADSOLAR_TOT'>RADIACION SOLAR DIARIA</option>
				<option value='N_HOJAHUMED_INST'>HOJA HUMEDAD INSTANTANEA</option>
				<option value='N_SUELOHUMED_SECA'>HOJA HUMEDAD SECO HORARIA</option>
				<option value='N_CONSTELECT'>CONSTANTE ELECTRICA HORARIA</option>
				<option value='N_MAXCONDH'>CONDUCTIVILIDAD MAXIMA HORARIA</option>
				<option value='N_MAXCONDD'>CONDUCTIVILIDAD MAXIMA DIARIA</option>
				<option value='N_MINCONDH'>CONDUCTIVILIDAD MINIMA HORARIA</option>
				<option value='N_MINCONDD'>CONDUCTIVILIDAD MINIMA DIARIA</option>
				<option value='N_MAXNIVELH'>NIVEL DEL AGUA MAXIMA HORARIA</option>
				<option value='N_MINNIVELH'>NIVEL DEL AGUA MINIMA HORARIA</option>
				<option value='N_MAXOXIGH'>OXIGENO DISUELTO MAXIMO HORARIO***************</option>
				<option value='N_MAXOXIGD'>OXIGENO DISUELTO MAXIMO DIARIO</option>
				<option value='N_MINOXIGH'>OXIGENO DISUELTO MINIMO HORARIO</option>
				<option value='N_MINOXIGD'>OXIGENO DISUELTO MINIMO DIARIO</option>
				<option value='N_PHH'>PH HORARIO</option>
				<option value='N_MAXPHH'>PH MAXIMO HORARIO</option>
				<option value='N_MAXPHD'>PH MAXIMO DIARIO</option>
				<option value='N_MINPHH'>PH MINIMO HORARIO</option>
				<option value='N_MINPHD'>PH MINIMO DIARIO</option>
				<option value='N_LLUVIA_INST'>PRECIPITACION INSTANTANEA</option>
				<option value='N_MAXWTEMPH'>TEMPERATURA DEL AGUA MAXIMA HORARIA</option>
				<option value='N_MAXWTEMPD'>TEMPERATURA DEL AGUA MAXIMA DIARIA</option>
				<option value='N_MINWTEMPH'>TEMPERATURA DEL AGUA MINIMA HORARIA</option>
				<option value='N_MINWTEMPD'>TEMPERATURA DEL AGUA MINIMA DIARIA</option>
				<option value='N_TURBH'>TURBIDEZ DEL AGUA HORARIA</option>
				<option value='N_MAXTURBH'>TURBIDEZ DEL AGUA MAXIMA HORARIA</option>
				<option value='N_MAXTURBD'>TURBIDEZ DEL AGUA MAXIMA DIARIA</option>
				<option value='N_MINTURBH'>TURBIDEZ DEL AGUA MINIMA HORARIA</option>
				<option value='N_MINTURBD'>TURBIDEZ DEL AGUA MINIMA DIARIA</option>
				<option value='N_MAXRHH'>HUMEDAD RELATIVA MAXIMA HORARIA</option>
				<option value='N_MINRHH'>HUMEDAD RELATIVA MINIMA HORARIA</option>
				<option value='N_MAXPRESATMH'>PRESION ATMOSFERICA MAXIMO HORARIA</option>
				<option value='N_MAXPRESATMD'>PRESION ATMOSFERICA MAXIMO DIARIA</option>
				<option value='N_MINPRESATMH'>PRESION ATMOSFERICA MINIMO HORARIA</option>
				<option value='N_MINPRESATMD'>PRESION ATMOSFERICA MINIMO DIARIA</option>
				<option value='N_RAIN_00M'>PRECIPITACION A LOS 00 MINUTOS</option>
				<option value='N_RAIN_10M'>PRECIPITACION A LOS 10 MINUTOS</option>
				<option value='N_RAIN_20M'>PRECIPITACION A LOS 20 MINUTOS</option>
				<option value='N_RAIN_30M'>PRECIPITACION A LOS 30 MINUTOS</option>
				<option value='N_RAIN_40M'>PRECIPITACION A LOS 40 MINUTOS</option>
				<option value='N_RAIN_50M'>PRECIPITACION A LOS 50 MINUTOS</option>
				<option value='N_RAIN_60M'>PRECIPITACION A LOS 60 MINUTOS</option>
				<option value='N_AIRTEMP_00M'>TEMPERATURA DEL AIRE A LOS 00 MINUTOS</option>
				<option value='N_AIRTEMP_10M'>TEMPERATURA DEL AIRE A LOS 10 MINUTOS</option>
				<option value='N_AIRTEMP_20M'>TEMPERATURA DEL AIRE A LOS 20 MINUTOS</option>
				<option value='N_AIRTEMP_30M'>TEMPERATURA DEL AIRE A LOS 30 MINUTOS</option>
				<option value='N_AIRTEMP_40M'>TEMPERATURA DEL AIRE A LOS 40 MINUTOS</option>
				<option value='N_AIRTEMP_50M'>TEMPERATURA DEL AIRE A LOS 50 MINUTOS</option>
				<option value='N_AIRTEMP_60M'>TEMPERATURA DEL AIRE A LOS 60 MINUTOS</option>
				<option value='N_MAXATH'>TEMPERATURA DEL AIRE MAXIMA HORARIO</option>
				<option value='N_MINATH'>TEMPERATURA DEL AIRE MAXIMA DIARA</option>
				<option value='N_HS101'>HORAS DEL SOL HORARIA</option>
				<option value='N_MAXVELVIENTO'>VELOCIDAD DEL VIENTO DIARIA</option>
				<option value='N_MAXDIRVIENTO'>DIRECCION DEL VIENTO DIARIA</option>
			</select>

			<label>Fecha Inicio:</label>
			<div class="input-append date" id="dp3" data-date="2013-02-14" data-date-format="yyyy-mm-dd">
				<input name="fechaInicio" class="span2" size="16" type="text" value="2013-02-14" readonly>
				<span class="add-on"><i class="icon-calendar"></i></span>
			</div>
			<label>Fecha Fin:</label>
			<div class="input-append date" id="dp4" data-date="2013-02-15" data-date-format="yyyy-mm-dd">
				<input name="fechaFin" class="span2" size="16" type="text" value="2013-02-15" readonly>
				<span class="add-on"><i class="icon-calendar"></i></span>
			</div>
			<button name="enviar" type="submit" class="btn btn-primary">Filtrar</button>
		</form>
		<?php
		if (isset($_POST['enviar'])) {
			require('conexion/pgsql.php');
			?>
			<div class="span12">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
					<thead>
						<tr>
							<th class="span1">Nro</th>
							<th class="span4">Estacion</th>
							<th class="span4">Variable</th>
							<th class="span2">Fecha</th>
							<th class="span1">Valor</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$conexion = new ConexionPGSQL();
						$conexion->conectar();

						$IDVariable = $_POST['IDVariable'];
						$fechaInicio = $_POST['fechaInicio'];
						$fechaFin = $_POST['fechaFin'];

						$resultado = $conexion->consulta("select * from sprConsultaEntreFechasVariable('$IDVariable','$fechaInicio','$fechaFin')");
						if (!$resultado) {
							echo "<b>Error de busqueda</b>";
							exit;
						}
						$contador = 1;
						$filas = pg_numrows($resultado);
						if ($filas == 0) {
							echo "No se encontro ningun registro\n";
							exit;
						} else {
							$dataPlotSTChapimarca = array();
							$dataPlotPunanqui = array();
							$dataPlotAntabamba = array();
							$dataPlotHuacullo = array();
							$contador = 1;
							for ($cont = 0; $cont < $filas; $cont++) {
								$estacion = pg_result($resultado, $cont, 0);
								$variable = pg_result($resultado, $cont, 1);
								$fecha = pg_result($resultado, $cont, 2);
								$valor = pg_result($resultado, $cont, 3);
								if (((float) $valor) != -999.00) {
									if ($estacion == 'SANTA ROSA CHAPIMARCA') {
										array_push($dataPlotSTChapimarca, array($fecha, (float) $valor));
									}
									if ($estacion == 'PUNANQUI') {
										array_push($dataPlotPunanqui, array($fecha, (float) $valor));
									}
									if ($estacion == 'ANTABAMBA') {
										array_push($dataPlotAntabamba, array($fecha, (float) $valor));
									}
									if ($estacion == 'HUACULLO') {
										array_push($dataPlotHuacullo, array($fecha, (float) $valor));
									}
								}
								echo '<tr>';
								echo '<td>' . $contador . '</td>';
								echo '<td>' . $estacion . '</td>';
								echo '<td>' . $variable . '</td>';
								echo '<td>' . $fecha . '</td>';
								echo '<td>' . $valor . '</td>';
								echo '</tr>';
								$contador++;
							}
						}
						?>
					</tbody>
				</table>
				<a class="btn btn-success" href="excel_variables.php?<?php echo 'idVariable=' . $IDVariable . '&fechaInicio=' . $fechaInicio . '&fechaFin=' . $fechaFin; ?>" >Exportar a Excel</a>
			</div>
			<br/>
			<div id="chartHuacullo" class="span8" style="width: 600px; height: 400px;"></div>
			<div id="chartAntabamba" class="span8" style="width: 600px; height: 400px;"></div>
			<div id="chartSTChapimarca" class="span8" style="width: 600px; height: 400px;"></div>
			<div id="chartPunanqui" class="span8" style="width: 600px; height: 400px;"></div>
			<script type="text/javascript" src="jqplot/jquery.jqplot.min.js"></script>
			<link rel="stylesheet" type="text/css" href="jqplot/jquery.jqplot.min.css" />
			<script language="javascript" type="text/javascript" src="jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
			<script language="javascript" type="text/javascript" src="jqplot/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
			<script language="javascript" type="text/javascript" src="jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script>
			<script language="javascript" type="text/javascript" src="jqplot/plugins/jqplot.cursor.min.js"></script>
			<?php
		}
		?>
		<script type="text/javascript" >
			$(document).ready(function () {
				var today = new Date();
				var anio=today.getFullYear();
				var mes=today.getMonth()+1;
				var dia=today.getDate();
				var fecha = anio + "-" + (mes<10?"0"+mes:mes) + "-" + (dia<10?"0"+dia:dia);
				$('#dp3').data({date: fecha}).datepicker('update').children("input").val(fecha);
				$('#dp4').data({date: fecha}).datepicker('update').children("input").val(fecha);
				$('#dp3').datepicker().on('changeDate', function(ev){
					$('#dp3').datepicker('hide');
				});;
				$('#dp4').datepicker().on('changeDate', function(ev){
					$('#dp4').datepicker('hide');
				});
<?php
if (isset($_POST['enviar'])) {
	?>
				$("#variable").val("<?php echo $IDVariable; ?>");
				$.jqplot.config.enablePlugins = true;
	<?php
	echo 'var dataHuacullo=' . json_encode($dataPlotHuacullo) . ';';
	echo 'var dataPunanqui=' . json_encode($dataPlotPunanqui) . ';';
	echo 'var dataAntabamba=' . json_encode($dataPlotAntabamba) . ';';
	echo 'var dataSTChapimarca=' . json_encode($dataPlotSTChapimarca) . ';';
	echo 'var title=$("#variable option[value=' . $IDVariable . ']").text();';
	//echo 'var title="hola";';
	?>
				var plot1 = $.jqplot('chartHuacullo', [dataHuacullo], {
					title:"HUACULLO - "+title,
					axes:{
						xaxis:{
							renderer:$.jqplot.DateAxisRenderer, 
							rendererOptions:{
								tickRenderer:$.jqplot.CanvasAxisTickRenderer
							},
							tickOptions:{ 
								fontSize:'10pt', 
								fontFamily:'Tahoma', 
								angle:-40
							}
						},
						yaxis:{
							rendererOptions:{
								tickRenderer:$.jqplot.CanvasAxisTickRenderer},
							tickOptions:{
								fontSize:'10pt', 
								fontFamily:'Tahoma', 
								angle:30
							}
						}
					},
					series:[{ lineWidth:4, markerOptions:{ style:'square' } }],
					cursor:{
						zoom:true,
						looseZoom: true
					}
				});
											
				var plot2 = $.jqplot('chartAntabamba', [dataAntabamba], {
					title:"ANTABAMBA - "+title,
					axes:{
						xaxis:{
							renderer:$.jqplot.DateAxisRenderer, 
							rendererOptions:{
								tickRenderer:$.jqplot.CanvasAxisTickRenderer
							},
							tickOptions:{ 
								fontSize:'10pt', 
								fontFamily:'Tahoma', 
								angle:-40
							}
						},
						yaxis:{
							rendererOptions:{
								tickRenderer:$.jqplot.CanvasAxisTickRenderer},
							tickOptions:{
								fontSize:'10pt', 
								fontFamily:'Tahoma', 
								angle:30
							}
						}
					},
					series:[{ lineWidth:4, markerOptions:{ style:'square' } }],
					cursor:{
						zoom:true,
						looseZoom: true
					}
				});
											
				var plot3 = $.jqplot('chartPunanqui', [dataPunanqui], {
					title:"ANTABAMBA - "+title,
					axes:{
						xaxis:{
							renderer:$.jqplot.DateAxisRenderer, 
							rendererOptions:{
								tickRenderer:$.jqplot.CanvasAxisTickRenderer
							},
							tickOptions:{ 
								fontSize:'10pt', 
								fontFamily:'Tahoma', 
								angle:-40
							}
						},
						yaxis:{
							rendererOptions:{
								tickRenderer:$.jqplot.CanvasAxisTickRenderer},
							tickOptions:{
								fontSize:'10pt', 
								fontFamily:'Tahoma', 
								angle:30
							}
						}
					},
					series:[{ lineWidth:4, markerOptions:{ style:'square' } }],
					cursor:{
						zoom:true,
						looseZoom: true
					}
				});
											
				var plot4 = $.jqplot('chartSTChapimarca', [dataSTChapimarca], {
					title:"ANTABAMBA - "+title,
					axes:{
						xaxis:{
							renderer:$.jqplot.DateAxisRenderer, 
							rendererOptions:{
								tickRenderer:$.jqplot.CanvasAxisTickRenderer
							},
							tickOptions:{ 
								fontSize:'10pt', 
								fontFamily:'Tahoma', 
								angle:-40
							}
						},
						yaxis:{
							rendererOptions:{
								tickRenderer:$.jqplot.CanvasAxisTickRenderer},
							tickOptions:{
								fontSize:'10pt', 
								fontFamily:'Tahoma', 
								angle:30
							}
						}
					},
					series:[{ lineWidth:4, markerOptions:{ style:'square' } }],
					cursor:{
						zoom:true,
						looseZoom: true
					}
				});
	<?php
}
?>
	});
		</script>
    </body>
</html>
