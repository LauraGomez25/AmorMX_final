<?php
    //conexion base de datos
    require('../conexion.php');

    //recuperar la informacion del formulario html ReEmpleados
    $nombre = $_POST['nombre_tipo'];

    $sql_counter = "select count(id) as total from mesas";
    $res = pg_query($conn, $sql_counter);

    while($row = pg_fetch_assoc($res)){
        $total = $row['total'];
    }

    $rows = $total + 1;
    //preparar sql
    $sql = "insert into mesas (nombre_tipo,numero_mesa) values('$nombre', '$rows')";

    //Execute sql
    $result = pg_query($conn, $sql);

    if (!$result) {
        die("Error al ejecutar la consulta.");
    } else {
        echo "<script>alert('Registro exitoso');</script>";
        header("Refresh:0;url=http://localhost/AmorMX_final/pages/ReMesas.php");
    }
?>