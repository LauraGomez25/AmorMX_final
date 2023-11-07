<?php
// Conexion a la base de datos
require('../conexion.php');


$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$categoria_nombre = $_POST['categoria']; 
// Procesar la imagen
$rutaCarpeta = "../fotos/";
$nombreImagen = $_FILES["fil_foto"]["name"];
$rutaImagen = $rutaCarpeta . $nombreImagen;

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




// if (isset($_FILES["fil_foto"]) && $_FILES["fil_foto"]["error"] == UPLOAD_ERR_OK) {
//     // Procesar la imagen
//     // Resto del código para procesar la imagen
// } else {
//     echo "Error al subir la imagen.";
// }




// Ejecutar la consulta de inserción
if (pg_query($conn, $sql_insert_plato)) {
    if (move_uploaded_file($_FILES["fil_foto"]["tmp_name"], $rutaImagen)) {
        echo "<script>alert('Registro exitoso');</script>";
        header("Refresh:0;url=http://localhost/AmorMX/pages/Administrador.php");
    } else {
        echo "Error al subir la imagen.";
    }
} else {
    echo "Error al insertar el plato: " . pg_last_error($conn);
}

?>
