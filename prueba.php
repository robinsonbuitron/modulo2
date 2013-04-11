<script type="text/javascript" src="js/json2.js"></script>
<script src="js/jquery-1.8.3.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	$.post("consulta_datos.php", {
		peticion: "minimo_maximo",
		indicador: '1006'
	},
	function(strJson) {
		var data = JSON.getJSONArray(strJson);
		alert("Unidad Medidad: " + data.unidadMedida);
	}, "json");
</script>