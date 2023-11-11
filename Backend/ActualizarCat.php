<?php

require('../conexion.php');

    session_start();

    if(!isset($_SESSION["id_usuario"])) {
		header("Location: Acceso.php");
	}



   // Conexion a la base de datos
    require('../conexion.php');

    $idC = $_POST['idC'];

    // Recuperar la información del formulario HTML
    $nombreCat = $_POST['categoria'];
   
    $rutaCarpeta = "../fotos/";
    $nombreImagen = $_FILES["fil_foto"]["name"];
    $rutaImagen = $rutaCarpeta . $nombreImagen;


    $sql = "update categorias set 
                nombre_categoria = '$nombreCat',
                ruta = '$rutaImagen'
            
            where
                id = $idC ";

    // Ejecutar la consulta de actualizacion
    $result = pg_query($conn, $sql);

    if (!$result) {
        die("Error al ejecutar la consulta de actualizacion.");
    } else {
        echo "<script>alert('Actualizacion exitosa');</script>";
        header("Refresh:0;url=http://localhost/AmorMX_final/pages/ReCategoria.php");
    }

    // Cerrar la conexión a la base de datos si es necesario
    pg_close($conn);

?>