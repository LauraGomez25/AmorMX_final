<?php

require('../conexion.php');

    session_start();

    if(!isset($_SESSION["id_usuario"])) {
		header("Location: Acceso.php");
	}



   // Conexion a la base de datos
    require('../conexion.php');

    $idP = $_POST['idP'];

    // Recuperar la información del formulario HTML
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $tipo = $_POST['rol']; 
   
    $rutaCarpeta = "../fotos/";
    $nombreImagen = $_FILES["fil_foto"]["name"];
    $rutaImagen = $rutaCarpeta . $nombreImagen;


    $sql = "update platos set 
                nombre = '$nombre',
                precio = '$precio',
                id_categoria = '$tipo',
                ruta = '$rutaImagen'
            
            where
                id = $idP ";

    // Ejecutar la consulta de actualizacion
    $result = pg_query($conn, $sql);

    if (!$result) {
        die("Error al ejecutar la consulta de actualizacion.");
    } else {
        echo "<script>alert('Actualizacion exitosa');</script>";
        header("Refresh:0;url=http://localhost/AmorMX_final/pages/RePLato.php");
    }

    // Cerrar la conexión a la base de datos si es necesario
    pg_close($conn);

?>