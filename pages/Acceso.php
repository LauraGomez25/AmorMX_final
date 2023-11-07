<?php
    require('../conexion.php');

    session_start();

    if(isset($_SESSION["id_usuario"])) {
		header("Location: Administrador.php");
	}

    if(!empty($_POST)){
        $ced = $_POST['dni'];
        $pass = $_POST['pass'];

        // Prepare query
        $sql = "select * from Usuarios where cedula = '$ced' and contrasena = '$pass'";
        // Execute sql
        $result = pg_query($conn, $sql);

        if (!$result) {
            die("Error al ejecutar la consulta.");
        }

        //$rows = $result->num_rows;
        $rows = pg_num_rows($result);
        if($rows > 0) {
            while ($row = pg_fetch_assoc($result)) {
                // $row contiene los datos de cada fila
                $_SESSION['id_usuario'] = $row['id'];
                $_SESSION['nombres'] = $row['nombre_completo'];
                $_SESSION['cedula'] = $row['cedula'];

                $tipoUsuario = $row['id_tipo_usuario'];
            }

            switch ($tipoUsuario) {
                case 1:
                    header("Location: Administrador.php");   
                    break;
                case 2:
                    header("Location: Mesero.php");   
                    break;
                case 3:
                    header("Location: Chef.php");   
                    break;
                case 4:
                    header("Location: Cajero.php");   
                    break;
            }

            
        } else {
            echo "<script>alert('Datos incorrectos');</script>";
            header("Refresh:0;url=http://localhost/AmorMX/pages/Acceso.php");
        }
        
        // Cierra la conexión
        pg_close($conn);
    }

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Acceso</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/main2.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src='main.js'></script>
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
        <li class="left">
            <a href="../Index.html" class="icon-link">
                <i class="fas fa-home"></i>
                Home
            </a></li>


    </ul>


    <div id="home1" class="main-container">
        <img src="../images/logo pdf blanco-05.png" alt="Imagen 1" class="logo2">
        <div class="container">
            <section class="main-section">

                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">

                 <h2>Acceso</h2>
                 <hr><br>

                    <div class="field">
                        <label for="id">Identificacion:</label>
                        <input type="number" name="dni" id="id" required>
                    </div><br>

     
                    <div class="field">
                        <label for="pass">Contraseña:</label>
                        <div class="password-container">
                          <i id="toggle-password" class="fa-solid fa-eye-slash"
                           style="color: #8c8388; position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                          <input type="password" name="pass" id="pass" required>
                        </div>
                      </div>
                      <script src="../main.js"></script>

                    <div class="boton">
                        <button type="submit">Acceder</button>
                    </div>

  
                

                </form>

            </section>
        </div>

</body>
</html>