<?php
    require('../conexion.php');

    session_start();

    if (!isset($_SESSION["id_usuario"])) {
        header("Location: Acceso.php");
    } else {
        $id_usuario = $_SESSION["id_usuario"];
        $nom_usuario = $_SESSION['nombres'];
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>VerPedido</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='../css/main_header.css'>
    <link rel='stylesheet' href='../css/main_cuerpo.css'>
    <script src='main.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

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

    <nav>
        <ul class="menu">
            <li class="left"><a href="" class="icon-link">
                <i class="fas fa-home"></i>
                Pedido
            </a></li>

            <li class="right">
                <a href="../pages/Chef.php" class="icon-link">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Salir</a>
            </li>
        </ul>
    </nav><br>

    <div id="services" class="main-content">
        <section class="main-section">

            <div class="tables">
                <h2>Pedido</h2>
                <hr>
            </div><br>

            <div class="field">

                <?php
                    $id_pedido = $_GET['idPedido'];
                ?>

                <input type="hidden" name="id_mesa" value="<?php echo $id_mesa ?>" readonly="yes">

                <?php
                    $id_pedido = $_GET['idPedido'];

                        if (isset($id_pedido) && !empty($id_pedido)) {
                            $sql = "SELECT 
                                        pm.id as plato_id,
                                        u.cedula, m.numero_mesa,
                                        pl.nombre as nombre_plato, pl.precio,
                                        pm.comentarios, pm.cantidad,
                                        c.nombre_categoria,
                                        u.nombre_completo
                                    FROM 
                                        pedidos pe INNER JOIN
                                        pedidos_mesa pm INNER JOIN
                                        categorias c ON c.id = pm.id_categoria INNER JOIN
                                        platos pl ON pl.id = pm.id_plato
                                        ON pe.id = pm.id_pedido INNER JOIN 
                                        mesas m ON m.id = pe.id_mesa INNER JOIN 
                                        usuarios u ON u.id = pe.id_usuario 
                                    WHERE 
                                        pe.estado_pedido = true AND 
                                        pe.id = $id_pedido";

                            $result = pg_query($conn, $sql);

                            if ($result) {
                                echo "<div class='main-table'>
                                <table>
                                <tr>
                                    <th>Tipo Plato</th>
                                    <th>Nombre Plato</th>
                                    <th>Comentarios</th>
                                    <th>Cantidad</th>    
                                </tr>";


                                while ($row = pg_fetch_assoc($result)) {
                                    echo "<tr>
                                            <td>" . $row['nombre_categoria'] . "</td>
                                            <td>" . $row['nombre_plato'] . "</td>
                                            <td>" . $row['comentarios'] . "</td>
                                            <td>" . $row['cantidad'] . "</td>
                                        </tr>";
                                }
                                        
                                echo "</table>
                                        </div>";

                                echo "<div style='text-align: center; display: flex; justify-content: space-around;'>
                                            <a href='../Backend/GenerarVoucher.php?idPedido=$id_pedido' target='_blank' title='Descargar e Imprimir Voucher'>
                                                <i class='fa-solid fa-print' style='color: #ac539c; font-size: 29px; margin: 10px'></i> Imprimir Voucher
                                            </a>
                                        </div>";

                            
                        }else{
                            echo "Error en la consulta SQL: " . pg_last_error($conn);
                        }}else {
                            echo "La variable \$id_pedido no está definida o está vacía.";
                        }
                        

                                    
            ?>
        </section>
    </div>
    
</body>
</html>