<?php
    require('../conexion.php');

    session_start();

    if(!isset($_SESSION["id_usuario"])) {
		header("Location: Acceso.php");
	}else{
        $id_usuario = $_SESSION["id_usuario"];
    }

                        $sql = "select
                                    pe.id
                                from 
                                    pedidos pe";

                        $result = pg_query($conn, $sql);

                        $id_pedido = $_GET['id']
                            $idPedido intval ($id_pedido);
                        
                        $sql_confirmarPedido = "update pedidos set confirmacion_chef = True where id = $idPedido";
                        $result_confirmacionPedido = pg_query($conn, $sql_confirmarPedido);

?>