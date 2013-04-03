<?php
// defino la carpeta para subir
$uploaddir = 'variablesExcel/';
// defino el nombre del archivo
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
// Lo mueve a la carpeta elegida
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "El archivo es válido y fue cargado exitosamente.\n";
} else {
    echo "¡Posible error de carga de archivos!\n";
}
?>