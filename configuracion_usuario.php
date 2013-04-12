<?php
session_start();
if (!isset($_SESSION['s_username'])) {
    header('Location: index.php');
    exit();
} else {
    ?>
    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title></title>
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="css/DT_bootstrap.css" rel="stylesheet">
            <script class="include" src="js/jquery-1.9.1.min.js"></script>
            <script class="include" src="js/bootstrap.min.js"></script>
            <script src="js/jquery.validate.min.js"></script>
            <script src="js/messages_es.js"></script>
            <script src="js/configuracion_usuario.js"></script>
        </head>
        <body>
            <?php include './menu.php'; ?>
            <div class="container">
                <form id="formInsertar" class="row-fluid">
                    <div class="span12 well">
                        <div class="span7 form-horizontal">
                            
                            <div class="header-inner">
                                <h3>Contraseña</h3>
                                <p>Cambia tu contraseña</p>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Contraseña actual: </label>
                                <div class="controls">
                                    <input id="txtPasswordA" name="txtPasswordA" type="password" placeholder="contraseña">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nueva Contraseña: </label>
                                <div class="controls">
                                    <input id="txtPassword" name="txtPassword" type="password" placeholder="contraseña">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Confimar contraseña: </label>
                                <div class="controls">
                                    <input id="txtPasswordR" name="txtPasswordR" type="password" placeholder="confirmar contraseña">
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button id="btnModificar" type="button" class="btn btn-primary">Guardar Cambios</button>
                            <button id="btnLimpiar" type="button" class="btn">Limpiar</button>
                        </div>
                    </div>
                </form>
                <div id="resultado">
                </div>
            </div> <!-- /container -->
        </body>
    </html>
    <?php
}
?>