<?php
    require('../conexion.php');

    session_start();

    if(!isset($_SESSION["id_usuario"])) {
		  header("Location: Acceso.php");
	}


       $id_plato_pedido = $_GET['idPlato'];
       $id_mesa = $_GET['idMesa'];

      
       $sql_cantidad = "SELECT COUNT(*) as cantidad_platos
                        FROM pedidos_mesa as pm
                        INNER JOIN pedidos as p ON p.id = pm.id_pedido
                        WHERE p.id = (select id_pedido from pedidos_mesa where id = $id_plato_pedido)";

       $result_cantidad = pg_query($conn, $sql_cantidad);

       while ($row = pg_fetch_assoc($result_cantidad)) {
        $cantidad_platos = $row['cantidad_platos'];
      }

       
       $sql_pedido = "select id_pedido from pedidos_mesa where id = $id_plato_pedido";
       $result_pedido = pg_query($conn, $sql_pedido);

       while ($row = pg_fetch_assoc($result_pedido)) {
            $id_pedido = $row['id_pedido'];
       }

       if($cantidad_platos <= 1){
           
         $sql_eliminarPlato_pedido = "delete from pedidos_mesa where id = $id_plato_pedido";
         pg_query($conn, $sql_eliminarPlato_pedido);

         $sql_eliminar_pedido = "delete from pedidos where id = $id_pedido";
         pg_query($conn, $sql_eliminar_pedido);

         header("Refresh:0;url=http://localhost/AmorMX_final/pages/Mesero.php");

       } else{
             $sql_eliminarPlato_pedido = "delete from pedidos_mesa where id = $id_plato_pedido";
             pg_query($conn, $sql_eliminarPlato_pedido);

             header("Refresh:0;url=http://localhost/AmorMX_final/pages/PedirPlatoM.php?idMesa=".$id_mesa."");
       }


?> 