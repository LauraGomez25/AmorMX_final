<?php
    require('../conexion.php');

    session_start();

    if(!isset($_SESSION["id_usuario"])) {
		header("Location: Acceso.php");
	}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Administrador</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/main2.css'>
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



    <ul class="menu">
        <li class="left"><a href="" class="icon-link">
                <i class="fas fa-home"></i>
                Administrador
            </a></li>


            <li class="right">
            <a href="cerrar_sesion.php" class="icon-link">
                <i class="fa-solid fa-right-to-bracket" ></i>
                Log out</a></li>
    </ul>







    <div class="main-content">
        <section class="main-section">
            <h2>Registros</h2>
            <hr>
            <ul class="services-list">
                <li class="service">
                    <a href="../pages/ReEmpleados.php">
                        <div class="service-content">
                            <p>Registrar Empleado</p>
                        </div>
                    </a>
                </li>
                <li class="service">
                    <a href="../pages/ReMenu.php">
                        <div class="service-content">
                            <p>Registrar Menu</p>
                        </div>
                    </a>
                </li>
                <li class="service">
                    <a href="../pages/ReMesas.php">
                        <div class="service-content">
                            <p>Registrar Mesas</p>
                        </div>
                    </a>
                </li>
                <li class="service">
                    <a href="../pages/RePlato.php">
                        <div class="service-content">
                            <p>Registrar Plato</p>
                        </div>
                    </a>
                </li>
            </ul>
        </section>
        <section class="main-section">
            <h2>Otras Opciones Administrativas</h2>
            <hr>
            <ul class="services-list">
                <li class="service">
                    <a href="Mesero.php">
                        <div class="service-content">
                            <p>Mesero</p>
                        </div>
                    </a>
                </li>
                <li class="service">
                    <a href="Chef.php">
                        <div class="service-content">
                            <p>Chef</p>
                        </div>
                    </a>
                </li>
                <li class="service">
                    <a href="Cajero.php">
                        <div class="service-content">
                            <p>Cajero</p>
                        </div>
                    </a>
                </li>
            </ul>
        </section>
    </div>



</body>

</html>