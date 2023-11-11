<?php
    require('../conexion.php');

    session_start();

    if(!isset($_SESSION["id_usuario"])) {
		header("Location: Acceso.php");
	}



   // Conexion a la base de datos
    require('../conexion.php');

    $idU = $_POST['idU'];

    // Recuperar la información del formulario HTML
    $nombre = $_POST['name'];
    $dni = $_POST['dni'];
    $correo = $_POST['email'];
    $telefono = $_POST['phone'];
    $direccion = $_POST['dir'];
    $pass = $_POST['pass'];
    $tipo = $_POST['rol'];


    $sql = "update usuarios set 
                nombre_completo = '$nombre',
                cedula = '$dni',
                contrasena = '$pass',
                correo = '$correo',
                telefono = '$telefono',
                id_tipo_usuario = '$tipo',
                direccion = '$direccion'

            where
                id = $idU ";

    // Ejecutar la consulta de actualizacion
    $result = pg_query($conn, $sql);

    if (!$result) {
        die("Error al ejecutar la consulta de actualizacion.");
    } else {
        echo "<script>alert('Actualizacion exitosa');</script>";
        header("Refresh:0;url=http://localhost/AmorMX_final/pages/ReEmpleados.php");
    }

    // Cerrar la conexión a la base de datos si es necesario
    pg_close($conn);
?>
