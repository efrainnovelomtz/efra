<!DOCTYPE html>
 <link rel="stylesheet" href="style.css">

<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "registropagos";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener valores del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $concepto = $_POST["concepto"];
    $importe = $_POST["importe"];
    $fecha = $_POST["fecha"];
    $nombre_recibe = $_POST["nombre_recibe"];
    $lugar_servicio = $_POST["lugar_servicio"];

    // Insertar datos en la base de datos
    $sql = "INSERT INTO pagos (nombre_cliente, apellido_cliente, concepto, importe, fecha, nombre_recibe, lugar_servicio)
            VALUES ('$nombre', '$apellido', '$concepto', $importe, '$fecha', '$nombre_recibe', '$lugar_servicio')";

    if ($conn->query($sql) === TRUE) {
        echo "Pago registrado correctamente";
    } else {
        echo "Error al registrar el pago: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
}
?>


<a href="index.html">Regresar</a>