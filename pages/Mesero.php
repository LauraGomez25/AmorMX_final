<?php
require('../conexion.php');

session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: Acceso.php");
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
        <li class="left"><a href="" class="icon-link">
                <i class="fas fa-home"></i>
                Mesero
            </a></li>


        <li class="right">
            <a href="cerrar_sesion.php" class="icon-link">
                <i class="fa-solid fa-right-to-bracket"></i>
                Log out</a>
        </li>
    </ul><br>

    <div id="home" class="main-container">
        <div class="container">
            <section class="main-section">

                <form action="../PedirPlato.php" method="POST">

                    <h2>Mesas</h2>
                    <hr><br>
                   

                    <table border="1" align="center">
                     
                        <?php
                            $sql = "select 
                                            *
                                    from 
                                            mesas";

                            $result = pg_query($conn, $sql);

                            echo "<tr>";
                            $count = 0;
                            while($row = pg_fetch_assoc($result)){
                                echo "<td><br>&nbsp;&nbsp;
                                        <a href=#?idUser=".$row['id']."'><img src = '../icons/mesa-redonda.png' width='30' ></a>&nbsp;&nbsp;<br>".$row['numero_mesa']."
                                        
                                        </td>";
                                $count+=1;
                                if($count % 5 == 0){
                                    echo "</tr><tr>";
                                }        
                            }
                            echo "</tr>";
                        ?>
                    </table>

                </form>

            </section>
        </div>

</body>

</html>