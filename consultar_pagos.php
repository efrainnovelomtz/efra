<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "registropagos";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexi?n fallida: " . $conn->connect_error);
}

// Manejo de la consulta de historial de pagos
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nombre'])) {
    $nombre_cliente = $_GET['nombre'];

    // Consulta para obtener todos los pagos hechos a ese nombre o con las primeras 4 letras del nombre
    $sql_historial_pagos = "SELECT * FROM pagos WHERE nombre_cliente LIKE '$nombre_cliente%' LIMIT 10";
    $result_historial_pagos = $conn->query($sql_historial_pagos);
    $historial_pagos = $result_historial_pagos->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultar Pagos</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="header">
            NOVNET - Consultar Pagos
        </div>

        <form>
            <label for="nombre_consulta">Buscar por Nombre:</label>
            <input type="text" name="nombre_consulta" id="nombre_consulta" required>
            <input type="button" value="Buscar" onclick="buscarClientes()">
        </form>

        <div id="resultado_consulta"></div>

        <?php if (isset($historial_pagos)): ?>
            <div id="historial_pagos">
                <h2>Historial de Pagos para <?php echo $nombre_cliente; ?></h2>
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Nombre Cliente</th>
                        <th>Apellido Cliente</th>
                        <th>Concepto</th>
                        <th>Importe</th>
                        <th>Fecha</th>
                        <th>Nombre de quien Recibe</th>
                        <th>Lugar del Servicio</th>
                        <th>Acciones</th>
                    </tr>
                    <!-- ... (c?digo anterior) ... -->
<?php foreach ($historial_pagos as $pago): ?>
    <tr>
        <td><?php echo $pago['id']; ?></td>
        <td><?php echo $pago['nombre_cliente']; ?></td>
        <td><?php echo $pago['apellido_cliente']; ?></td>
        <td><?php echo $pago['concepto']; ?></td>
        <td><?php echo $pago['importe']; ?></td>
        <td><?php echo $pago['fecha']; ?></td>
        <td><?php echo $pago['nombre_recibe']; ?></td>
        <td><?php echo $pago['lugar_servicio']; ?></td>
        <td><a href='generar_ticket.php?id=<?php echo $pago['id']; ?>'>Generar Ticket</a></td>
    </tr>
<?php endforeach; ?>
<!-- ... (c?digo posterior) ... -->

                </table>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function buscarClientes() {
            var nombreConsulta = $('#nombre_consulta').val();

            $.ajax({
                type: 'GET',
                url: 'consultar_pagos.php',
                data: { nombre: nombreConsulta },
                dataType: 'html',
                success: function(data) {
                    $('#resultado_consulta').html(data);
                }
            });
        }
    </script>

    
</body>
</html>



<a href="index.html">Regresar</a>