<html>
	<head>
        <title>MAPAS-SIARAPURIMAC</title>
		<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="../excanvas.js"></script><![endif]-->
		<script src="js/jquery-1.9.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/raphael-min.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.min.css" />
		<script src="js/data_07.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			function graficar() {
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
					//attributes.fill = paths[correntPath].color;
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
			}
			$(document).ready(function() {
				graficar();
			});
		</script>
	</head>
	<body>
		<div class="span9 text-center">
			<div id="chaptersMap">
			</div>
		</div>
	</body>
</html>
