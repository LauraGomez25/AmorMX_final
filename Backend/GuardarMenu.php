<?php

    //conexion base de datos
    require('../conexion.php');

    //recuperar la informacion del formulario html ReEmpleados
    $categoria = $_POST['categoria'];
    $estado = "A";
    
    // Procesa la imagen
    $rutaCarpeta = "../fotos/";
    $nombreImagen = $_FILES["fil_foto"]["name"];
    $rutaImagen = $rutaCarpeta . $nombreImagen;


    //preparar sql
    $sql = "insert into categorias (nombre_categoria, estado, ruta) values('$categoria','$estado','$rutaImagen');";

     // Execute sql
     $result = pg_query($conn, $sql);

     if (!$result) {
        die("Error al ejecutar la consulta.");
    }else{
        // Mueve la imagen desde el directorio temporal al directorio de destino
        if (move_uploaded_file($_FILES["fil_foto"]["tmp_name"], $rutaImagen)) {
            echo "<script>alert('Registro exitoso');</script>";
            header("Refresh:0;url=http://localhost/AmorMX/pages/Administrador.php");
        } else {
            echo "<script>alert('No ha seleccionado una imagen.');</script>";
            header("Refresh:0;url=http://localhost/AmorMX/pages/ReMenu.php");
        }

    }  

?>