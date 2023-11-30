<?php
    require('../conexion.php');

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include('../library/tcpdf.php');

    $id_pedido = isset($_GET['idPedido']) ? $_GET['idPedido'] : null;

    if ($id_pedido === null) {
        die("Error: 'idPedido' no está definido.");
    }

    $pdf = new TCPDF();
    $pdf->AddPage();

    $sql = "SELECT 
                pm.id as plato_id,
                u.cedula, m.numero_mesa,
                pl.nombre as nombre_plato, pl.precio,
                pm.comentarios, pm.cantidad,
                c.nombre_categoria, u.nombre_completo
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

    if (!$result) {
        die("Error en la consulta del pedido: " . pg_last_error($conn));
    }

    $totalFactura = 0;

    $contenido = "<h2>Detalles del Pedido</h2>";

    while ($row = pg_fetch_assoc($result)) {
        $categoria = $row['nombre_categoria'];
        $comentarios = $row['comentarios'];
        $nombre_producto = $row['nombre_plato'];
        $cantidad = $row['cantidad'];

        $contenido .= "<p><strong>Categoria:</strong> $categoria</p>";
        $contenido .= "<p><strong>Nombre del Plato:</strong> $nombre_producto</p>";
        $contenido .= "<p><strong>Cantidad:</strong> $cantidad</p>";
        $contenido .= "<p><strong>Comentarios:</strong> $comentarios</p>";
        $contenido .= "<hr>"; 
    }

    $pdf->writeHTML($contenido, true, false, true, false, '');

    pg_close($conn);

    $directorio_destino = __DIR__ . '/../library/voucher';
    $archivo_pdf = $directorio_destino . "/pedido" . $id_pedido . ".pdf";

    if (!is_dir($directorio_destino)) {
        mkdir($directorio_destino, 0777, true);
    }

    $pdf->Output($archivo_pdf, 'F');

    if (!file_exists($archivo_pdf)) {
        die("Error: No se pudo guardar el archivo PDF.");
    }

    // Siempre permite la visualización del PDF después de mostrar el mensaje de alerta
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . basename($archivo_pdf) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    readfile($archivo_pdf);
?>