<?php
    require('../conexion.php');

    session_start();

    if(!isset($_SESSION["id_usuario"])) {
		header("Location: Acceso.php");
	}else{
        $id_usuario = $_SESSION["id_usuario"];
    }
?>

<?php

    $sql_confirmarPedido = "update pedidos set confirmacion_chef = 'True'";
    $result_confirmacionPedido = pg_query($conn, $sql_confirmarPedido);

    

?>