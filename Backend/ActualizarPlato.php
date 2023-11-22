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
    $extension = pathinfo($_FILES["fil_foto"]["name"], PATHINFO_EXTENSION);
    $rutaImagen = $rutaCarpeta . $idP. "." .$extension;

    $sql = "update platos set 
                nombre = '$nombre',
                precio = '$precio',
                id_categoria = '$tipo',
                ruta = '$rutaImagen'
            where
                id = $idP ";

    // Ejecutar la consulta de actualizacion
    if (pg_query($conn, $sql)) {
        if (move_uploaded_file($_FILES["fil_foto"]["tmp_name"], $rutaImagen)) {
            echo "<script>alert('Actualizacion exitosa');</script>";    
            header("Refresh:0;url=http://localhost/AmorMX_final/pages/RePlato.php");
        } else {
            echo "<script>alert('No ha seleccionado una imagen.');</script>";
            header("Refresh:0;url=http://localhost/AmorMX_final/pages/RePlato.php");
        }
    } else {
        echo "Error al insertar el plato: " . pg_last_error($conn);
    } 

    // Cerrar la conexión a la base de datos si es necesario
    pg_close($conn);
?>