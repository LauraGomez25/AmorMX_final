<?php

    use PgSql\Connection;
    //conexion base de datos
    require('../conexion.php');

    //recuperar la informacion del formulario html ReEmpleados
    $categoria = $_POST['categoria'];
    $estado = "A";
    
    // Procesa la imagen
    $rutaCarpeta = "../fotos/";
    $nombreImagen = $_FILES["fil_foto"]["name"];
    $rutaImagen = $rutaCarpeta . $nombreImagen;
    $extension = pathinfo($_FILES["fil_foto"]["name"], PATHINFO_EXTENSION);

    

    //preparar sql
    $sql = "insert into categorias (nombre_categoria, estado, ruta) values('$categoria','$estado','$rutaImagen');";

     // Execute sql
     //$result = pg_query($conn, $sql);

     if (pg_query($conn, $sql)) {

        $sql_last_id = "select id from categorias order by id desc limit 1";
        $res = pg_query($conn, $sql_last_id);

        while($row = pg_fetch_assoc($res)){
            $lastId = $row['id'];
        }

        $nuevaRuta = $rutaCarpeta . $lastId. "." .$extension;
        $sql_update_foto_name = "update categorias set ruta = '$nuevaRuta' where id = $lastId";
        $res = pg_query($conn, $sql_update_foto_name);

        $rutaImagen = $rutaCarpeta . $lastId. "." .$extension;

        if (move_uploaded_file($_FILES["fil_foto"]["tmp_name"], $rutaImagen)) {
            echo "<script>alert('Registro exitoso');</script>";    
            header("Refresh:0;url=http://localhost/AmorMX_final/pages/ReCategoria.php");
        } else {
            echo "<script>alert('No ha seleccionado una imagen.');</script>";
            header("Refresh:0;url=http://localhost/AmorMX_final/pages/ReCategoria.php");
        }
    } else {
        echo "Error al insertar la categoria: " . pg_last_error($conn);
    }

?>