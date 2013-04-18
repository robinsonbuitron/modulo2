/*
 * Este es coidgo ajax para el manetimiento de indicadores.
 * @GRA
 * Proyecto Siar
 */
var elementosEspanol = {
	"bJQueryUI": true,
	"oLanguage": {
		"sEmptyTable": "No hay datos",
		"sInfo": "Mostrando (_START_-_END_) de _TOTAL_ registros",
		"sLengthMenu": "Mostrar <select>" +
				'<option value="10">10</option>' +
				'<option value="25">25</option>' +
				'<option value="50">50</option>' +
				'<option value="100">100</option>' +
				'<option value="-1">Todos</option>' +
				'</select> Registros',
		"sLoadingRecords": "Espere un momento, cargando...",
		"sSearch": "Buscar:",
		"sZeroRecords": "No hay datos con esta busqueda",
		"oPaginate": {
			"sFirst": "Primero",
			"sLast": "Ultimo",
			"sNext": "Siguiente",
			"sPrevious": "Anterior"
		}
	}
};

function cargarDistritos() {
	$.post("consulta_datos_html.php", {
		peticion: "distrito",
		codProvincia: $("#cbProvincia").val()
	},
	function(data) {
		$("#cbDistrito").html(data);
	}, "html");
}

function editarEliminar() {
	$("#example").delegate("a", "click", function(event) {
		if ($(this).text() === ' Eliminar') {
			var codigo = $(this).closest("tr").attr("id");
			var tr = $(this).closest("tr");
			var indicador = codigo.substring(0, 4);
			var ubigeo = codigo.substring(4, 10);
			var anio = codigo.substring(10, 14);
			var periodo = codigo.substring(14, 17);
			$.post("mantenimiento_lectura.php", {
				action: "eliminar",
				indicador: indicador,
				ubigeo: ubigeo,
				anio: anio,
				periodo: periodo
			},
			function(data) {
				if (data.title !== "error") {
					tr.remove();
				}
				$("#resultado").html(data.html);
			}, "json");
		}
		if ($(this).text() === ' Editar') {
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
}

$(document).ready(function() {

	$("#frmInsertar").validate({
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

	$("#btnEditar").click(function() {
		$("#btnEditar").text("Editandoo...");
		$("#btnEditar").attr("disabled", "disabled");
		var codigo = $("#txtId").val();
		var indicador = codigo.substring(0, 4);
		var ubigeo = codigo.substring(4, 10);
		var anio = codigo.substring(10, 14);
		var periodo = codigo.substring(14, 17);
		//$("#resultado").html(codigo + " : " + indicador + " - " + ubigeo + " - " + anio + " - " + periodo);
		$.post("mantenimiento_lectura.php", {
			action: "modificar",
			indicador: indicador,
			ubigeo: ubigeo,
			anio: anio,
			periodo: periodo,
			valor: $("#txtValorE").val()
		},
		function(data) {
			if (data.title !== "error") {
				$("#example tbody tr").each(function(index) {
					if ($(this).attr("id") === $("#txtId").val()) {
						$(this).html('<td>' + $('#txtIndicadorE').val() + '</td><td>' + $('#txtDistritoE').val() + '</td><td>' + $('#txtAnioE').val() + '</td><td>' + $('#txtPeriodoE').val() + '</td><td>' + $('#txtValorE').val() + '</td><td><a class="btn-small btn-success" href="#myModal" data-toggle="modal"><i class="icon-edit"></i><strong> Editar</strong></a></td>');
					}
				});
				$("#resultado").html(data.html);
				$("#btnEditar").removeAttr("disabled");
				$("#btnEditar").text("Editar");
				$('#myModal').modal('hide');
			}
		}, "json");
	});

	$("#btnAgregar").click(function() {
		if ($("#frmInsertar").valid()) {
			$("#btnAgregar").text("Agregando...");
			$("#btnAgregar").attr("disabled", "disabled");
			var indicador = $('#cbIndicador').val();
			var ubigeo = $('#cbDistrito').val();
			var anio = $('#cbAnio option:selected').text();
			var periodo = $('#cbPeriodo').val();
			var codigo = indicador + ubigeo + anio + periodo;
			$.post("mantenimiento_lectura.php", {
				action: "insertar",
				indicador: indicador,
				ubigeo: ubigeo,
				anio: anio,
				periodo: periodo,
				valor: $("#txtValor").val()
			},
			function(data) {
				if (data.title !== "error") {
					$('#example > tbody:last').append('<tr id="' + codigo + '"><td>' + $('#cbIndicador option:selected').text() + '</td><td>' + $('#cbDistrito option:selected').text() + '</td><td>' + $("#cbAnio option:selected").text() + '</td><td>' + $("#cbPeriodo option:selected").text() + '</td><td>' + $("#txtValor").val() + '</td><td><a class="btn-small btn-success" href="#myModal" data-toggle="modal"><i class="icon-trash"></i><strong> Editar</strong></a></td></tr>');
					$("#formInsertar input").val("");
				}
				$("#resultado").html(data.html);
				$("#btnAgregar").removeAttr("disabled");
				$("#btnAgregar").text("Agregar");
			}, "json");
		} else {
			$("#resultado").html('<div class="alert alert-error"><strong>Error!</strong> Campos requeridos para insertar nuevo valor</div>');
		}
	});

	$("#cbIndicador").on('change', function() {
		$.post("lista_lectura.php", {
			indicador: $("#cbIndicador").val()
		},
		function(data) {
			$("#tablaInstitucion").html(data);
			$('#example').dataTable(elementosEspanol);
			editarEliminar();
		}, "html");
	});
	//llenar combobox de provincia
	$.post("consulta_datos_html.php", {
		peticion: "provincia"
	},
	function(data) {
		$("#cbProvincia").html(data);
		$("#cbProvincia").trigger('change');
	}, "html");
	//llenar combobox de indicadores segun su institucion del usuario
	$.post("consulta_datos_html.php", {
		peticion: "indicador"
	},
	function(data) {
		$("#cbIndicador").html(data);
		$("#cbIndicador").trigger('change');
	}, "html");
	//llenr combobox de distritos segun la provincia seleccionada
	$('#cbProvincia').change(function() {
		cargarDistritos();
	});
});

