function graficarCirculares(data) {
	$('#chaptersMap').html('');
	var plot1 = jQuery.jqplot('chaptersMap', [data],
			{
				seriesDefaults: {
					renderer: jQuery.jqplot.PieRenderer,
					rendererOptions: {
						showDataLabels: true
					}
				},
				legend: {show: true, location: 'e'}
			}
	);
}

function graficarBarra(valores, colores) {
	$('#chaptersMap').html('');
	$('#chaptersMap').jqplot([valores], {
		title: 'Grafico de ' + $("#cbIndicador option:selected").text(),
		// Provide a custom seriesColors array to override the default colors.
		seriesColors: colores,
		animate: !$.jqplot.use_excanvas,
		seriesDefaults: {
			renderer: $.jqplot.BarRenderer,
			rendererOptions: {
				// Set varyBarColor to tru to use the custom colors on the bars.
				varyBarColor: true
			},
			pointLabels: {show: true}
		},
		axesDefaults: {
			tickRenderer: $.jqplot.CanvasAxisTickRenderer,
			tickOptions: {
				angle: -30,
				fontSize: '10pt'
			}
		},
		axes: {
			xaxis: {
				renderer: $.jqplot.CategoryAxisRenderer
			},
			yaxis: {
				tickOptions: {
					formatString: "%#.2f"
				}
			}
		}
	});

	$('#chaptersMap').bind('jqplotDataClick',
			function(ev, seriesIndex, pointIndex, data) {
				$('#info1').html('series: ' + seriesIndex + ', point: ' + pointIndex + ', data: ' + data);
			}
	);
}

function graficarMapa(provincia, data, minimo, maximo) {
	$('#chaptersMap').html('');
	$.getScript('js/data_' + provincia + '.js', function() {
		var r = Raphael('chaptersMap', 400, 400);
		r.safari();
		var _label = r.popup(50, 50, "").hide();
		var attributes = {
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
			var ubigeo = paths[correntPath].ubigeo;
			var valor = parseFloat(data[ubigeo].valor);
			if (valor < minimo) {
				attributes.fill = 'red';
			}
			if (valor > maximo) {
				attributes.fill = 'green';
			}
			if (valor <= maximo && valor >= minimo) {
				attributes.fill = 'yellow';
			}
			//attributes.fill = paths[correntPath].color;
			obj.attr(attributes);
			/* Al estar encima el mouse de nuestro correntPath, Cambiamos el color y se restablece cuando se deja */
			obj.hover(function() {
				bbox = this.getBBox();
				_label.attr({
					text: paths[arr[this.id]].name + " , " + data[paths[arr[this.id]].ubigeo].valor
				}).update(bbox.x, bbox.y + bbox.height / 2, bbox.width).toFront().show();
			}, function() {
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
		$('#tituloLeyenda').html("Leyenda en " + data.unidadMedida);
		$("#leyenda").html("<li class='text-error'>Bajo < " + data.minimo + "</li><li class='text-warning'> " + data.minimo + " <= Medio < " + data.maximo + "</li><li class='text-success'>Alto >= " + data.maximo + "</li>");
	}, "json");
}

function graficar() {
	var provincia = $('#cbProvincia').val();
	var indicador = $('#cbIndicador').val();
	var anio = $('#cbAnio').val();
	var periodo = $('#cbPeriodo').val();
	var data, minimo, maximo;
	$.post("consulta_grafico.php", {
		provincia: provincia,
		indicador: indicador,
		anio: anio,
		periodo: periodo
	},
	function(datos) {
		data = datos;
		$.post("consulta_datos.php", {
			peticion: "minimo_maximo",
			indicador: indicador
		},
		function(datos2) {
			minimo = datos2.minimo;
			maximo = datos2.maximo;
			var grafico = $('#cbGrafico').val();
			if (grafico === '01') {
				graficarMapa(provincia, data, minimo, maximo);
			} else {
				var valores = new Array();
				var colores = new Array();
				for (ubigeo in data) {
					var dataValor = parseFloat(data[ubigeo].valor);
					valores.push([data[ubigeo].nombre, dataValor]);
					if (dataValor < minimo) {
						colores.push("red");
					}
					if (dataValor > maximo) {
						colores.push("green");
					}
					if (dataValor >= minimo && dataValor <= maximo) {
						colores.push("yellow");
					}
				}
				if (grafico === '02') {
					graficarBarra(valores, colores);
				}
				if (grafico === '03') {
					graficarCirculares(valores);
				}
			}
		}, "json");
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

	$('#cbGrafico').on('change', function() {
		graficar();
	});
	$('#cbInstitucion').on('change', function() {
		graficar();
	});
	$('#cbIndicador').on('change', function() {
		graficar();
	});
	$('#cbAnio').on('change', function() {
		graficar();
	});
	$('#cbPeriodo').on('change', function() {
		graficar();
	});
	$('#cbProvincia').on('change', function() {
		graficar();
	});
	$('#cbGrafico').trigger('change');
});