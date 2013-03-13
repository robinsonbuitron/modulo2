<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="datepicker/css/datepicker.css" rel="stylesheet">
		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="datepicker/js/bootstrap-datepicker.js"></script>
		<script type="text/javascript">
			var lista=["N_AIRTEMP","N_AIRTEMP_00M","N_AIRTEMP_10M","N_AIRTEMP_20M","N_AIRTEMP_30M","N_AIRTEMP_40M","N_AIRTEMP_50M","N_AIRTEMP_60M","N_AIRTEMP_INST","N_COND","N_CONSTELECT","N_DAYRAIN","N_DIRRACHA","N_DIRVIENTO","N_HOJAHUMED","N_HOJAHUMED_INST","N_HS101","N_HUMEDAD","N_HUMEDAD_INST","N_LLUVIA","N_LLUVIA_INST","N_MAXAT","N_MAXATH","N_MAXCONDD","N_MAXCONDH","N_MAXDIRVIENTO","N_MAXNIVEL","N_MAXNIVELH","N_MAXOXIGD","N_MAXOXIGH","N_MAXPHD","N_MAXPHH","N_MAXPRESATMD","N_MAXPRESATMH","N_MAXRH","N_MAXRHH","N_MAXTURBD","N_MAXTURBH","N_MAXVELVIENTO","N_MAXWTEMPD","N_MAXWTEMPH","N_MINAT","N_MINATH","N_MINCONDD","N_MINCONDH","N_MINNIVEL","N_MINNIVELH","N_MINOXIGD","N_MINOXIGH","N_MINPHD","N_MINPHH","N_MINPRESATMD","N_MINPRESATMH","N_MINRH","N_MINRHH","N_MINTURBD","N_MINTURBH","N_MINWTEMPD","N_MINWTEMPH","N_NIVELAGUA","N_NIVELMEDIO","N_OXIGENO","N_PHH","N_PRESATM","N_RACHA","N_RADSOLAR","N_RADSOLAR_TOT","N_RADSOLARHR","N_RAIN_00M","N_RAIN_10M","N_RAIN_20M","N_RAIN_30M","N_RAIN_40M","N_RAIN_50M","N_RAIN_60M","N_SOILTEMP","N_SUELOHUMED","N_SUELOHUMED_SECA","N_TURBH","N_VELVIENTO","N_WTEMP"];
			var contador=0;
			
			function ActualizarBD(){
				if (contador<lista.length) {
					$.post("migrar.php", { numero: contador+1, variable: lista[contador], fechaInicio: $("#txtFechaInicio").val(), fechaFin: $("#txtFechaFin").val() },
					function(data){
						$("#resultado").append(data);
						contador++;
						ActualizarBD();
					}, "text");
				} else{
					$("#btnActualizar").removeAttr("disabled");
					$("#btnActualizar").text("Actualizar BD");
					contador=0;
				}
			}
			
			function Actualizar(){
				$("#btnActualizar").text("Procesando...");
				$("#btnActualizar").attr("disabled","disabled");
				$("#resultado").text("");
				ActualizarBD();
			}
			$(document).ready(function () {
				var today = new Date();
				var anio=today.getFullYear();
				var mes=today.getMonth()+1;
				var dia=today.getDate();
				var fecha = anio + "-" + (mes<10?"0"+mes:mes) + "-" + (dia<10?"0"+dia:dia);
				$('#dp3').data({date: fecha}).datepicker('update').children("input").val(fecha);
				$('#dp4').data({date: fecha}).datepicker('update').children("input").val(fecha);
				//$('#dp3').data({date: fecha});
				//$('#dp3').datepicker('update');
				//$('#dp3').datepicker().children('input').val(fecha);
			});
		</script>
    </head>
    <body>
		<div class="pagination-centered">
			<div class="span8 offset2">
				<h3>Migracion de datos del Senamhi</h3>
				<form class="well form-inline">
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
					<button name="enviar" id="btnActualizar" type="button" onclick="Actualizar();" class="btn btn-success">Actualizar BD</button>
				</form>
				<div id="resultado">

				</div>
			</div>
		</div>
	</body>
</html>