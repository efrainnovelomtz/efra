<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "registropagos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_pago = $_GET['id'];

    // Consulta para obtener la información del pago
    $sql_pago = "SELECT * FROM pagos WHERE id = $id_pago";
    $result_pago = $conn->query($sql_pago);

    if ($result_pago->num_rows > 0) {
        $pago = $result_pago->fetch_assoc();
    } else {
        echo "Pago no encontrado";
        exit();
    }
} else {
    echo "Parámetros incorrectos";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Ticket</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            NOVNET - Generar Ticket
        </div>

        <div id="ticket">
            <h2>Detalles del Pago</h2>
            <p>ID: <?php echo $pago['id']; ?></p>
            <p>Nombre Cliente: <?php echo $pago['nombre_cliente']; ?></p>
            <p>Apellido Cliente: <?php echo $pago['apellido_cliente']; ?></p>
            <p>Concepto: <?php echo $pago['concepto']; ?></p>
            <p>Importe: <?php echo $pago['importe']; ?></p>
            <p>Fecha: <?php echo $pago['fecha']; ?></p>
            <p>Nombre de quien Recibe: <?php echo $pago['nombre_recibe']; ?></p>
            <p>Lugar del Servicio: <?php echo $pago['lugar_servicio']; ?></p>
        </div>
    </div>

    <a href="index.html">Regresar</a>
</body>
</html>
