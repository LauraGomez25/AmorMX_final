<?php
    require('../conexion.php');

    session_start();

    if(!isset($_SESSION["id_usuario"])) {
		header("Location: Acceso.php");
	}else{
        $id_usuario = $_SESSION["id_usuario"];
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Factura</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='../css/main_header.css'>
    <link rel='stylesheet' href='../css/main_cuerpo.css'>
    <script src='main.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<style>
    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('../images/FondoMex.png');
        background-size: 100% 78%;
        background-repeat: no-repeat;
        background-position: center 127px;
        opacity: 0.5;
        z-index: -1;
    }

    body {
        margin: 0;
        padding: 0;
        background-color: rgb(252, 247, 230);
        font-family: "Garamond", serif;
        overflow-x: hidden;
    }
</style>


<body>
    <header>
        <div class="image-container">
            <img src="../images/logo pdf blanco-05.png" alt="Imagen 1" class="logo">
            <img src="../images/VD-removebg-preview.png" alt="Imagen 4" class="effect-4">
            <img src="../images/VD-removebg-preview.png" alt="Imagen 5" class="effect-5">
            <img src="../images/VD-removebg-preview.png" alt="Imagen 6" class="effect-6">
            <img src="../images/VD-removebg-preview.png" alt="Imagen 7" class="ca">

            <img src="../images/Calavera1.png" alt="Imagen 8" class="effect-8">
            <img src="../images/Calavera2.png" alt="Imagen 9" class="effect-9">
            <img src="../images/calabera-removebg-preview.png" alt="Imagen 10" class="effect-10">
            <img src="../images/calabera-removebg-preview.png" alt="Imagen 11" class="effect-11">

            <img src="../images/flor.png" alt="Imagen 12" class="effect-12">
            <img src="../images/flor.png" alt="Imagen 13" class="effect-13">
            <img src="../images/flor.png" alt="Imagen 14" class="effect-14">
            <img src="../images/flor.png" alt="Imagen 15" class="effect-15">
            <img src="../images/flor.png" alt="Imagen 16" class="effect-16">
            <img src="../images/flor.png" alt="Imagen 17" class="effect-17">
        </div>
    </header>



    <ul class="menu">
        <li class="left"><a href=""class="icon-link">
                <i class="fas fa-home" ></i>
                Factura
            </a></li>


            <li class="right">
            <a href="../pages/Chef.php" class="icon-link">
                <i class="fa-solid fa-right-to-bracket" ></i>
                Salir</a></li>
    </ul><br>

    <div id="services" class="main-container">
        <div class="container">
        
            <section class="main-section">

              

                    <h2>Pedido</h2>
                    <hr><br>

                    <div class="field">

                    <?php
                        $id_pedido = $_GET['idPedido'];
                    ?>
                    <input type="hidden" name="id_mesa" value="<?php  echo $id_mesa ?>" readonly="yes">

                    <table >
                <tr>
                    <th>Tipo Plato</th>
                    <th>Nombre Plato</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>

                <?php
                $sql = "select 
                            pm.id as plato_id,
                            u.cedula, m.numero_mesa,
                            pl.nombre as nombre_plato, pl.precio,
                            pm.comentarios, pm.cantidad,
                            c.nombre_categoria
                        from 
                            pedidos pe inner join
                                pedidos_mesa pm inner join
                                    categorias c
                                on c.id = pm.id_categoria inner join
                                    platos pl 
                                on pl.id = pm.id_plato
                            on pe.id = pm.id_pedido inner join 
                                mesas m 
                            on m.id = pe.id_mesa inner join 
                                usuarios u 
                            on u.id = pe.id_usuario
                        where 
                            pe.estado_pedido = true and 
                            pe.id = $id_pedido";

                $result = pg_query($conn, $sql);

                while ($row = pg_fetch_assoc($result)) {
                    echo "<tr>
                            <td>".$row['nombre_categoria']."</td>
                            <td>".$row['nombre_plato']."</td>
                            <td>".$row['cantidad']."</td>
                            <td>".$row['precio']."</td>
                        </tr>";
                        //<td><a href='../Backend/EliminarPlatoPedido.php'><img src = '../icons/editar.png' width='20'></a></td>

                }

                ?>
            </table>

            <div class="boton">
                <button type="submit">Imprimir</button>
            </div>

            </section>
        </div>
                       
</body>
</html>