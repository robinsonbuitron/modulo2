//Funcionalidad para realizar opreaciones sobre la tabla unidad de medida

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
	$("#example").dataTable().fnDestroy();
	oTable = $('#example').dataTable(elementosEspanol);
// Agregamos un metodo nuevo para revisar el nombre
	$("#frmInsertar").validate({
		rules: {
			txtabreviatura: {
				required: true,
				minlength: 1

			},
			txtdescripcion: {
				required: true,
				minlength: 5,
			}
		},
		messages: {
			txtabreviatura: {
				required: "Debe ingresar Unidad de Medida"
			},
			txtdescripcion: {
				required: "Ingrese la descripcion de la Unidad de Medida"
			}
		}
	});
	$("#example").delegate("a", "click", function(event) {
		if ($(this).text() === ' Eliminar') {
			var codigo = $(this).closest("tr").attr("id");
			var tr = $(this).closest("tr");
			$.post("mantenimiento_um.php", {
				action: "eliminar",
				idunidadmedida: codigo
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
							$("#txtidunidadmedidaE").val($(this).text());
							break;
						case 1:
							$("#txtabreviaturaE").val($(this).text());
							break;
						case 2:
							$("#txtdescripcionE").val($(this).text());
							break;
					}
				});
			});
		}
	});
	//funcionalidad del boton limpiar
	$("#btnLimpiar").click(function() {
		$("#frmInsertar input").val("");
	});
	//funcionalidad de modificar la tabla unidad de media
	$("#btnEditar").click(function() {
		$("#btnEditar").text("Editandoo...");
		$("#btnEditar").attr("disabled", "disabled");
		var codigo = $('#txtidunidadmedidaE').val();
		var unidad = $('#txtabreviaturaE').val();
		var desc = $('#txtdescripcionE').val();
		$.post("mantenimiento_um.php", {
			action: "modificar",
			unidadmedida: codigo,
			abreviatura: unidad,
			descripcion: desc

		},
		function(data) {
			if (data.title !== "error") {
				$("#example tbody tr").each(function(index) {
					if ($(this).attr("id") === codigo) {
						$(this).html('<td>' + codigo + '</td><td>' + unidad + '</td><td>' + desc + '</td><td><a href="#myModal" data-toggle="modal" class="btn-small btn-success"><i class="icon-edit"></i><strong> Editar</strong></a></td><td><a href="#" class="btn-small btn-danger"><i class="icon-trash"></i><strong> Eliminar</strong></a></td></tr>');
					}
				});
				$("#resultado").html(data.html);
				$("#btnEditar").removeAttr("disabled");
				$("#btnEditar").text("Editar");
				$('#myModal').modal('hide');
			}
		}, "json");
	});
	//funcionalidad de la accion de insertar nueva unidad de medida 
	$("#btnAgregar").click(function() {
		if ($("#frmInsertar").valid()) {
			$("#btnAgregar").text("Agregando...");
			$("#btnAgregar").attr("disabled", "disabled");
			var unidad = $('#txtabreviatura').val();
			var desc = $('#txtdescripcion').val();
			$.post("mantenimiento_um.php", {
				action: "insertar",
				abreviatura: unidad,
				descripcion: desc

			},
			function(data) {
				if (data.title !== "error") {
					$('#example > tbody:last').append('<tr id="' + data.title + '"><td>' + data.title + '</td><td>' + unidad + '</td><td>' + desc + '</td><td><a href="#myModal" data-toggle="modal" class="btn-small btn-success"><i class="icon-edit"></i><strong> Editar</strong></a></td><td><a href="#" class="btn-small btn-danger"><i class="icon-trash"></i><strong> Eliminar</strong></a></td></tr>');
					$("#frmInsertar input").val("");
				}
				$("#resultado").html(data.html);
				$("#btnAgregar").removeAttr("disabled");
				$("#btnAgregar").text("Agregar");
			}, "json");
		} else {
			$("#resultado").html('<div class="alert alert-error"><strong>Error!</strong> Por Favor complete los campos para que sean ingresados</div>');
		}
	});
});