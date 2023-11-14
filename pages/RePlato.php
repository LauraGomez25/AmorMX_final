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
    <title>Registro Plato</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/main2.css'>
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

            <form action="../Backend/GuardarPlato.php" method="POST" enctype="multipart/form-data">



                    <h2>Registro Plato</h2>
                    <hr><br>


                    <div class="field">
                        <label for="name">Nombre:</label>
                        <input type="text" name="nombre" id="name" required>
                    </div><br>

                    <div class="field">
                        <label for="id">Precio:</label>
                        <input type="number" name="precio" id="id" required>
                    </div><br>

                    <div class="field">
                        <label for="Tipo">Categoria:</label>
                        <select type="select" name="categoria" id="Tipo" required>
                            <option value="">Seleccione</option>

                            <?php
                            require('../conexion.php');

                            // Prepare query
                            $sql = "select * from categorias";
                            // Execute sql
                            $result = pg_query($conn, $sql);

                            if (!$result) {
                                die("Error al ejecutar la consulta.");
                            }

                            //$rows = $result->num_rows;
                            $rows = pg_num_rows($result);
                            if ($rows > 0) {
                                while ($row = pg_fetch_assoc($result)) {
                                    echo '<option value="' . $row["nombre_categoria"] . '">' . $row["nombre_categoria"] . '</option>';
                                }
                            }
                            ?>

                        </select>
                    </div>

                    <div class="field">
                        <label for="Tipo">Imagen:</label>
                        <input type="file" name="fil_foto" id="fil_foto" onchange="mostrarVistaPrevia()">
                    </div>
                    <div class="vista-previa">
                        <img id="vista_previa" src="#" alt="Vista Previa de la Imagen"
                            style="max-width: 300px; max-height: 300px;">
                    </div>

                    <div class="boton">
                        <button type="submit">Registrar Plato</button>
                    </div>


                </form>
            </section>

            <section class="main-section">
                <h2>Visualizacion</h2>
                    <hr><br>

                    <table border="1" align="center">
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Categoria</th>
                            <th>Ruta</th>
                            <th>..</th>
                        </tr>
                        <?php

                            $sql = "select 
                                            p.id, p.nombre, p.precio, p.ruta,
                                            tc.nombre_categoria
                                    from 
                                            platos p inner join
                                                categorias tc
                                            on tc.id = p.id_categoria";

                            $result = pg_query($conn, $sql);

                            while($row = pg_fetch_assoc($result)){
                                echo "<tr>
                                            <td>".$row['nombre']."</td>
                                            <td>".$row['precio']."</td>
                                            <td>".$row['nombre_categoria']."</td>
                                            <td><img src = ".$row['ruta']." width='50'></td>
                                            <td><a href='../Modificaciones/EditarPlatos.php?idPlato=".$row['id']."'><img src = '../icons/editar.png' width='20'></a></td>
                                      </tr>";
                            }

                        ?>
                    </table>
            </section>
        </div>
    </div>


</body>

</html>