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
		<script type="text/javascript">
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
				$("#btnFiltrar").click(function(){
					$("#chartVariable1").html("");
					$("#chartVariable2").html("");
					$("#chartVariable3").html("");
					$("#chartVariable4").html("");
					$("#chartVariable5").html("");
					$("#btnFiltrar").text("Procesando...");
					$("#btnFiltrar").attr("disabled","disabled");
					$("#exportar").attr("href","excel.php");
					$.post("estacion_metereologica.php", { idEstacion: $("#estacion").val(), fechaInicio: $("#txtFechaInicio").val(), fechaFin: $("#txtFechaFin").val() },
					function(data){
						$("#tablaCuerpo").html(data);
						$("#example").dataTable();
						$("#exportar").attr("href","excel.php?idEstacion="+$("#estacion").val()+"&fechaInicio="+$("#txtFechaInicio").val()+"&fechaFin="+$("#txtFechaFin").val());
					}, "html");
					if ($("#estacion").val()!='472AE494') {
						$.post("graficos.php", { tipo:'metereologico', idEstacion: $("#estacion").val(), fechaInicio: $("#txtFechaInicio").val(), fechaFin: $("#txtFechaFin").val() },
						function(data){
							$.jqplot.config.enablePlugins = true;
							var plot1 = $.jqplot('chartVariable1', [data.data1,data.data2], {
								title:data.title+" - Temperatura",
								axes:{
									xaxis:{
										renderer:$.jqplot.DateAxisRenderer,
										tickOptions:{formatString:'%b %#d, %#I %p'},
										min:$("#txtFechaInicio").val(),
										max:$("#txtFechaFin").val()
									},
									yaxis:{
										tickOptions:{
											formatString:'%.2f'
										}
									}
								},
								highlighter: {
									show: true,
									sizeAdjust: 7.5
								},
								series:[
									{label:'Temperatura Maxima'},
									{label:'Temperatura Minima'}
								],
								cursor: {
									//show: false,
									zoom:true,
									looseZoom: true
								},
								legend: {show:true, location: 'e'}
							});
							var plot2 = $.jqplot('chartVariable2', [data.data3, data.data4, data.data5], {
								title:data.title+" - Humedad",
								axes:{
									xaxis:{
										renderer:$.jqplot.DateAxisRenderer,
										tickOptions:{formatString:'%b %#d, %#I %p'},
										min:$("#txtFechaInicio").val(),
										max:$("#txtFechaFin").val()
									},
									yaxis:{
										tickOptions:{
											formatString:'%.2f'
										}
									}
								},
								highlighter: {
									show: true,
									sizeAdjust: 7.5
								},
								series:[
									{label:'Humedad'},
									{label:'Humedad Maxima'},
									{label:'Humedad Minima'}
								],
								cursor: {
									//show: false,
									zoom:true,
									looseZoom: true
								},
								legend: {show:true, location: 'e'}
							});
							var plot3 = $.jqplot('chartVariable3', [data.data6], {
								title:data.title+" - Precipitacion Horaria",
								axes:{
									xaxis:{
										renderer:$.jqplot.DateAxisRenderer,
										tickOptions:{formatString:'%b %#d, %#I %p'},
										min:$("#txtFechaInicio").val(),
										max:$("#txtFechaFin").val()
									},
									yaxis:{
										tickOptions:{
											formatString:'%.2f'
										}
									}
								},
								highlighter: {
									show: true,
									sizeAdjust: 7.5
								},
								series:[
									{label:'Precipitacion Horaria'}
								],
								cursor: {
									//show: false,
									zoom:true,
									looseZoom: true
								},
								legend: {show:true, location: 'e'}
							});
							var plot4 = $.jqplot('chartVariable4', [data.data7], {
								title:data.title+" - Precipitacion Diaria",
								axes:{
									xaxis:{
										renderer:$.jqplot.DateAxisRenderer,
										tickOptions:{formatString:'%b %#d, %#I %p'},
										min:$("#txtFechaInicio").val(),
										max:$("#txtFechaFin").val()
									},
									yaxis:{
										tickOptions:{
											formatString:'%.2f'
										}
									}
								},
								highlighter: {
									show: true,
									sizeAdjust: 7.5
								},
								series:[
									{label:'Precipitacion Diaria'}
								],
								cursor: {
									//show: false,
									zoom:true,
									looseZoom: true
								},
								legend: {show:true, location: 'e'}
							});
							var plot5 = $.jqplot('chartVariable5', [data.data8], {
								title:data.title+" - Presion",
								axes:{
									xaxis:{
										renderer:$.jqplot.DateAxisRenderer,
										tickOptions:{formatString:'%b %#d, %#I %p'},
										min:$("#txtFechaInicio").val(),
										max:$("#txtFechaFin").val()
									},
									yaxis:{
										tickOptions:{
											formatString:'%.2f'
										}
									}
								},
								highlighter: {
									show: true,
									sizeAdjust: 7.5
								},
								series:[
									{label:'Presion'}
								],
								cursor: {
									//show: false,
									zoom:true,
									looseZoom: true
								},
								legend: {show:true, location: 'e'}
							});
							$("#btnFiltrar").removeAttr("disabled");
							$("#btnFiltrar").text("Filtrar");
						}, "json");
					} else{
						$.post("graficos.php", { tipo:'hidrometrico', idEstacion: $("#estacion").val(), fechaInicio: $("#txtFechaInicio").val(), fechaFin: $("#txtFechaFin").val() },
						function(data){
							$("#chartVariable1").html("");
							$("#chartVariable2").html("");
							$("#chartVariable3").html("");
							$("#chartVariable4").html("");
							$("#chartVariable5").html("");
							$.jqplot.config.enablePlugins = true;
							var plot1 = $.jqplot('chartVariable1', [data.data1,data.data2], {
								title:data.title+" - Nivel de Agua Diaria",
								axes:{
									xaxis:{
										renderer:$.jqplot.DateAxisRenderer,
										tickOptions:{formatString:'%b %#d, %#I %p'},
										min:$("#txtFechaInicio").val(),
										max:$("#txtFechaFin").val()
									},
									yaxis:{
										tickOptions:{
											formatString:'%.2f'
										}
									}
								},
								highlighter: {
									show: true,
									sizeAdjust: 7.5
								},
								series:[
									{label:'Nivel agua maxima diaria'},
									{label:'Nivel agua minima diaria'}
								],
								cursor: {
									//show: false,
									zoom:true,
									looseZoom: true
								},
								legend: {show:true, location: 'e'}
							});
							var plot2 = $.jqplot('chartVariable2', [data.data3, data.data4], {
								title:data.title+" - Nivel de agua Horaria",
								axes:{
									xaxis:{
										renderer:$.jqplot.DateAxisRenderer,
										tickOptions:{formatString:'%b %#d, %#I %p'},
										min:$("#txtFechaInicio").val(),
										max:$("#txtFechaFin").val()
									},
									yaxis:{
										tickOptions:{
											formatString:'%.2f'
										}
									}
								},
								highlighter: {
									show: true,
									sizeAdjust: 7.5
								},
								series:[
									{label:'Nivel agua maxima horaria'},
									{label:'Nivel agua minima horaria'}
								],
								cursor: {
									//show: false,
									zoom:true,
									looseZoom: true
								},
								legend: {show:true, location: 'e'}
							});
							var plot3 = $.jqplot('chartVariable3', [data.data5], {
								title:data.title+" - Nivel agua instantanea",
								axes:{
									xaxis:{
										renderer:$.jqplot.DateAxisRenderer,
										tickOptions:{formatString:'%b %#d, %#I %p'},
										min:$("#txtFechaInicio").val(),
										max:$("#txtFechaFin").val()
									},
									yaxis:{
										tickOptions:{
											formatString:'%.2f'
										}
									}
								},
								highlighter: {
									show: true,
									sizeAdjust: 7.5
								},
								series:[
									{label:'Nivel agua instantanea'}
								],
								cursor: {
									//show: false,
									zoom:true,
									looseZoom: true
								},
								legend: {show:true, location: 'e'}
							});
							$("#btnFiltrar").removeAttr("disabled");
							$("#btnFiltrar").text("Filtrar");
						}, "json");
					}
					if ($("#estacion").val()=='472AF7E2') {
						$("#btnFiltrar").removeAttr("disabled");
						$("#btnFiltrar").text("Filtrar");
					}
				});
			});
		</script>
    </head>
    <body>
		<form class="well form-inline span12" method="post" action="#">
			<label>Estacion:</label>
			<select class="span3" name="IDEstacion" id="estacion">
				<option disabled>Elegir: </option>
				<option value='472AE494'>SANTA ROSA CHAPIMARCA</option>
				<option value='472AF7E2'>PUNANQUI</option>
				<option value='472B059C'>ANTABAMBA</option>
				<option value='472B16EA'>HUACULLO</option>
			</select>
			<label>Fecha Inicio:</label>
			<div class="input-append date" id="dp3" data-date-format="yyyy-mm-dd">
				<input id="txtFechaInicio" name="fechaInicio" class="span2" size="16" type="text" readonly>
				<span class="add-on"><i class="icon-calendar"></i></span>
			</div>
			<label>Fecha Fin:</label>
			<div class="input-append date" id="dp4" data-date-format="yyyy-mm-dd">
				<input id="txtFechaFin" name="fechaFin" class="span2" size="16" type="text" readonly>
				<span class="add-on"><i class="icon-calendar"></i></span>
			</div>
			<button id="btnFiltrar" name="enviar" type="button" class="btn btn-primary">Filtrar</button>
			<a id="exportar" class="btn btn-success" href="excel.php" >Exportar a Excel</a>
		</form>
		<div class="well span12" id="tablaCuerpo">

		</div>
		<div>
			<div id="chartVariable1" class="well span12" style="height: 400px;"></div>
			<div id="chartVariable2" class="well span12" style="height: 400px;"></div>
			<div id="chartVariable3" class="well span12" style="height: 400px;"></div>
			<div id="chartVariable4" class="well span12" style="height: 400px;"></div>
			<div id="chartVariable5" class="well span12" style="height: 400px;"></div>
		</div>
		<div id="aux">

		</div>
		<script type="text/javascript" src="jqplot/jquery.jqplot.min.js"></script>
		<link rel="stylesheet" type="text/css" href="jqplot/jquery.jqplot.min.css" />
		<script language="javascript" type="text/javascript" src="jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
		<script language="javascript" type="text/javascript" src="jqplot/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
		<script language="javascript" type="text/javascript" src="jqplot/plugins/jqplot.highlighter.min.js"></script>
		<script language="javascript" type="text/javascript" src="jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script>
		<script language="javascript" type="text/javascript" src="jqplot/plugins/jqplot.cursor.min.js"></script>
    </body>
</html>