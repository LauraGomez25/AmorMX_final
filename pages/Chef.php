<?php
require('../conexion.php');

session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: Acceso.php");
}else {
    $id_usuario = $_SESSION["id_usuario"];
    $nom_usuario = $_SESSION['nombres'];
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Chef</title>
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
                    Chef
                </a></li>


            <li class="right">
                <a href="cerrar_sesion.php" class="icon-link">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Cerrar Sesion</a>
            </li>
        </ul>
    </nav>
    <br>




    <div id="services" class="main-content">

            <section class="main-section">

            <div class="tables">
                <h2>Pedidos</h2>
                <hr>
            </div>
            <br>

                <table>
                    <tr>
                        <th>Id Pedido</th>
                        <th>Num Mesa</th>
                        <th>Detalles</th>
                        <th>Estado</th>

                    </tr>

                    <?php
                    $sql = "select
                                    pe.id, pe.id_mesa
                                from 
                                    pedidos pe
                                where 
                                    confirmacion_chef = true";

                    $result = pg_query($conn, $sql);

                    while ($row = pg_fetch_assoc($result)) {
                        echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['id_mesa'] . "</td>
                            <td style='text-align: center;'><a href='../Modificaciones/VerPedido.php?idPedido=" . $row['id'] . "&idMesa=" . $row['id_mesa'] . "' style='display: flex; justify-content: center; align-items: center; height: 100%;'><img src='../icons/lupa.png' width='20'></a></td>
                <td style='text-align: center;'><a href='../Modificaciones/VerPedido.php?idPedido=" . $row['id'] . "&idMesa=" . $row['id_mesa'] . "' style='display: flex; justify-content: center; align-items: center; height: 100%;'><img src='../icons/boton.png' width='20'></a></td>

                            </tr>";
                    }

                    ?>
                </table>
            </section>
        </div>
    </div>


</body>

</html>