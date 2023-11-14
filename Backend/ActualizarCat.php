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
    $extension = pathinfo($_FILES["fil_foto"]["name"], PATHINFO_EXTENSION);
    $rutaImagen = $rutaCarpeta . $idC. "." .$extension;


    $sql = "update categorias set 
                nombre_categoria = '$nombreCat',
                ruta = '$rutaImagen'
            
            where
                id = $idC ";

    // Ejecutar la consulta de actualizacion
    //$result = pg_query($conn, $sql);


    // Ejecutar la consulta de actualizacion
    if (pg_query($conn, $sql)) {
        if (move_uploaded_file($_FILES["fil_foto"]["tmp_name"], $rutaImagen)) {
            echo "<script>alert('Actualizacion exitosa');</script>";    
            header("Refresh:0;url=http://localhost/AmorMX_final/pages/ReCategoria.php");
        } else {
            echo "<script>alert('No ha seleccionado una imagen.');</script>";
            header("Refresh:0;url=http://localhost/AmorMX_final/pages/ReCategoria.php");
        }
    } else {
        echo "Error al insertar la categoria: " . pg_last_error($conn);
    }

    // if (!$result) {
    //     die("Error al ejecutar la consulta de actualizacion.");
    // } else {
    //     echo "<script>alert('Actualizacion exitosa');</script>";
    //     header("Refresh:0;url=http://localhost/AmorMX_final/pages/ReCategoria.php");
    // }

    // Cerrar la conexión a la base de datos si es necesario
    pg_close($conn);

?>