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
	$resultado = $conexion->consulta("select Descripcion from tvariable where IDVariable='" . $idVariable . "'");
	//$sql = $mysql->query("select Descripcion from tvariable where IDVariable='" . $idVariable . "'");
	if (!$resultado) {
		echo "<b>Error de busqueda</b>";
		exit;
	}
	$contador = 1;
	$filas = pg_numrows($resultado);
	if ($filas == 0) {
		echo "<div class='alert alert-error' id='mensaje'>";
		echo "<strong>Error:<strong> No se encontraron datos en esta estacion ";
		echo "</div>";
	} else {
		echo '<pre>';
		echo '<h5>Migracion ' . $_POST['numero'] . ' - ' . pg_result($resultado, 0, 0) . '</h5>';

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
			if ($error) {
				echo '<div class="alert alert-error"><strong>Error:</strong> ' . $error . '</div>';
			} else {
				$contador = 0;
				foreach ($result as $key => $value) {
					$codigort = $value['codigort'];
					$fecha = $value['fecha'];
					$valor = ($value['valor'] == "" || $value['valor'] == NULL) ? "NULL" : $value['valor'];
					$sql = $conexion->consulta("INSERT INTO tlectura VALUES (E'$idVariable',E'$codigort',E'$fecha',$valor)");
					//$sentencia = "call sprInsertarTLectura('" . $idVariable . "','" . $codigort . "','" . $fecha . "'," . $valor . ")";
					if (!$sql) {
						echo '<div class="alert alert-error">';
						echo '<strong>Duplicado!</strong> variable:' . $idVariable . ' estacion: ' . $codigort . ' fecha:' . $fecha . ' valor:' . $valor;
						echo '</div>';
						//echo "Consulta: " . $contador . "Fallo en la insercion de registro en la Base de Datos: " . mysql_error() . "<br>";
					} else {
						$contador++;
						echo '<div class="alert alert-success">';
						echo '<strong>Se inserto!</strong> variable:' . $idVariable . ' estacion: ' . $codigort . ' fecha:' . $fecha . ' valor:' . $valor;
						echo '</div>';
					}
				}
				echo '<div class="alert alert-info">';
				echo '<strong>Total de ingresos:</strong> ' . $contador . ' filas';
				echo '</div>';
			}
		}
		echo 'listo!!';
		echo '</pre>';
	}
}
?>
