<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('lib/nusoap.php');
require('conexion/pgsql.php');

if (isset($_POST['variable'])) {
	//sleep(1);
	$conexion = new ConexionPGSQL();
	$conexion->conectar();
	$idVariable = $_POST['variable'];

	$serverURL = 'http://www.senamhi.gob.pe/sistemas/webService';
	$serverScript = 'server.php';
	$metodoALlamar = 'datos';
	ini_set('memory_limit', '-1');

	$cliente = new nusoap_client("$serverURL/$serverScript?wsdl", 'wsdl');

	$error = $cliente->getError();
	if ($error) {
		echo '<div class="alert alert-error">' . $error;
		echo '<p>' . htmlspecialchars($cliente->getDebug(), ENT_QUOTES) . '</p></div>';
		die();
	}
	$fecha = array($_POST['fechaInicio'], $_POST['fechaFin']);
	//$fecha = array('2013-02-25', '2013-02-27');

	$result = $cliente->call(
			"$metodoALlamar", // Funcion a llamar
			array('idVariable' => $idVariable, 'idMetodoCaptura' => "3", 'periodo' => $fecha), // Parametros pasados a la funcion
			"uri:$serverURL/$serverScript", // namespace
			"uri:$serverURL/$serverScript/$metodoALlamar" // SOAPAction
	);

	if ($cliente->fault) {
		echo '<div class="alert alert-error"><strong>Error:</strong> ';
		print_r($result);
		echo '</div>';
	} else {
		$error = $cliente->getError();
		if (!$error) {
			$contador = 0;
			foreach ($result as $key => $value) {
				$codigort = $value['codigort'];
				$fecha = $value['fecha'];
				$valor = ($value['valor'] == "" || $value['valor'] == NULL) ? "NULL" : $value['valor'];
				$sql = $conexion->consulta("INSERT INTO tlectura VALUES (E'$idVariable',E'$codigort',E'$fecha',$valor)");
				if ($sql) {
					$contador++;
				}
			}
			echo 'Se inserto ' . $contador . ' filas';
		}
	}
}
?>
