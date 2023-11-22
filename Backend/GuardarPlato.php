<?php

    use PgSql\Connection;
    // Conexion a la base de datos
    require('../conexion.php');


    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $categoria_nombre = $_POST['categoria']; 
    // Procesar la imagen
    $rutaCarpeta = "../fotos/";
    $nombreImagen = $_FILES["fil_foto"]["name"];
    $rutaImagen = $rutaCarpeta . $nombreImagen;
    $extension = pathinfo($_FILES["fil_foto"]["name"], PATHINFO_EXTENSION);

    // Consulta SQL para obtener el nombre de la categoría
    $sql_categoria = "SELECT id FROM categorias WHERE nombre_categoria = '$categoria_nombre'";

    // Ejecutar la consulta
    $result_categoria = pg_query($conn, $sql_categoria);

    if (!$result_categoria) {
        die("Error al obtener el id de la categoría: " . pg_last_error($conn));
    }

    // Obtener el id de la categoría
    $row_categoria = pg_fetch_assoc($result_categoria);
    $categoria_id = $row_categoria['id'];

    // Consulta SQL para insertar el plato
    $sql_insert_plato = "INSERT INTO platos (id_categoria, nombre, precio, ruta) 
                        VALUES ('$categoria_id', '$nombre', '$precio', '$rutaImagen')";

        if (pg_query($conn, $sql_insert_plato)) {

            $sql_last_id = "select id from platos order by id desc limit 1";
            $res = pg_query($conn, $sql_last_id);

            while($row = pg_fetch_assoc($res)){
                $lastId = $row['id'];
            }

            $nuevaRuta = $rutaCarpeta . $lastId. "." .$extension;
            $sql_update_foto_name = "update platos set ruta = '$nuevaRuta' where id = $lastId";
            $res = pg_query($conn, $sql_update_foto_name);

            $rutaImagen = $rutaCarpeta . $lastId. "." .$extension;

            if (move_uploaded_file($_FILES["fil_foto"]["tmp_name"], $rutaImagen)) {
                echo "<script>alert('Registro exitoso');</script>";    
                header("Refresh:0;url=http://localhost/AmorMX_final/pages/Administrador.php");
            } else {
                echo "<script>alert('No ha seleccionado una imagen.');</script>";
                header("Refresh:0;url=http://localhost/AmorMX_final/pages/RePlato.php");
            }
        } else {
            echo "Error al insertar el plato: " . pg_last_error($conn);
        }
?>
