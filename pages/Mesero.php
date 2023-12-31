<?php
    require('../conexion.php');

    session_start();

    if (!isset($_SESSION["id_usuario"])) {
        header("Location: Acceso.php");
    }else{
        $id_usuario = $_SESSION["id_usuario"];
        $nom_usuario = $_SESSION['nombres'];
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Mesero</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='../css/main_header.css'>
    <link rel='stylesheet' href='../css/main_cuerpo.css'>
    <script src='../main.js'></script>
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
                    <i class="fas fa-home"></i>Mesero: <?php echo $nom_usuario; ?></i>                 
            </a></li>

            <li class="right">
                <a href="cerrar_sesion.php" class="icon-link">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Cerrar Sesion</a>
            </li>
        </ul>
    </nav><br>

    <div id="home" class="main-content">       
            <section class="main-section">

                <form action="../PedirPlato.php" method="POST">

                    <h2>Mesas</h2>
                    <hr>
                
                    <div class="main-tables">
                        <table>
                            <?php
                                $sql = "select 
                                                *
                                        from 
                                                mesas";

                                $result = pg_query($conn, $sql);

                                echo "<tr>";
                                $count = 0;

                                while($row = pg_fetch_assoc($result)){
                                    $sql2 = "select m.id, COALESCE(count(p.id_mesa), 0) as mesax from mesas m left join pedidos p on m.id = p.id_mesa and estado_pedido = true where m.id = {$row['id']}  GROUP BY m.id";
                                    $result2 = pg_query($conn, $sql2) ?? 0;
                                                                    
                                    while($row_mesax = pg_fetch_assoc($result2)){
                                        $mesax = $row_mesax['mesax']; 
                                    }

                                    $sql_mesaUsuario = "select COALESCE(count(p.id_mesa), 0) as mesau from pedidos p where estado_pedido = true and id_mesa = {$row['id']} and id_usuario = $id_usuario";
                                    $result_mesaUsuario = pg_query($conn, $sql_mesaUsuario);

                                    while($row_mesaUsuario = pg_fetch_assoc($result_mesaUsuario)){
                                        $mesaUsuario = $row_mesaUsuario['mesau']; 
                                    }

                                    if($mesax == 0){
                                        echo "<td class='numero-mesa'>
                                                <a href='PedirPlatoM.php?idMesa=" . $row['id'] . "'>
                                                    <img src='../icons/mNegra.png' width='30'> 
                                                    <span class='numero'>" . $row['numero_mesa'] . "</span>
                                                </a>
                                            </td>";
                                    }elseif($mesaUsuario > 0){
                                        echo "<td class='numero-mesa'>
                                                <a href='PedirPlatoM.php?idMesa=" . $row['id'] . "'>
                                                    <img src='../icons/mVerde.png' width='30'>
                                                    <span class='numero'>" . $row['numero_mesa'] . "</span>
                                                </a>
                                            </td>";
                                    }else{
                                        echo "<td class='numero-mesa'>
                                                <a href='#'>
                                                    <img src='../icons/mRoja.png' width='30'>
                                                    <span class='numero'>" . $row['numero_mesa'] . "</span>
                                                </a>
                                            </td>";
                                    }
            
                                    $count += 1;
                                    if ($count % 5 == 0) {
                                        echo "</tr><tr>";
                                    }
                                }
                                echo "</tr>";
                            ?>
                        </table>
                    </div>
                </form>
            </section>
    </div>

</body>
</html>