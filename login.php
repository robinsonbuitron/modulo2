<?php
session_start();
$msj = "Ingrese sus datos para iniciar sesion";
if (isset($_POST['username'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	if ($password == NULL) {
		$msj = "La password no fue enviada";
	} else {
		include 'conexion/pgsql.php';
		$conexion = new ConexionPGSQL();
		$conexion->conectar();
		$resultado = $conexion->consulta("select password from tusuario where idusuario='$username'");
		$filas = pg_numrows($resultado);
		if ($filas != 0) {
			include 'lib/Encrypter.php';
			$password2 = pg_result($resultado, 0, 0);
			$password = Encrypter::encrypt($password);
			if ($password != $password2) {
				$msj = "Login incorrecto";
			} else {
				$_SESSION["s_username"] = $username;
				header('Location: usuarios.php');
				exit();
			}
		} else {
			$msj = "El usuario no existe";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<style type="text/css">
			/* Override some defaults */
			html, body {
				background-color: #eee;
			}
			body {
				padding-top: 40px; 
			}
			.container {
				width: 300px;
			}

			/* The white background content wrapper */
			.container > .content {
				background-color: #fff;
				padding: 20px;
				margin: 0 -20px; 
				-webkit-border-radius: 10px 10px 10px 10px;
				-moz-border-radius: 10px 10px 10px 10px;
                border-radius: 10px 10px 10px 10px;
				-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
				-moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
			}

			.login-form {
				margin-left: 65px;
			}

			legend {
				margin-right: -50px;
				font-weight: bold;
				color: #404040;
			}

		</style>
    </head>
    <body>
		<div class="container">
			<div class="content">
				<div class="row">
					<div class="login-form">
						<h3>Inicio de Sesion</h3>
						<form action="#" method="POST">
							<fieldset>
								<div class="control-group">
									<label class="control-label">DNI:</label>
									<div class="controls">
										<input type="text" name="username" id="username" placeholder="Ingrese usuario">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputPassword">Password:</label>
									<div class="controls">
										<input type="password" name="password" id="password" placeholder="Password">
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<label class="checkbox">
											<input type="checkbox"> Recuerdame
										</label>
										<button type="submit" class="btn btn-primary">Ingresar</button>
									</div>
								</div>
							</fieldset>
						</form>
						<div><?php echo $msj; ?></div>
					</div>
				</div>
			</div>
		</div> <!-- /container -->
	</body>
</html>