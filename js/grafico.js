function cargarIndicadores() {
	$.post("consulta_datos_html.php", {
		peticion: "indicador_institucion",
		institucion: $('#cbInstitucion').val()
	},
	function(data) {
		$("#cbIndicador").html(data);
	}, "html");
}

function cargarLeyenda(){
	$.post("consulta_datos.php", {
		peticion: "minimo_maximo",
		indicador: $('#cbIndicador').val()
	},
	function(data) {
		$("#leyenda").html("<li class='text-error'>Bajo < " + data.minimo + "</li><li class='text-warning'> " + data.minimo + " <= Medio < " + data.maximo + "</li><li class='text-success'>Alto >= " + data.maximo + "</li>");
	}, "json");
}

$(document).ready(function() {
	$.post("consulta_datos.php", {
		peticion: "institucion"
	},
	function(data) {
		$.each(data, function(index, value) {
			$("#cbInstitucion").append("<option value='" + data[index].idinstitucion + "'>" + data[index].siglas + "</option>");
		});
	}, "json");

	$('#cbInstitucion').change(function() {
		cargarIndicadores();
	});
	
	$('#cbIndicador').change(function() {
		cargarLeyenda();
	});
});