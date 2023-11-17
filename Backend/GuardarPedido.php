<?php
    require('../conexion.php');

    session_start();

    if(!isset($_SESSION["id_usuario"])) {
		header("Location: Acceso.php");
	}else{
        $id_usuario = $_SESSION["id_usuario"];
    }

    // Conexion a la base de datos
    require('../conexion.php');

    $id_mesa = $_POST['id_mesa'];
    $platoId = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $categoriaId = $_POST['categoria']; 
    $comentarios = $_POST['comentario'];

    //verificar si la mesa esta activa o no
    $sql_verificacion="select * from pedidos where id_mesa = $id_mesa and id_usuario = $id_usuario and estado_pedido = true ";
    $result_verificacion = pg_query($conn, $sql_verificacion);

    if (pg_num_rows($result_verificacion) < 1){
        $sql_pedido = "INSERT INTO pedidos (id_mesa, id_usuario, estado_pedido) 
                        VALUES ('$id_mesa', '$id_usuario', true)";
        pg_query($conn, $sql_pedido);

        //obtener el id del pedido ingresado
        $sql_lastId="select id from pedidos where id_mesa = $id_mesa and id_usuario = $id_usuario and estado_pedido = true ";
        $result_lastId = pg_query($conn, $sql_lastId);

        while ($row = pg_fetch_assoc($result_lastId)) {
        $lastId = $row['id'];
        }

        //registrar primer producato del pedido activo
        $sql_insert_plato = "INSERT INTO pedidos_mesa (id_pedido, id_categoria, id_plato, cantidad, comentarios) 
                            VALUES ('$lastId','$categoriaId', '$platoId', $cantidad, '$comentarios')";
        pg_query($conn, $sql_insert_plato);

        header("Refresh:0;url=http://localhost/AmorMX_final/pages/PedirPlatoM.php?idMesa=".$id_mesa."");
    }else{
        //obtener el id del pedido ingresado
        $sql_lastId="select id from pedidos where id_mesa = $id_mesa and id_usuario = $id_usuario and estado_pedido = true ";
        $result_lastId = pg_query($conn, $sql_lastId);

        while ($row = pg_fetch_assoc($result_lastId)) {
            $lastId = $row['id'];
        }

        //registrar los sig platos
        $sql_insert_plato = "INSERT INTO pedidos_mesa (id_pedido, id_categoria, id_plato, cantidad, comentarios) 
                            VALUES ('$lastId','$categoriaId', '$platoId', $cantidad, '$comentarios')";
        pg_query($conn, $sql_insert_plato);

        header("Refresh:0;url=http://localhost/AmorMX_final/pages/PedirPlatoM.php?idMesa=".$id_mesa."");
    }
?>
