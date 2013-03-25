function graficar(provincia, data, minimo, maximo) {
	$.getScript('js/data_' + provincia + '.js', function() {
		var r = Raphael('chaptersMap', 400, 400);
		r.safari();
		var _label = r.popup(50, 50, "").hide();
		attributes = {
			fill: '#485e96',
			stroke: '#1e336a',
			'stroke-width': 1,
			'stroke-linejoin': 'round',
			cursor: "pointer"
		};
		arr = new Array();
		/* para cada path de nuestra fuente svg vamos a dibujar un path del tipo Raphael */
		for (var correntPath in paths) {
			var obj = r.path(paths[correntPath].path);
			arr[obj.id] = correntPath;
			$.each(data, function(index, value) {
				if (data[index].ubigeo == paths[correntPath].ubigeo) {
					if (data[index].valor < minimo) {
						attributes.fill = 'red';
					}
					if (data[index].valor > maximo) {
						attributes.fill = 'yellow';
					}
					if (data[index].valor <= maximo && data[index].valor >= minimo) {
						attributes.fill = 'green';
					}
				}
			});
			obj.attr(attributes);
			/* Al estar encima el mouse de nuestro correntPath, Cambiamos el color y se restablece cuando se deja */
			obj.hover(function() {
				this.animate({
					fill: '#733A6A',
					stroke: '#1F131D'
				}, 300);
				bbox = this.getBBox();
				_label.attr({
					text: paths[arr[this.id]].name
				}).update(bbox.x, bbox.y + bbox.height / 2, bbox.width).toFront().show();
			}, function() {
				this.animate({
					fill: paths[arr[this.id]].color,
					stroke: attributes.stroke
				}, 300);
				_label.hide();
			});
			/* Accion cuando le damos click a alguna parte de nuestro mapa */
			obj.click(function() {
				location.href = paths[arr[this.id]].url;
			});
		}//fin For
	});
}

function cargarIndicadores() {
	$.post("consulta_datos_html.php", {
		peticion: "indicador_institucion",
		institucion: $('#cbInstitucion').val()
	},
	function(data) {
		$("#cbIndicador").html(data);
		$("#cbIndicador").trigger('change');
	}, "html");
}

function cargarLeyenda() {
	$.post("consulta_datos.php", {
		peticion: "minimo_maximo",
		indicador: $('#cbIndicador').val()
	},
	function(data) {
		$("#leyenda").html('');
		$("#leyenda").html("<li class='text-error'>Bajo < " + data.minimo + "</li><li class='text-warning'> " + data.minimo + " <= Medio < " + data.maximo + "</li><li class='text-success'>Alto >= " + data.maximo + "</li>");
	}, "json");
}

$(document).ready(function() {
	$('#cbInstitucion').change(function() {
		cargarIndicadores();
	});

	$('#cbIndicador').change(function() {
		cargarLeyenda();
	});

	$.post("consulta_datos_html.php", {
		peticion: "provincia"
	},
	function(data) {
		$("#cbProvincia").append(data);
	}, "html");

	$.post("consulta_datos.php", {
		peticion: "institucion"
	},
	function(data) {
		$.each(data, function(index, value) {
			$("#cbInstitucion").append("<option value='" + data[index].idinstitucion + "'>" + data[index].siglas + "</option>");
		});
		$("#cbInstitucion").trigger('change');
	}, "json");
	$('#btnGraficar').on('click', function() {
		var provincia = $('#cbProvincia').val();
		var indicador = $('#cbIndicador').val();
		var anio = $('#cbAnio').val();
		var periodo = $('#cbPeriodo').val();
		var data, minimo, maximo;
		$.post("consulta_datos_html.php", {
			provincia: provincia,
			indicador: indicador,
			anio: anio,
			periodo: periodo
		},
		function(datos) {
			data = datos;
		}, "json");
		$.post("consulta_datos.php", {
			peticion: "minimo_maximo",
			indicador: indicador
		},
		function(data) {
			minimo = data.minimo;
			maximo = data.maximo;
		}, "json");
		graficar(provincia, data, minimo, maximo);
	});
});