function modificar(passwd, newPasswd) {
	$("#btnModificar").text("Modificando...");
	$("#btnModificar").attr("disabled", "disabled");
	$.post("mantenimiento_usuarios.php", {
		action: "password",
		password: passwd,
		newPassword: newPasswd
	},
	function(data) {
		$("#resultado").html(data.html);
		$("#btnModificar").removeAttr("disabled");
		$("#btnModificar").text("Modificar");
	}, "json");
}

$(document).ready(function() {
	$("#formInsertar").validate({
		rules: {
			txtPassword: {
				required: true,
				minlength: 5
			},
			txtPasswordR: {
				required: true,
				minlength: 5,
				equalTo: "#txtPassword"
			}
		},
		messages: {
			txtPassword: {
				required: "Ingrse Password"
			}
		}
	});
	$("#btnModificar").on('click', function() {
		if ($("#formInsertar").valid()) {
			modificar($("#txtPasswordA").val(), $("#txtPassword").val());
		}
	});
});