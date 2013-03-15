//Funcionalidad para realizar opreaciones sobre la tabla unidad de medida

$(document).ready(function() {
    $("#example").delegate("a", "click", function(event) {
        if ($(this).text() === 'Eliminar') {
            var codigo = $(this).closest("tr").attr("id");
            var tr = $(this).closest("tr");
            $.post("mantenimiento_um.php", {
                action: "eliminar",
                idunidadmedida: codigo
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
                            $("#txtidunidadmedidaE").val($(this).text());
                            break;
                        case 1:
                            $("#txtabreviaturaE").val($(this).text());
                            break;
                        case 2:
                            $("#txtdescripcionE").val($(this).text());
                            break;
                    }
                });
            });
        }
    });
    //funcionalidad del boton limpiar
    $("#btnLimpiar").click(function() {
        $("#frmInsertar input").val("");
    });
    //funcionalidad de modificar la tabla unidad de media
    $("#btnEditar").click(function() {
        $("#btnEditar").text("Editandoo...");
        $("#btnEditar").attr("disabled", "disabled");
        var codigo = $('#txtidunidadmedidaE').val();
        var unidad = $('#txtabreviaturaE').val();
        var desc = $('#txtdescripcionE').val();
        $.post("mantenimiento_um.php", {
            action: "modificar",
            unidadmedida: codigo,
            abreviatura: unidad,
            descripcion: desc

        },
        function(data) {
            if (data.title !== "error") {
                $("#example tbody tr").each(function(index) {
                    if ($(this).attr("id") === $("#txtunidadmedidaE").val()) {
                        $(this).html('<td>' + codigo + '</td><td>' + unidad + '</td><td>' + desc + '</td><td><a href="#myModal" data-toggle="modal">Editar</a></td><td><a href="#">Eliminar</a></td>');

                    }
                });
                $("#resultado").html(data.html);
                $("#btnEditar").removeAttr("disabled");
                $("#btnEditar").text("Editar");
                $('#myModal').modal('hide');
            }
        }, "json");
    });
    //funcionalidad de la accion de insertar nueva unidad de medida 
    $("#btnAgregar").click(function() {
        $("#btnAgregar").text("Agregando...");
        $("#btnAgregar").attr("disabled", "disabled");
        
        var unidad = $('#txtabreviatura').val();
        var desc = $('#txtdescripcion').val();
        $.post("mantenimiento_um.php", {
            action: "insertar",
            abreviatura: unidad,
            descripcion: desc

        },
        function(data) {
            if (data.title !== "error") {
                $('#example > tbody:last').append('<tr id="' + data.title + '"><td>' + data.title + '</td><td>' + unidad + '</td><td>' + desc + '</td><td><a href="#myModal" data-toggle="modal">Editar</a></td><td><a href="#">Eliminar</a></td></tr>');
                $("#frmInsertar input").val("");

            }
            $("#resultado").html(data.html);
            $("#btnAgregar").removeAttr("disabled");
            $("#btnAgregar").text("Agregar");
        }, "json");
    });
});


