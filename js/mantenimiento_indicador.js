$(document).ready(function() {
    //cargar conbobox unidad de medida
    $.post("consulta_datos.php", {
        peticion: "unidad_medida"
    },
    function(data) {
        $.each(data, function(index, value) {
            $(".cbUnidadMedida").append("<option value='" + data[index].idunidadmedida + "'>" + data[index].abreviatura + "</option>");
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
        if ($(this).text() === 'Eliminar') {
            var codigo = $(this).closest("tr").attr("id");
            var tr = $(this).closest("tr");
            $.post("mantenimiento_indicador.php", {
                action: "eliminar",
                idindicador: codigo
            },
            function(data) {
                if (data.title !== "error") {
                    tr.remove();
                }
                $("#resultado").html(data.html);
            }, "json");
        }
        if ($(this).text() === 'Editar') {
            $(this).closest("tr").each(function(index) {
                $(this).children("td").each(function(index2) {
                    switch (index2) {
                        case 0:
                            $("#txtIdindicadorE").val($(this).text());
                            break;
                        case 1:
                            var texto1 = $(this).text();
                            $("#cbInstitucionE").find("option").filter(function(index) {
                                return texto1 === $(this).text();
                            }).prop("selected", "selected");
                            break;
                        case 2:
                            $("#txtIndicadorE").val($(this).text());
                            break;
                        case 3:
                            var texto2 = $(this).text();
                            $("#cbUnidadMedidaE").find("option").filter(function(index) {
                                return texto2 === $(this).text();
                            }).prop("selected", "selected");
                            break;
                        case 4:
                            $("#txtValorMinE").val($(this).text());
                            break;
                        case 5:
                            $("#txtValorMaxE").val($(this).text());
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
    //funcionalidad de modificar un indicador
    $("#btnEditar").click(function() {
        $("#btnEditar").text("Editandoo...");
        $("#btnEditar").attr("disabled", "disabled");
        var codigo = $('#txtIdindicadorE').val();
        var institucion = $('#cbInstitucionE').val();
        var indicador = $('#txtIndicadorE').val();
        var unidadmedida = $('#cbUnidadMedidaE').val();
        var valormin = $('#txtValorMinE').val();
        var valormax = $('#txtValorMaxE').val();
        $.post("mantenimiento_indicador.php", {
            action: "modificar",
            idindicador: codigo,
            idunidadmedida:unidadmedida,
            idinstitucion: institucion,
            descripcion:indicador,
            valorminimo: valormin,
            valormaximo: valormax
        },
        function(data) {
            if (data.title !== "error") {
                $("#example tbody tr").each(function(index) {
                    if ($(this).attr("id") === $("#txtIdindicadorE").val()) {
                        $(this).html('<td>' + codigo + '</td><td>' + $('#cbInstitucionE option:selected').text() + '</td><td>' + indicador + '</td><td>' + $('#cbUnidadMedidaE option:selected').text() + '</td><td>' + valormin + '</td><td>' + valormax + '</td><td><a href="#myModal" data-toggle="modal">Editar</a></td><td><a href="#">Eliminar</a></td>');
                    }
                });
                $("#resultado").html(data.html);
                $("#btnEditar").removeAttr("disabled");
                $("#btnEditar").text("Editar");
                $('#myModal').modal('hide');
            }
        }, "json");
    });
    //funcionalidad de la accion de insertar un nuevo indicador
    $("#btnAgregar").click(function() {
        $("#btnAgregar").text("Agregando...");
        $("#btnAgregar").attr("disabled", "disabled");
        var institucion = $('#cbInstitucion').val();
        var indicador = $('#txtIndicador').val();
        var unidadmedida = $('#cbUnidadMedida').val();
        var valormin = $('#txtValorMin').val();
        var valormax = $('#txtValorMax').val();
        $.post("mantenimiento_indicador.php", {
            action: "insertar",
            idunidadmedida:unidadmedida,
            idinstitucion: institucion,
            descripcion:indicador,
            valorminimo: valormin,
            valormaximo: valormax
        },
        function(data) {
            if (data.title !== "error") {
                $('#example > tbody:last').append('<tr id="' + data.title + '"><td>'+data.title+'</td><td>' + $('#cbInstitucion option:selected').text() + '</td><td>' + indicador + '</td><td>' + $('#cbUnidadMedida option:selected').text() + '</td><td>' + valormin + '</td><td>' + valormax + '</td><td><a href="#myModal" data-toggle="modal">Editar</a></td><td><a href="#">Eliminar</a></td>');
                $("#formInsertar input").val("");
            }
            $("#resultado").html(data.html);
            $("#btnAgregar").removeAttr("disabled");
            $("#btnAgregar").text("Agregar");
        }, "json");
    });
});


