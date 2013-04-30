function cargarExcelVariables(file) {
	var provincia = $('#cbProvincia').val();
	$.get("procesar_excel.php", {
		tipo: "variables",
		provincia: provincia,
		file: file
	},
	function(data) {
		if (data.html) {
			alert(data.html);
		} else {
			$("#example tbody tr").each(function(index) {
				var valor, ubigeo;
				$(this).children("td").each(function(index2) {
					ubigeo = $(this).closest('tr').attr("id");
					switch (index2) {
						case 4:
							valor = $(this).children().first().val(data[ubigeo]);
							break;
					}
				});
			});
		}
	}, "json");
}

function cargarExcelIndicador(file) {
	var provincia = $('#cbProvincia').val();
	$.get("procesar_excel.php", {
		tipo: "indicador",
		provincia: provincia,
		file: file
	},
	function(data) {
		$("#example tbody tr").each(function(index) {
			var valor, ubigeo;
			$(this).children("td").each(function(index2) {
				ubigeo = $(this).closest('tr').attr("id");
				switch (index2) {
					case 4:
						valor = $(this).children().first().val(data[ubigeo]);
						break;
				}
			});
		});
	}, "json");
}

function cargarTabla() {
	var provincia = $('#cbProvincia').val();
	var indicador = $('#cbIndicador option:selected').text();
	var anio = $('#cbAnio option:selected').text();
	var periodo = $('#cbPeriodo option:selected').text();
	var idperiodo = $('#cbPeriodo').val();
	var idindicador = $('#cbIndicador').val();
	if (idindicador !== null && idindicador !== "") {
		$.get("llenar_lectura_tabla.php", {
			provincia: provincia,
			indicador: indicador,
			anio: anio,
			periodo: periodo,
			idindicador: idindicador,
			idperiodo: idperiodo
		},
		function(data) {
			$("#tablaInstitucion").html(data);
		}, "html");
	}
}

function descargarExcelIndicador() {
	var provincia = $('#cbProvincia').val();
	var idindicador = $('#cbIndicador').val();
	var indicador = $('#cbIndicador option:selected').text();
	var anio = $('#cbAnio option:selected').text();
	var idperiodo = $('#cbPeriodo').val();
	var periodo = $('#cbPeriodo option:selected').text();
	window.location.href = 'consulta_excel.php?tipo=indicador&provincia=' + provincia + '&indicador=' + indicador + '&anio=' + anio + '&periodo=' + periodo + '&idindicador=' + idindicador + '&idperiodo=' + idperiodo;
}

function descargarExcelVariables() {
	var provincia = $('#cbProvincia').val();
	var indicador = $('#cbIndicador option:selected').text();
	var anio = $('#cbAnio option:selected').text();
	var idperiodo = $('#cbPeriodo').val();
	var periodo = $('#cbPeriodo option:selected').text();
	window.location.href = 'consulta_excel.php?tipo=variables&provincia=' + provincia + '&indicador=' + indicador + '&anio=' + anio + '&periodo=' + periodo + '&idperiodo=' + idperiodo;
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
		//$("#resultado").html(data.html);
	}, "json");
}

function guardarLectura() {
	$("#resultado").html("");
	var indicador = $('#cbIndicador').val();
	var anio = $('#cbAnio').val();
	var periodo = $('#cbPeriodo').val();
	var lectura = new Array();
	var estado = true;
	$("#example tbody tr").each(function(index) {
		var valor, ubigeo;
		$(this).children("td").each(function(index2) {
			ubigeo = $(this).closest('tr').attr("id");
			switch (index2) {
				case 4:
					valor = $(this).children().first().val();
					if (!valor.match(/^[-+]?(?:\d+\.?\d*|\.\d+)$/)) {
						estado = false;
					}
					break;
			}
		});
		lectura.push(new Array(ubigeo, valor));
	});
	if (estado) {
		var total = lectura.length;
		for (i = 0; i < total; i++) {
			var registro = lectura[i];
			guardarDato(indicador, registro[0], periodo, anio, registro[1]);
		}
		alert("Se ingreso Correctamente los datos");
	} else {
		//$("#resultado").html('<div class="alert alert-error"><strong>Error!</strong> Corriga o complete los valores que faltan</div>');
		alert("Error! Corriga o complete los valores que faltan");
	}
	//guardarDato(indicador, ubigeo, periodo, anio, valor);
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

	$('#btnDescargarExcelIndicador').on('click', function() {
		descargarExcelIndicador();
	});
	$('#btnDescargarExcelVariables').on('click', function() {
		descargarExcelVariables();
	});
	$('#btnGuardarDatos').on('click', function() {
		guardarLectura();
	});
	$('#btnCargarExcelVariables').on('click', function() {
		cargarTabla();
		var aux = new AjaxUpload('#btnCargarExcelVariables', {
			action: 'upload.php',
			onSubmit: function(file, ext) {
				if (!(ext && /^(xls|xlsx|xlt|xltx)$/.test(ext))) {
					// extensiones permitidas
					alert('Error: Solo se permiten archivos excel');
					// cancela upload
					return false;
				} else {
					$('#btnCargarExcelVariables').val('Cargando...');
					this.disable();
				}
			},
			onComplete: function(file, response) {
				cargarExcelVariables(file);
				$('#btnCargarExcelVariables').val('Cargar Excel Variables');
				alert('El Archivo ha sido cargado, empezaremos a procesar...');
				this.enable();
			}
		});
	});
	$('#btnCargarExcelIndicador').on('click', function() {
		cargarTabla();
		var aux = new AjaxUpload('#btnCargarExcelIndicador', {
			action: 'upload.php',
			onSubmit: function(file, ext) {
				if (!(ext && /^(xls|xlsx|xlt|xltx)$/.test(ext))) {
					// extensiones permitidas
					alert('Error: Solo se permiten archivos excel');
					// cancela upload
					return false;
				} else {
					$('#btnCargarExcelIndicador').val('Cargando...');
					this.disable();
				}
			},
			onComplete: function(file, response) {
				cargarExcelIndicador(file);
				$('#btnCargarExcelIndicador').val('Cargar Excel Indicador');
				alert('El Archivo ha sido cargado, empezaremos a procesar...');
				this.enable();
			}
		});
	});
});