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
		$resultado = $conexion->consulta("select * from tusuario where idusuario='$username'");
		$filas = pg_numrows($resultado);
		if ($filas != 0) {
			include 'lib/Encrypter.php';
			$dni = pg_result($resultado, 0, 0);
			$idinstitucion = pg_result($resultado, 0, 1);
			$idprivilegios = pg_result($resultado, 0, 2);
			$nomape = pg_result($resultado, 0, 3);
			$password2 = pg_result($resultado, 0, 4);
			$password = Encrypter::encrypt($password);
			if ($password != $password2) {
				$msj = "Login incorrecto";
			} else {
				$_SESSION["s_username"] = $dni;
				$_SESSION["s_nameape"] = $nomape;
				$_SESSION["s_idprivilegios"] = $idprivilegios;
				$_SESSION["s_idinstitucion"] = $idinstitucion;
				if ($_SESSION["s_idprivilegios"] == "00001") {
					header('Location: usuarios.php');
					exit();
				}
				header('Location: lectura.php');
				exit();
			}
		} else {
			$msj = "El usuario no existe";
		}
	}
}
?>

<div class="content">
    <div class="row">
		<?php if (!isset($_SESSION['s_username'])) { ?>
			<div class="login-form">
				<h3>Inicio de Sesion</h3>
				<form action="#" method="POST">
					<fieldset>
						<div class="control-group">
							<label class="control-label">DNI:</label>
							<div class="controls">
								<span class="add-on"><i class="icon-user"></i></span> <input type="text" name="username" id="username" placeholder="Ingrese usuario">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="inputPassword">Password:</label>
							<div class="controls">
								<span class="add-on"><i class="icon-lock"></i></span> <input type="password" name="password" id="password" placeholder="Password">
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
		<?php } else { ?>
			<div class="text-center">
				<img src="img/facebook.jpg" class="img-polaroid">
				<p><strong>Usuario: </strong><?php echo $_SESSION["s_nameape"]; ?></p>
				<a href="logout.php" class="btn btn-primary">Cerrar Sesion</a>
				<a href="lectura.php" class="btn btn-warning">Administrar</a>
			</div>
		<?php } ?>
    </div>
</div>