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
$(document).ready(function() {
// Agregamos un metodo nuevo para revisar el nombre
	jQuery.validator.addMethod("check_indicador", function(value, element, params) {
		return this.optional(element) || /^[A-Za-z0-9 ]{3,100}$/i.test(value);
	}, jQuery.format("Escriba un indicador válido"));
// Validamos el form
	$("#formInsertar").validate({
		rules: {
			txtIndicador: {
				required: true,
				minlength: 5,
				check_indicador: true

			},
			txtValorMin: {
				required: true,
				number: true,
				minlength: 1
			},
			txtValorMax: {
				required: true,
				number: true,
				minlength: 1,
				min: "#txtValorMin"
			}
		},
		messages: {
			txtIndicador: {
				required: "Ingrese la descripcion del Indicador. Por Favor"
			},
			txtValorMin: {
				required: "se requiere el Valor Minimo"
			},
			txtValorMax: {
				required: "se requiere el Valor Maximo"
			}
		}
	});
	$("#formEditar").validate({
		rules: {
			txtIndicadorE: {
				required: true,
				minlength: 5,
				check_indicador: true

			},
			txtValorMinE: {
				required: true,
				number: true,
				minlength: 1
			},
			txtValorMaxE: {
				required: true,
				number: true,
				minlength: 1,
				min: "#txtValorMinE"
			}
		},
		messages: {
			txtIndicadorE: {
				required: "Ingrese la descripcion del Indicador. Por Favor"
			},
			txtValorMinE: {
				required: "se requiere el Valor Minimo"
			},
			txtValorMaxE: {
				required: "se requiere el Valor Maximo"
			}
		}
	});
	//cargar conbobox unidad de medida
	$.post("consulta_datos.php", {
		peticion: "unidad_medida"
	},
	function(data) {
		$.each(data, function(index, value) {
			$(".cbUnidadMedida").append("<option value='" + data[index].idunidadmedida + "'>" + data[index].abreviatura + "</option>");
		});
	}, "json");
	$("#example").delegate("a", "click", function(event) {
		if ($(this).text() === ' Eliminar') {
			var codigo = $(this).closest("tr").attr("id");
			if (confirm("¿Seguro que desea elimnar el registro " + codigo + "?")) {
				var tr = $(this).closest("tr");
				$.post("mantenimiento_indicador.php", {
					action: "eliminar",
					idindicador: codigo
				},
				function(data) {
					if (data.title !== "error") {
						tr.remove();
					}
					$("#resultado").html(data.html);
				}, "json");
			}
		}
		if ($(this).text() === ' Editar') {
			$(this).closest("tr").each(function(index) {
				$(this).children("td").each(function(index2) {
					switch (index2) {
						case 0:
							$("#txtIdindicadorE").val($(this).text());
							break;
						case 1:
							var texto1 = $(this).text();
							$("#txtInstitucionE").val(texto1);
							break;
						case 2:
							$("#txtIndicadorE").val($(this).text());
							break;
						case 3:
							var texto2 = $(this).text();
							$("#cbUnidadMedidaE").find("option").filter(function(index) {
								return texto2 === $(this).text();
							}).prop("selected", "selected");
							break;
						case 4:
							$("#txtValorMinE").val($(this).text());
							break;
						case 5:
							$("#txtValorMaxE").val($(this).text());
							break;
						case 6:
							$("#cbColorE").val($(this).text());
							break;
					}
				});
			});
		}
	});
	//funcionalidad del boton limpiar
	$("#btnLimpiar").click(function() {
		$("#formInsertar input").val("");
	});
	//funcionalidad de modificar un indicador
	$("#btnEditar").click(function() {
		if ($("#formEditar").valid()) {
			$("#btnEditar").text("Editandoo...");
			$("#btnEditar").attr("disabled", "disabled");
			var codigo = $('#txtIdindicadorE').val();
			var institucion = $('#txtInstitucionE').val();
			var indicador = $('#txtIndicadorE').val();
			var unidadmedida = $('#cbUnidadMedidaE').val();
			var valormin = $('#txtValorMinE').val();
			var valormax = $('#txtValorMaxE').val();
			var semaforo = $('#cbColorE').val();
			$.post("mantenimiento_indicador.php", {
				action: "modificar",
				idindicador: codigo,
				idunidadmedida: unidadmedida,
				idinstitucion: institucion,
				descripcion: indicador,
				valorminimo: valormin,
				valormaximo: valormax,
				semaforo: semaforo
			},
			function(data) {
				if (data.title !== "error") {
					$("#example tbody tr").each(function(index) {
						if ($(this).attr("id") === $("#txtIdindicadorE").val()) {
							$(this).html('<td>' + codigo + '</td><td>' + institucion + '</td><td>' + indicador + '</td><td>' + $('#cbUnidadMedidaE option:selected').text() + '</td><td>' + valormin + '</td><td>' + valormax + '</td><td>' + semaforo + '</td><td><a href="#myModal" data-toggle="modal" class="btn-small btn-success"><i class="icon-edit"></i><strong> Editar</strong></a></td><td><a href="#" class="btn-small btn-danger"><i class="icon-trash"></i><strong> Eliminar</strong></a></td></tr>');
						}
					});
					$("#resultado").html(data.html);
					$("#btnEditar").removeAttr("disabled");
					$("#btnEditar").text("Editar");
					$('#myModal').modal('hide');
				}
			}, "json");
		}
	});
	//funcionalidad de la accion de insertar un nuevo indicador
	$("#btnAgregar").click(function() {
		if ($("#formInsertar").valid()) {
			$("#btnAgregar").text("Agregando...");
			$("#btnAgregar").attr("disabled", "disabled");
			var institucion = $('#txtInstitucion').val();
			var indicador = $('#txtIndicador').val();
			var unidadmedida = $('#cbUnidadMedida').val();
			var valormin = $('#txtValorMin').val();
			var valormax = $('#txtValorMax').val();
			var semaforo = $('#cbColor').val();
			$.post("mantenimiento_indicador.php", {
				action: "insertar",
				idunidadmedida: unidadmedida,
				idinstitucion: institucion,
				descripcion: indicador,
				valorminimo: valormin,
				valormaximo: valormax,
				semaforo: semaforo
			},
			function(data) {
				if (data.title !== "error") {
					$('#example > tbody:last').append('<tr id="' + data.title + '"><td>' + data.title + '</td><td>' + institucion + '</td><td>' + indicador + '</td><td>' + $('#cbUnidadMedida option:selected').text() + '</td><td>' + valormin + '</td><td>' + valormax + '</td><td>' + semaforo + '</td><td><a href="#myModal" data-toggle="modal" class="btn-small btn-success"><i class="icon-edit"></i><strong> Editar</strong></a></td><td><a href="#" class="btn-small btn-danger"><i class="icon-trash"></i><strong> Eliminar</strong></a></td></tr>');
					$("#formInsertar input").val("");
				}
				$("#resultado").html(data.html);
				$("#btnAgregar").removeAttr("disabled");
				$("#btnAgregar").text("Agregar");
			}, "json");
		} else {
			$("#resultado").html('<div class="alert alert-error"><strong>Error!</strong> Campos requeridos para insertar nuevo indicador</div>');
		}
	});
	$("#example").dataTable().fnDestroy();
	$('#example').dataTable(elementosEspanol);
});


