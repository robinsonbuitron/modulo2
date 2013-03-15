<?php
session_start();
if (!isset($_SESSION['s_username'])) {
	header('Location: login.php');
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
	        <script class="include" src="js/mantenimiento_indicador.js"></script>
	        <script src="js/jquery.dataTables.min.js"></script>
	        <script src="js/DT_bootstrap.js"></script>
	    </head>
	    <body>
	        <div class="container">
	            <div id="formInsertar" class="row-fluid">
	                <div class="span12 well">
	                    <div class="span7 form-horizontal">
	                        <div class="control-group">
	                            <label class="control-label">Institucion: </label>
	                            <div class="controls">
	                                <select id="cbInstitucion" class="span12 cbInstitucion">
	                                </select>
	                            </div>
	                        </div>

	                        <div class="control-group">
	                            <label class="control-label">Ingrese Indicador: </label>
	                            <div class="controls">
	                                <input id="txtIndicador" class="span12" type="text" placeholder="descripcion Indicador">
	                            </div>
	                        </div>
	                        <div class="control-group">
	                            <label class="control-label">Unidad Medida: </label>
	                            <div class="controls">
	                                <select id="cbUnidadMedida" class="span12 cbUnidadMedida">
	                                </select>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="span5 form-horizontal">
	                        <div class="control-group">
	                            <label class="control-label">Valor Min: </label>
	                            <div class="controls">
	                                <input id="txtValorMin" class="span6" type="text" placeholder="Valor Minimo">
	                            </div>
	                        </div>
	                        <div class="control-group">
	                            <label class="control-label">Valor Max: </label>
	                            <div class="controls">
	                                <input id="txtValorMax"  class="span6" type="text" placeholder="Valor Máximo">
	                            </div>
	                        </div>

	                    </div>
	                    <div class="text-right">
	                        <button id="btnAgregar" type="button" class="btn btn-primary">Agregar</button>
	                        <button id="btnLimpiar" type="button" class="btn">Limpiar</button>
	                    </div>
	                </div>
	            </div>
	            <div>
	                <div id="tablaUsuarios">
						<?php include './lista_indicador.php'; ?>
	                </div>
	                <div id="myModal" class="modal hide fade form-horizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
	                    <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                        <h3 id="myModalLabel">Editar Indicador</h3>
	                    </div>
	                    <div class="modal-body">
	                        <input id="txtId" type="hidden">
	                        <div class="control-group">
	                            <label class="control-label">Codigo:</label>
	                            <div class="controls">
	                                <input id="txtIdindicadorE" readonly type="text">
	                            </div>
	                        </div>
	                        <div class="control-group">
	                            <label class="control-label">Institucion: </label>
	                            <div class="controls">
	                                <select id="cbInstitucionE" class="cbInstitucion">
	                                </select>
	                            </div>
	                        </div>
	                        <div class="control-group">
	                            <label class="control-label">Indicador:</label>
	                            <div class="controls">
	                                <input id="txtIndicadorE" type="text" class="span3" placeholder="Descripcion Indicador">
	                            </div>
	                        </div>
	                        <div class="control-group">
	                            <label class="control-label">Unidad Medida: </label>
	                            <div class="controls">
	                                <select id="cbUnidadMedidaE" class="cbUnidadMedida">
	                                </select>
	                            </div>
	                        </div>
	                        <div class="control-group">
	                            <label class="control-label">Valor Min: </label>
	                            <div class="controls">
	                                <input id="txtValorMinE" class="span1" type="text" placeholder="Valor Minimo">
	                            </div>
	                        </div>
	                        <div class="control-group">
	                            <label class="control-label">Valor Max: </label>
	                            <div class="controls">
	                                <input id="txtValorMaxE"  class="span1" type="text" placeholder="Valor Máximo">
	                            </div>
	                        </div>
	                    </div>
	                    <div class="modal-footer">
	                        <button id="btnEditar" type="button" class="btn btn-primary">Editar</button>
	                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
	                    </div>
	                </div>
	            </div>
	            <div id="resultado">

	            </div>
	        </div> <!-- /container -->
	    </body>
	</html>
	<?php
}
?>