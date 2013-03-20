/*
 * Este es coidgo ajax para el manetimiento de indicadores.
 * @GRA
 * Proyecto Siar
 */
function cargarDistritos() {
	$.post("consulta_datos_html.php", {
		peticion: "distrito",
		codProvincia: $("#cbProvincia").val()
	},
	function(data) {
		$("#cbDistrito").html(data);
	}, "html");
}

$(document).ready(function() {
	//llenar combobox de provincia
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
	//llenr combobox de distritos segun la provincia seleccionada
	$('#cbProvincia').change(function() {
		cargarDistritos();
	});

	$("#example").delegate("a", "click", function(event) {
		if ($(this).text() === 'Eliminar') {
			$(this).closest("tr").remove(); // remove row
		}
		if ($(this).text() === 'Editar') {
			$(this).closest("tr").each(function(index) {
				$(this).children("td").each(function(index2) {
					switch (index2) {
						case 0:
							$("#txtIndicadorE").val($(this).text());
							$("#txtId").val($(this).closest("tr").attr("id"));
							break;
						case 1:
							$("#txtDistritoE").val($(this).text());
							break;
						case 2:
							$("#txtAnioE").val($(this).text());
							break;
						case 3:
							$("#txtPeriodoE").val($(this).text());
							break;
						case 4:
							$("#txtValorE").val($(this).text());
							break;
					}
				});
			});
		}
	});

	$("#btnEditar").click(function() {
		$("#example tbody tr").each(function(index) {
			if ($(this).attr("id") === $("#txtId").val()) {
				$(this).html('<td>' + $('#txtIndicadorE').val() + '</td><td>' + $('#txtDistritoE').val() + '</td><td>' + $('#txtAnioE').val() + '</td><td>' + $('#txtPeriodoE').val() + '</td><td>' + $('#txtValorE').val() + '</td><td><a href="#myModal" data-toggle="modal">Editar</a></td><td><a href="#">Eliminar</a></td>');
			}
		});
		$('#myModal').modal('hide');
	});

	$("#btnAgregar").click(function() {
		var indicador = $('#cbIndicador').val();
		var ubigeo = $('#cbDistrito').val();
		var anio = $('#cbAnio option:selected').text();
		var periodo = $('#cbPeriodo').val();
		var codigo = indicador + ubigeo + anio + periodo;
		$('#example > tbody:last').append('<tr id="' + codigo + '"><td>' + $('#cbIndicador option:selected').text() + '</td><td>' + $('#cbDistrito option:selected').text() + '</td><td>' + $("#cbAnio option:selected").text() + '</td><td>' + $("#cbPeriodo option:selected").text() + '</td><td>' + $("#txtValor").val() + '</td><td><a href="#myModal" data-toggle="modal">Editar</a></td><td><a href="#">Eliminar</a></td></tr>');
	});
});

