<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "registropagos";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardar'])) {
    $id_a_editar = $_POST['id'];
    $nombre_cliente = $_POST['nombre_cliente'];
    $concepto = $_POST['concepto'];
    $importe = $_POST['importe'];
    $fecha = $_POST['fecha'];
    $nombre_recibe = $_POST['nombre_recibe'];

    $sql_update = "UPDATE pagos SET 
                   nombre_cliente='$nombre_cliente', 
                   concepto='$concepto', 
                   importe=$importe, 
                   fecha='$fecha', 
                   nombre_recibe='$nombre_recibe' 
                   WHERE id=$id_a_editar";

    if ($conn->query($sql_update) === TRUE) {
        echo "Registro actualizado con éxito";
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $id_a_editar = $_GET['id'];
    $sql_edit = "SELECT * FROM pagos WHERE id=$id_a_editar";
    $result_edit = $conn->query($sql_edit);

    if ($result_edit->num_rows > 0) {
        $row_edit = $result_edit->fetch_assoc();
        $nombre_cliente_edit = $row_edit["nombre_cliente"];
        $concepto_edit = $row_edit["concepto"];
        $importe_edit = $row_edit["importe"];
        $fecha_edit = $row_edit["fecha"];
        $nombre_recibe_edit = $row_edit["nombre_recibe"];
    } else {
        echo "No se encontró el registro a editar";
        exit();
    }
} else {
    echo "<script>alert('Registro Modificado');window.location.href='consultar_pagos.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Pago</title>
      <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Pago</h1>
    <form action="editar_pago.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id_a_editar; ?>">
        <label for="nombre_cliente">Nombre del Cliente:</label>
        <input type="text" name="nombre_cliente" value="<?php echo $nombre_cliente_edit; ?>" required><br>

        <label for="concepto">Concepto:</label>
        <input type="text" name="concepto" value="<?php echo $concepto_edit; ?>" required><br>

        <label for="importe">Importe:</label>
        <input type="number" name="importe" step="0.01" value="<?php echo $importe_edit; ?>" required><br>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" value="<?php echo $fecha_edit; ?>" required><br>

        <label for="nombre_recibe">Nombre de quien Recibe:</label>
        <input type="text" name="nombre_recibe" value="<?php echo $nombre_recibe_edit; ?>" required><br>

        <input type="submit" name="guardar" value="Guardar Cambios">
    </form>
</body>
</html>
<a href="consultar_pagos.php">Cancelar Operacion</a>
