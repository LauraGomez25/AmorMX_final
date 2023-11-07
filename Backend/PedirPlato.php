<?php
// Conexion a la base de datos
require('../conexion.php');


$nombre_plato = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$categoria_nombre = $_POST['categoria']; 



// Consulta SQL para obtener el nombre de la categoría
$sql_categoria = "SELECT id FROM categorias WHERE nombre_categoria = '$categoria_nombre'";

// Ejecutar la consulta
$result_categoria = pg_query($conn, $sql_categoria);


// Consulta SQL para obtener el nombre de la plato
$sql_platos = "SELECT id FROM platos WHERE nombre = '$nombre_plato'";

// Ejecutar la consulta
$result_platos = pg_query($conn, $sql_platos);




if (!$result_categoria) {
    die("Error al obtener el id de la categoría: " . pg_last_error($conn));
}
if (!$result_platos) {
    die("Error al obtener el id de la platos: " . pg_last_error($conn));
}

// Obtener el id de la categoría
$row_categoria = pg_fetch_assoc($result_categoria);
$categoria_id = $row_categoria['id'];

// Obtener el id de la categoría
$row_platos = pg_fetch_assoc($result_platos);
$platos_id = $row_platos['id'];


// Consulta SQL para insertar el plato
$sql_insert_plato = "INSERT INTO pedidos_mesa (id_categoria, id_plato, cantidad) 
                     VALUES ('$categoria_id', '$platos_id', $cantidad)";





 // Execute sql
 $result = pg_query($conn, $sql_insert_plato);

 if (!$result) {
    die("Error al ejecutar la consulta.");
}else{
    echo "<script>alert('Registro exitoso');</script>";
    header("Refresh:0;url=http://localhost/AmorMX/pages/Administrador.php");
}

?>
