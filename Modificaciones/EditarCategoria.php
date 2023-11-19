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

<?php
$idCategoria = $_GET['idCat'];

$sql = "select 
                     *                     
             from 
                     categorias
             where
                    id = $idCategoria";

$result = pg_query($conn, $sql);

while ($row = pg_fetch_assoc($result)) {
    $idC = $row['id'];
    $imagen = $row['ruta'];
    $nombreCat = $row['nombre_categoria'];

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



    <nav>
        <ul class="menu">
            <li class="left"><a href="" class="icon-link">
                    <i class="fas fa-home"></i>Administrador: <?php echo $nom_usuario; ?></i>
                    
                </a></li>


            <li class="right">
                <a href="../pages/ReCategoria.php" class="icon-link">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Salir</a>
            </li>
        </ul>
    </nav>
    <br>


    <div class="main-content">
        <section class="main-section">

            <form action="../Backend/ActualizarCat.php" method="post" enctype="multipart/form-data">

                <h2>Actualizar Categoria</h2>
                <hr><br>

                <input type="hidden" name="idC" id="idC" value="<?php echo $idC; ?>" required>

                <div class="field">
                    <label for="name">Categoria:</label>
                    <input type="text" name="categoria" id="name" value="<?php echo $nombreCat; ?>" required>
                </div><br>

                <div class="field">
                    <label for="fil_foto">Imagen:</label>
                    <div class="file-input-container" style="position: relative; overflow: hidden;">
                        <input type="file" name="fil_foto" id="fil_foto" accept="image/*"
                            onchange="mostrarVistaPrevia()">
                    </div>
                </div>
                <div id="contenedor_imagen" style="max-width: 30%; max-height: 30%; overflow: hidden;">
                    <img id="vista_previa" src="#" alt="Vista Previa de la Imagen"
                        style="max-width: 100%; height: auto; display: none; cursor: pointer;"
                        onclick="abrirImagenEnVentana()">
                </div>
                <span id="mensaje_contenedor" class="mensaje"
                    style="max-width: 100%; position: absolute; top: 0; left: 0; display: none;"></span>




                <div class="boton">
                    <button type="submit">Actualizar Categoria</button>
                </div>

            </form>
        </section>

    </div>


</body>

</html>