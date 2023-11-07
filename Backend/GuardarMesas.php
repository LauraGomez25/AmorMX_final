<?php

//conexion base de datos
require('../conexion.php');

//recuperar la informacion del formulario html ReEmpleados
$nombre = $_POST['nombre_tipo'];

if($nombre=='Mesa'){

$sql1 = "select * from mesas where nombre_tipo='Mesa'";
}
else{
    $sql1 = "select * from mesas where nombre_tipo='Karaoke'";
}

$result = pg_query($conn, $sql1);

//$rows = $result->num_rows;
$rows = pg_num_rows($result);

$rows = $rows + 1;
//preparar sql
$sql = "insert into 
                mesas (nombre_tipo,numero_mesa) 
            values('$nombre', '$rows')";

// Execute sql
$result = pg_query($conn, $sql);




if (!$result) {
    die("Error al ejecutar la consulta.");
} else {
    echo "<script>alert('Registro exitoso');</script>";
    header("Refresh:0;url=http://localhost/AmorMX/pages/Administrador.php");
}

?>