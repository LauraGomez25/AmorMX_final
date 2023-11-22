<?php
    require('../conexion.php');

    session_start();

    if(!isset($_SESSION["id_usuario"])) {
		header("Location: Acceso.php");
	}else{
        $id_usuario = $_SESSION["id_usuario"];
    }

    $id_mesa = $_GET['idMesa'];

    $sql_verificarPedido = "SELECT m.id, COALESCE(COUNT(p.id), 0) AS pedido_count
                            FROM mesas m
                            LEFT JOIN pedidos p ON m.id = p.id_mesa AND p.estado_pedido = true AND p.id_usuario = $id_usuario
                            WHERE m.id = $id_mesa
                            GROUP BY m.id;";
    $result_verificarPedido = pg_query($conn, $sql_verificarPedido);

    while ($row_verificarPedido = pg_fetch_assoc($result_verificarPedido)) {
        $pedido_count = $row_verificarPedido['pedido_count'];
    }

    if($pedido_count > 0){
        $sql = "select
                    pe.id
                from 
                    pedidos pe
                where 
                    id_usuario = $id_usuario and 
                    estado_pedido = true and
                    id_mesa = $id_mesa";

        $result = pg_query($conn, $sql);

        while ($row = pg_fetch_assoc($result)) {
            $id_pedido = $row['id'];
        }
        
        $sql_confirmarPedido = "update pedidos set confirmacion_chef = true where id = $id_pedido";
        $result_confirmacionPedido = pg_query($conn, $sql_confirmarPedido);

        echo "<script>alert('Pedido exitoso');</script>";    
        header("Refresh:0;url=http://localhost/AmorMX_final/pages/PedirPlatoM.php?idMesa=".$id_mesa."");

    }else{        
        echo "<script>alert('No hay platos registrados');</script>";    
        header("Refresh:0;url=http://localhost/AmorMX_final/pages/PedirPlatoM.php?idMesa=".$id_mesa."");
    }   
?>