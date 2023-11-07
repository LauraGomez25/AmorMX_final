<?php
// Conexion a la base de datos
require('../conexion.php');

// Recuperar la información del formulario HTML
$nombre = $_POST['name'];
$dni = $_POST['dni'];
$correo = $_POST['email'];
$telefono = $_POST['phone'];
$direccion = $_POST['dir'];
$pass = $_POST['pass'];
$tipo = $_POST['rol'];

// Consulta SQL para verificar si el DNI ya existe
$sql_check_dni = "SELECT id FROM usuarios WHERE cedula = '$dni'";

// Ejecutar la consulta para verificar si el DNI ya existe
$result_check_dni = pg_query($conn, $sql_check_dni);

if (!$result_check_dni) {
    die("Error al comprobar el DNI: " . pg_last_error($conn));
}

// Comprobar si el DNI ya existe
if (pg_num_rows($result_check_dni) > 0) {
    echo "<script>alert('El DNI ya existe en la base de datos. No se puede registrar el mismo usuario.');</script>";
    header("Refresh:0;url=http://localhost/AmorMX/pages/ReEmpleados.php");
} else {
    // La cédula no existe, continuar con la inserción
    // Preparar SQL para insertar el usuario
    $sql_insert_usuario = "INSERT INTO usuarios (nombre_completo, cedula, contrasena, correo, telefono, id_tipo_usuario, direccion)
    VALUES ('$nombre', '$dni', '$pass', '$correo', '$telefono', $tipo, '$direccion')";

    // Ejecutar la consulta de inserción
    $result = pg_query($conn, $sql_insert_usuario);

    if (!$result) {
        die("Error al ejecutar la consulta de inserción.");
    } else {
        echo "<script>alert('Registro exitoso');</script>";
        header("Refresh:0;url=http://localhost/AmorMX/pages/Administrador.php");
    }
}

// Cerrar la conexión a la base de datos si es necesario
pg_close($conn);
?>
