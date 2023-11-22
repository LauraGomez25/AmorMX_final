<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $correo_usuario = isset($_POST['correo']) ? $_POST['correo'] : '';

        if (empty($correo_usuario) || !filter_var($correo_usuario, FILTER_VALIDATE_EMAIL)) {
            die("Error: El correo electrónico no es válido.");
        }

        $id_pedido = isset($_POST['idPedido']) ? $_POST['idPedido'] : null;
        if ($id_pedido === null) {
            die("Error: 'idPedido' no está definido.");
        }

        $archivo_pdf = __DIR__ . '/../library/pdf_destino/pedido' . $id_pedido . '.pdf';

        if (!file_exists($archivo_pdf)) {
            die("Error: El archivo PDF no existe.");
        }

        $pdfContent = file_get_contents($archivo_pdf);

        // Configurar la instancia de PHPMailer
        $mail = new PHPMailer(true);

        $mail->setFrom('karenrodros17@gmail.com');
        $mail->addAddress($correo_usuario);
        $mail->Subject = 'Factura del Pedido';
        $mail->Body = 'Adjunto encontrarás la factura de tu pedido.';
        $mail->addStringAttachment($pdfContent, 'Factura_Pedido_' . $id_pedido . '.pdf', 'base64', 'application/pdf');

        try {
            $mail->send();

            // Redirigir con un parámetro de éxito
            header("Location: exito.php?envio=exito");
            exit();
        } catch (Exception $e) {
            // Redirigir con un parámetro de fallo
            header("Location: exito.php?envio=fallo");
            exit();
        }
    } else {
        header("Location: ../pages/Cajero.php");
        exit();
    }
?>
