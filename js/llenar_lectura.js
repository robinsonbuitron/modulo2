$(document).ready(function() {
	$("#tablaInstitucion").validate({
		rules: {
			txtValor: {
				required: true,
				minlength: 1,
				number: true
			}
		},
		messages: {
			txtValor: {
				required: "Debe ingresar por lo menos un valor"
			}
		}
	});

	$.post("consulta_datos_html.php", {
		peticion: "provincia"
	},
	function(data) {
		$("#cbProvincia").html(data);
	}, "html");
	//llenar combobox de indicadores segun su institucion del usuario
	$.post("consulta_datos_html.php", {
		peticion: "indicador"
	},
	function(data) {
		$("#cbIndicador").html(data);
	}, "html");

	$("#btnCargar").click(function() {
		var indicador = $('#cbIndicador option:selected').text();
		var anio = $('#cbAnio option:selected').text()
		var periodo = $('#cbPeriodo option:selected').text()
		$.post("llenar_lectura_tabla.php", {
			provincia: "todo",
			indicador: indicador,
			anio: anio,
			periodo: periodo
		},
		function(data) {
			$("#tablaInstitucion").html(data);
			$("#tablaInstitucion").valid();
		}, "html");
	});
});