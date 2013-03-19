//Funcionalidad para realizar opreaciones sobre la tabla institucion

$(document).ready(function() {
    $("#frmInsertar").validate({
        rules: {
            txtsiglas: {
                required: true,
                minlength: 4

            },
            txtnombinst: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            txtsiglas: {
                required: "Debe ingresar sigla de la Institucion"
            },
            txtnombinst: {
                required: "Debe ingresar nombre de la Institución"
            }

        }
    });
    $("#example").delegate("a", "click", function(event) {
        if ($(this).text() === 'Eliminar') {
            var codigo = $(this).closest("tr").attr("id");
            var tr = $(this).closest("tr");
            $.post("mantenimiento_institucion.php", {
                action: "eliminar",
                idinstitucion: codigo
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
                            $("#txtIdInstitucionE").val($(this).text());
                            break;
                        case 1:
                            $("#txtSiglaE").val($(this).text());
                            break;
                        case 2:
                            $("#txtNombreInstE").val($(this).text());
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
    //funcionalidad de modificar la tabla institucion
    $("#btnEditar").click(function() {
        $("#btnEditar").text("Editandoo...");
        $("#btnEditar").attr("disabled", "disabled");
        var codigo = $('#txtIdInstitucionE').val();
        var sigla = $('#txtSiglaE').val();
        var institucion = $('#txtNombreInstE').val();
        $.post("mantenimiento_institucion.php", {
            action: "modificar",
            idinstitucion: codigo,
            siglas: sigla,
            nombinst: institucion
        },
        function(data) {
            if (data.title !== "error") {
                $("#example tbody tr").each(function(index) {
                    if ($(this).attr("id") === $("#txtIdInstitucionE").val()) {
                        $(this).html('<td>' + codigo + '</td><td>' + sigla + '</td><td>' + institucion + '</td><td><a href="#myModal" data-toggle="modal" class="btn btn-success"><i class="icon-edit"></i><strong>Editar</strong></a></td><td><a href="#" class="btn btn-danger"><i class="icon-trash"></i><strong>Eliminar</strong></a></td></tr>');
                    }
                });
                $("#resultado").html(data.html);
                $("#btnEditar").removeAttr("disabled");
                $("#btnEditar").text("Editar");
                $('#myModal').modal('hide');
            }
        }, "json");
    });
    //funcionalidad de la accion de insertar nueva institucion 
    $("#btnAgregar").click(function() {
        if ($("#frmInsertar").valid()) {
            $("#btnAgregar").text("Agregando...");
            $("#btnAgregar").attr("disabled", "disabled");
            var codigoinst = $('#txtidinst').val();
            var sigla = $('#txtsiglas').val();
            var institucion = $('#txtnombinst').val();
            $.post("mantenimiento_institucion.php", {
                action: "insertar",
                idinstitucion: codigoinst,
                siglas: sigla,
                nombinst: institucion
            },
            function(data) {
                if (data.title !== "error") {
                    $('#example > tbody:last').append('<tr id="' + data.title + '"><td>' + data.title + '</td><td>' + sigla + '</td><td>' + institucion + '</td><td><a href="#myModal" data-toggle="modal" class="btn btn-success"><i class="icon-edit"></i><strong>Editar</strong></a></td><td><a href="#" class="btn btn-danger"><i class="icon-trash"></i><strong>Eliminar</strong></a></td></tr>');
                    $("#frmInsertar input").val("");

                }
                $("#resultado").html(data.html);
                $("#btnAgregar").removeAttr("disabled");
                $("#btnAgregar").text("Agregar");
            }, "json");
        } else {
            $("#resultado").html('<div class="alert alert-error"><strong>Error!</strong> Campos requeridos para insertar nuevo usuario</div>');
        }
    });
});


