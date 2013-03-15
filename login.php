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

