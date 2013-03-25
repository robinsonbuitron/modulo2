function cargarTabla() {
	var provincia = $('#cbProvincia').val();
	var indicador = $('#cbIndicador option:selected').text();
	var anio = $('#cbAnio option:selected').text();
	var periodo = $('#cbPeriodo option:selected').text();
	$.get("llenar_lectura_tabla.php", {
		provincia: provincia,
		indicador: indicador,
		anio: anio,
		periodo: periodo
	},
	function(data) {
		$("#tablaInstitucion").html(data);
		//$("#tablaInstitucion").valid();
	}, "html");
}
function cargarExcel() {
	var provincia = $('#cbProvincia').val();
	var indicador = $('#cbIndicador option:selected').text();
	var anio = $('#cbAnio option:selected').text();
	var periodo = $('#cbPeriodo option:selected').text();
	window.location.href = 'llenar_lectura_tabla.php?excel=true&provincia=' + provincia + '&indicador=' + indicador + '&anio=' + anio + '&periodo=' + periodo;
}

function guardarDato(indicador, ubigeo, periodo, anio, valor) {
	$.post("mantenimiento_lectura.php", {
		action: "insertar",
		indicador: indicador,
		ubigeo: ubigeo,
		anio: anio,
		periodo: periodo,
		valor: valor
	},
	function(data) {
		$("#resultado").append(data.html);
	}, "json");
}

function guardarLectura() {
	$("#resultado").html("");
	var indicador = $('#cbIndicador').val();
	var anio = $('#cbAnio').val();
	var periodo = $('#cbPeriodo').val();
	$("#example tbody tr").each(function(index) {
		var valor, ubigeo;
		$(this).children("td").each(function(index2) {
			ubigeo = $(this).closest('tr').attr("id");
			switch (index2) {
				case 4:
					valor = $(this).children().first().val();
					break;
			}
		});
		guardarDato(indicador, ubigeo, periodo, anio, valor);
	});
}

$(document).ready(function() {

	$.post("consulta_datos_html.php", {
		peticion: "provincia"
	},
	function(data) {
		$("#cbProvincia").append(data);
	}, "html");
	//llenar combobox de indicadores segun su institucion del usuario
	$.post("consulta_datos_html.php", {
		peticion: "indicador"
	},
	function(data) {
		$("#cbIndicador").html(data);
	}, "html");

	$("#btnCargar").click(function() {
		cargarTabla();
	});

	$('#cbIndicador').on('change', function() {
		cargarTabla();
	});

	$('#cbProvincia').on('change', function() {
		cargarTabla();
	});

	$('#cbPeriodo').on('change', function() {
		cargarTabla();
	});

	$('#cbAnio').on('change', function() {
		cargarTabla();
	});

	$('#btnDescargarExcel').on('click', function() {
		cargarExcel();
	});

	$('#btnCargarExcel').on('click', function() {
		guardarLectura();
	});
});