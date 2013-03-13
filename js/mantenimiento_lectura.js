/*
 * Este es coidgo ajax para el manetimiento de indicadores.
 * @GRA
 * Proyecto Siar
 */


$(document).ready(function(){
	$("#example").delegate("a","click",function(event) {
		if($(this).text()=='Eliminar'){
			$(this).closest("tr").remove(); // remove row
		}
		if($(this).text()=='Editar'){
			$(this).closest("tr").each(function (index) {
				$(this).children("td").each(function (index2) {
					switch (index2) {
						case 0:
							$("#txtPeriodoE").val($(this).text());
							break;
                                                        $("#txtValorE").val($(this).text());
							break;
						}
				})
			})
		}
	});
        
	$("#btnEditar").click(function(){
		$("#example tbody tr").each(function (index) {
			if ($(this).attr("id")==$("#txtPeriodoE").val()) {
				$(this).html('<td>'+$('#txtPeriodoE').val()+'</td><td>'+$('#txtValorE').val()+'</td><td><a href="#myModal" data-toggle="modal">Editar</a></td><td><a href="#">Eliminar</a></td>');
			}
		});
		$('#myModal').modal('hide');
	});
        
	$("#btnAgregar").click(function(){
		$('#example > tbody:last').append('<tr id="'+$('#cbPeriodo').val()+'"><td>'+$('#cbPeriodo').val()+'<td>'+$('#txtValor').val()+'</td><td><a href="#myModal" data-toggle="modal">Editar</a></td><td><a href="#">Eliminar</a></td></tr>');
	});
});

