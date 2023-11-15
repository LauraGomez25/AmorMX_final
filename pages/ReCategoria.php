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
    <title>Registrar Menu</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='../css/main_header.css'>
    <link rel='stylesheet' href='../css/main_cuerpo.css'>
    <script src='../main.js'></script>
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
                Administrador
            </a></li>


        <li class="right"><a href="../pages/Administrador.php" class="icon-link">
                <i class="fa-solid fa-right-to-bracket"></i>
                Salir</a></li>
    </ul><br>


    <div class="main-content">
        <section class="main-section">

            <form action="../Backend/GuardarMenu.php" method="post" enctype="multipart/form-data">

                <h2>Registrar Menu</h2>
                <hr><br>

                <div class="field">
                    <label for="name">Categoria:</label>
                    <input type="text" name="categoria" id="name" required>
                </div><br>

                <div class="field">
                    <label for="fil_foto">Imagen:</label>
                    <input type="file" name="fil_foto" id="fil_foto" onchange="mostrarVistaPrevia()">
                </div>
                <div class="vista-previa">
                    <img id="vista_previa" src="#" alt="Vista Previa de la Imagen"
                        style="max-width: 300px; max-height: 300px;">
                </div>




                <div class="boton">
                    <button type="submit">Registrar menu</button>
                </div>

            </form>
        </section>

        <section class="main-section">
            <h2>Visualizacion</h2>
            <hr><br>

            <table >
                <tr>
                    <th>Categoria</th>
                    <th>Imagen</th>
                    <th>..</th>
                </tr>
                <?php
                $sql = "select 
                                            *
                                    from 
                                            categorias";

                $result = pg_query($conn, $sql);

                while ($row = pg_fetch_assoc($result)) {
                    echo "<tr>
                                            <td>" . $row['nombre_categoria'] . "</td>
                                            <td><img src = " . $row['ruta'] . " width='50'></td>
                                            <td><a href='../Modificaciones/EditarCategoria.php?idCat=" . $row['id'] . "'><img src = '../icons/editar.png' width='20'></a></td>
                                    </tr>";
                }

                ?>
            </table>
        </section>
    </div>
    </div>


</body>

</html>