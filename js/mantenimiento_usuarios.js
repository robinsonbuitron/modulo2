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
	jQuery.validator.addMethod("check_nombre", function(value, element, params) {
		return this.optional(element) || /^[A-Za-z0-9 ]{3,50}$/i.test(value);
	}, jQuery.format("Escriba Nombre y Apellidos"));
	$("#formInsertar").validate({
		rules: {
			txtCodigo: {
				required: true,
				email: true
			},
			txtNombre: {
				required: true,
				minlength: 2,
				check_nombre: true
			},
			txtPassword: {
				required: true,
				minlength: 5
			},
			txtPasswordR: {
				required: true,
				minlength: 5,
				equalTo: "#txtPassword"
			}
		},
		messages: {
			txtNombre: {
				required: "Ingrese un Nombre y Apellido"
			},
			txtPassword: {
				required: "Ingrse Password"
			}
		}
	});
	$("#formEditar").validate({
		rules: {
			txtNombreE: {
				required: true,
				minlength: 2,
				check_nombre: true
			}
		},
		messages: {
			txtNombreE: {
				required: "Ingrese un Nombre y Apellido"
			}
		}
	});
	//cargar conbobox cargo
	$.post("consulta_datos.php", {
		peticion: "cargo"
	},
	function(data) {
		$.each(data, function(index, value) {
			$(".cbCargo").append("<option value='" + data[index].idprivilegios + "'>" + data[index].nombprivi + "</option>");
		});
	}, "json");
	//cargar combobox institucion
	$.post("consulta_datos.php", {
		peticion: "institucion"
	},
	function(data) {
		$.each(data, function(index, value) {
			$(".cbInstitucion").append("<option value='" + data[index].idinstitucion + "'>" + data[index].siglas + "</option>");
		});
	}, "json");
	$("#example").delegate("a", "click", function(event) {
		if ($(this).text() === ' Eliminar') {
			var codigo = $(this).closest("tr").attr("id");
			if (confirm("¿Seguro que desea elimnar " + codigo + "?")) {
				var tr = $(this).closest("tr");
				$.post("mantenimiento_usuarios.php", {
					action: "eliminar",
					dni: codigo
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
							$("#txtCodigoE").val($(this).text());
							break;
						case 1:
							$("#txtNombreE").val($(this).text());
							break;
						case 2:
							var texto1 = $(this).text();
							$("#cbInstitucionE").find("option").filter(function(index) {
								return texto1 === $(this).text();
							}).prop("selected", "selected");
							break;
						case 3:
							var texto2 = $(this).text();
							$("#cbCargoE").find("option").filter(function(index) {
								return texto2 === $(this).text();
							}).prop("selected", "selected");
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
	//funcionalidad de modificar un usuario
	$("#btnEditar").click(function() {
		if ($("#formEditar").valid()) {
			$("#btnEditar").text("Editandoo...");
			$("#btnEditar").attr("disabled", "disabled");
			var codigo = $('#txtCodigoE').val();
			var nombre = $('#txtNombreE').val();
			var institucion = $('#cbInstitucionE').val();
			var cargo = $('#cbCargoE').val();
			$.post("mantenimiento_usuarios.php", {
				action: "modificar",
				dni: codigo,
				idprivilegios: cargo,
				idinstitucion: institucion,
				nomape: nombre
			},
			function(data) {
				if (data.title !== "error") {
					$("#example tbody tr").each(function(index) {
						if ($(this).attr("id") === $("#txtCodigoE").val()) {
							$(this).html('<td>' + codigo + '</td><td>' + nombre + '</td><td>' + $('#cbInstitucionE option:selected').text() + '</td><td>' + $('#cbCargoE option:selected').text() + '</td><td><a href="#myModal" data-toggle="modal" class="btn-small btn-success"><i class="icon-edit"></i><strong> Editar</strong></a></td><td><a href="#" class="btn-small btn-danger"><i class="icon-trash"></i><strong> Eliminar</strong></a></td></tr>');
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
	//funcionalidad de la accion de insertar un nuevo usuario
	$("#btnAgregar").click(function() {
		if ($("#formInsertar").valid()) {
			$("#btnAgregar").text("Agregando...");
			$("#btnAgregar").attr("disabled", "disabled");
			var codigo = $('#txtCodigo').val();
			var cargo = $('#cbCargo').val();
			var institucion = $('#cbInstitucion').val();
			var nombre = $('#txtNombre').val();
			$.post("mantenimiento_usuarios.php", {
				action: "insertar",
				dni: codigo,
				idprivilegios: cargo,
				idinstitucion: institucion,
				nomape: nombre,
				password: $("#txtPassword").val()
			},
			function(data) {
				if (data.title !== "error") {
					$('#example > tbody:last').append('<tr id="' + codigo + '"><td>' + codigo + '</td><td>' + nombre + '</td><td>' + $('#cbInstitucion option:selected').text() + '</td><td>' + $('#cbCargo option:selected').text() + '</td><td><a href="#myModal" data-toggle="modal" class="btn-small btn-success"><i class="icon-edit"></i><strong> Editar</strong></a></td><td><a href="#" class="btn-small btn-danger"><i class="icon-trash"></i><strong> Eliminar</strong></a></td></tr>');
					$("#formInsertar input").val("");
				}
				$("#resultado").html(data.html);
				$("#btnAgregar").removeAttr("disabled");
				$("#btnAgregar").text("Agregar");
				$("#example").dataTable();
			}, "json");
		} else {
			$("#resultado").html('<div class="alert alert-error"><strong>Error!</strong> Campos requeridos para insertar nuevo usuario</div>');
		}
	});
	$("#example").dataTable().fnDestroy();
	$('#example').dataTable(elementosEspanol);
});