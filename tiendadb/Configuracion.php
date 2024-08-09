<?php
// Detalles de la base de datos
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'tiendadb';

// Crea conexión y seleccionar la base de datos
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Verifica si hay errores en la conexión
if ($db->connect_error) {
    die("No hay conexión con la base de datos: " . $db->connect_error);
}
?>
