<?php
$username = "root";
$password = "";
$dbname = "registropagos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexi�n fallida: " . $conn->connect_error);
}
$id = $_GET ["id"];
$eliminar = "DELETE FROM pagos WHERE id = '$id'":
$elimina = $conn->query($eliminar);
header ("location:consultar_pagos.php");
$conn->close(); 


?>

