function graficarCirculares(lienzo, indicador, provincia, periodo, anio) {
	var indicadorName = $("#cbIndicador option:selected").text();
	var peridoName = $("#cbPeriodo option:selected").text();
	lienzo.highcharts({
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false
		},
		legend: {
			width: 200,
			itemWidth: 200,
			align: 'right',
			verticalAlign: 'top',
			x: 0,
			y: 100
		},
		title: {
			text: indicadorName + ' - ' + peridoName + ' ' + anio
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>',
			percentageDecimals: 1
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					color: '#000000',
					connectorColor: '#000000',
					formatter: function() {
						return '<b>' + this.point.name + '</b>: ' + this.percentage.toFixed(2) + ' %';
					}
				},
				showInLegend: true
			}
		},
		credits: {
			enabled: false
		},
		series: []
	});
	$.post("consulta_grafico.php", {
		peticion: "circulares",
		provincia: provincia,
		indicador: indicador,
		periodo: periodo,
		anio: anio
	}, function(data) {
		var chart = lienzo.highcharts();
		if (data) {
			chart.addSeries({
				type: 'pie',
				name: indicadorName,
				data: data
			});
		} else {
			chart.destroy();
			lienzo.html("<h2>No hay Datos</h2>");
		}
	}, "json");
}

function graficarHistorico(lienzo, indicador, provincia, periodo, anio, minimo, maximo, uMedida) {
	var indicadorName = $("#cbIndicador option:selected").text();
	var peridoName = $("#cbPeriodo option:selected").text();
	lienzo.highcharts({
		chart: {
			type: 'column'
		},
		plotOptions: {
			column: {
				stacking: 'normal'
			}
		},
		title: {
			text: indicadorName + ' - ' + peridoName + ' Historico'
		},
		xAxis: {
			categories: [],
			labels: {
				rotation: -45,
				align: 'right',
				style: {
					fontSize: '12px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: indicadorName + ' (' + uMedida + ')'
			},
			stackLabels: {
				enabled: true,
				style: {
					fontWeight: 'bold',
					color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
				},
				formatter: function() {
					return this.total + uMedida;
				}
			}
		},
		tooltip: {
			formatter: function() {
				return '<b>' + this.x + '</b><br/>' + indicadorName + ': <b>' + this.y + '</b>' + uMedida;
			}
		},
		credits: {
			enabled: false
		},
		series: []
	});
	$.post("consulta_grafico.php", {
		peticion: "historico",
		provincia: provincia,
		indicador: indicador,
		periodo: periodo,
		anio: anio,
		minimo: minimo,
		maximo: maximo
	}, function(data) {
		var chart = lienzo.highcharts();
		if (data) {
			chart.xAxis[0].setCategories(data.categories, false);
			chart.addSeries(data.series[0], false);
			chart.addSeries(data.series[1], false);
			chart.addSeries(data.series[2]);
		} else {
			chart.destroy();
			lienzo.html("<h2>No hay Datos</h2>");
		}
	}, "json");
}

function graficarBarra(lienzo, indicador, provincia, periodo, anio, minimo, maximo, uMedida) {
	var indicadorName = $("#cbIndicador option:selected").text();
	var peridoName = $("#cbPeriodo option:selected").text();
	lienzo.highcharts({
		chart: {
			type: 'column'
		},
		plotOptions: {
			column: {
				stacking: 'normal'
			}
		},
		title: {
			text: indicadorName + ' - ' + peridoName + ' ' + anio
		},
		xAxis: {
			categories: [],
			labels: {
				rotation: -45,
				align: 'right',
				style: {
					fontSize: '12px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: indicadorName + ' (' + uMedida + ')'
			},
			stackLabels: {
				enabled: true,
				style: {
					fontWeight: 'bold',
					color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
				},
				formatter: function() {
					return this.total + uMedida;
				}
			}
		},
		tooltip: {
			formatter: function() {
				return '<b>' + this.x + '</b><br/>' + indicadorName + ': <b>' + this.y + '</b>' + uMedida;
			}
		},
		credits: {
			enabled: false
		},
		series: []
	});
	$.post("consulta_grafico.php", {
		peticion: "barras",
		provincia: provincia,
		indicador: indicador,
		periodo: periodo,
		anio: anio,
		minimo: minimo,
		maximo: maximo
	}, function(data) {
		var chart = lienzo.highcharts();
		if (data) {
			chart.xAxis[0].setCategories(data.categories, false);
			chart.addSeries(data.series[0], false);
			chart.addSeries(data.series[1], false);
			chart.addSeries(data.series[2]);
		} else {
			chart.destroy();
			lienzo.html("<h2>No hay Datos</h2>");
		}
	}, "json");
}

function graficarMapa(provincia, data, minimo, maximo, uMedida) {
	$.getScript('js/data_' + provincia + '.js', function() {
		var r = Raphael('chaptersMap', 400, 450);
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
				attributes.fill = '#ff0000';
			}
			if (valor > maximo) {
				attributes.fill = '#008000';
			}
			if (valor <= maximo && valor >= minimo) {
				attributes.fill = '#ffff00';
			}
			obj.attr(attributes);
			/* Al estar encima el mouse de nuestro correntPath, Cambiamos el color y se restablece cuando se deja */
			obj.hover(function() {
				bbox = this.getBBox();
				_label.attr({
					text: paths[arr[this.id]].name + " , " + data[paths[arr[this.id]].ubigeo].valor + uMedida
				}).update(bbox.x, bbox.y + bbox.height / 2, bbox.width).toFront().show();
			}, function() {
				_label.hide();
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

function cargarLeyenda(minimo, maximo, uMedida) {
	$("#tituloLeyenda").html("<h4>Leyenda en " + uMedida + "</h4>");
	$("#leyenda").html("<li class='text-error'>Bajo < " + minimo + "</li><li class='text-warning'> " + minimo + " <= Medio < " + maximo + "</li><li class='text-success'>Alto >= " + maximo + "</li>");
}

function graficar() {
	$('#chaptersMap').html('');
	$("#tituloLeyenda").html("");
	var provincia = $('#cbProvincia').val();
	var indicador = $('#cbIndicador').val();
	var periodo = $('#cbPeriodo').val();
	var anio = $('#cbAnio').val();
	var grafico = $('#cbGrafico').val();
	var uMedida, minimo, maximo;
	$.post("consulta_datos.php", {
		peticion: "datosIndicador",
		indicador: indicador
	},
	function(datos) {
		minimo = parseFloat(datos.minimo);
		maximo = parseFloat(datos.maximo);
		uMedida = datos.uMedida;
		cargarLeyenda(minimo, maximo, uMedida);
		if (grafico === "01") {
			$.post("consulta_grafico.php", {
				peticion: "mapas",
				provincia: provincia,
				indicador: indicador,
				anio: anio,
				periodo: periodo
			},
			function(data) {
				if (data) {
					graficarMapa(provincia, data, minimo, maximo, uMedida);
				} else {
					$('#chaptersMap').html("<h2>No hay Datos</h2>");
				}
			}, "json");
		}
		if (grafico === "02") {
			graficarBarra($('#chaptersMap'), indicador, provincia, periodo, anio, minimo, maximo, uMedida);
		}
		if (grafico === "03") {
			graficarCirculares($('#chaptersMap'), indicador, provincia, periodo, anio);
		}
		if (grafico === "04") {
			graficarHistorico($('#chaptersMap'), indicador, provincia, periodo, anio, minimo, maximo, uMedida);
		}
	}, "json");
}

function descargarExcel() {
	var provincia = $('#cbProvincia').val();
	var indicador = $('#cbIndicador').val();
	var anio = $('#cbAnio option:selected').text();
	var periodo = $('#cbPeriodo').val();
	window.location.href = 'excel_grafico.php?provincia=' + provincia + '&idindicador=' + indicador + '&anio=' + anio + '&idperiodo=' + periodo;
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

	$.post("consulta_datos_html.php", {
		peticion: "institucion"
	},
	function(data) {
		$("#cbInstitucion").html(data);
		$("#cbInstitucion").trigger('change');
	}, "html");

	$('#cbGrafico').on('change', function() {
		if ($("#cbGrafico").val() === "04") {
			$("#cbAnio").attr("disabled", "disabled");
		} else {
			$("#cbAnio").removeAttr("disabled");
		}
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
	$("#btnExcel").on('click', function() {
		descargarExcel();
	});
});