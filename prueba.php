<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>
		<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
		<script type="text/javascript">
			$(function() {
				var indicadorName = "Nutricion y Desnutricion";
				var minimo = 10;
				var maximo = 80;
				var peridoName = "Anual";
				var anio = "2013";
				var uMedida = "%";
				$('#container').highcharts({
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
					series: []
				});
				$.post("consulta_prueba.php", {peticion: "hola"}, function(data) {
					var chart = $('#container').highcharts();
					chart.addSeries({
						type: 'pie',
						name: indicadorName,
						data: data
					});
					chart.redraw();
				}, "json");
			});
		</script>
	</head>
	<body>
		<script src="js/highcharts.js"></script>
		<script src="js/modules/exporting.js"></script>
		<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
	</body>
</html>
