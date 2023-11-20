<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../library/tcpdf.php');


$id_pedido = isset($_GET['idPedido']) ? $_GET['idPedido'] : null;


if ($id_pedido === null) {
    die("Error: 'idPedido' no está definido.");
}


$pdf = new TCPDF();


$pdf->AddPage();


$host = "localhost";
$port = "5432";
$dbname = "AmorMX";
$user = "postgres";
$password = "postgres";


$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");


if (!$conn) {
    die("Error de conexión: " . pg_last_error());
}


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
    $nombre_producto = $row['nombre_plato'];
    $precio_unitario = $row['precio'];
    $cantidad = $row['cantidad'];
    $precio_total = $precio_unitario * $cantidad;
    $totalFactura += $precio_total;

    $nombreM = $row['nombre_completo'];

    
    $contenido .= "<p><strong>Nombre del Mesero:</strong> $nombreM</p>";
    $contenido .= "<p><strong>Nombre del Plato:</strong> $nombre_producto</p>";
    $contenido .= "<p><strong>Cantidad:</strong> $cantidad</p>";
    $contenido .= "<p><strong>Precio Unitario:</strong> $precio_unitario</p>";
    $contenido .= "<p><strong>Precio Platos:</strong> $precio_total</p>";
    $contenido .= "<hr>"; 
}


$pdf->writeHTML($contenido, true, false, true, false, '');


pg_close($conn);


$directorio_destino = __DIR__ . '/AmorMX_final/library/pdf_destino';


$archivo_pdf = $directorio_destino . "/pedido" . $id_pedido . ".pdf";


if (!is_dir($directorio_destino)) {
    mkdir($directorio_destino, 0777, true);
}


if (file_exists($archivo_pdf)) {
   die("<script>alert('La factura ya se genero');</script>");
   header("Refresh:0;url=http://localhost/AmorMX_final/pages/Cajero.php");
}   



$pdf->Output($archivo_pdf, 'F');


if (!file_exists($archivo_pdf)) {
    die("Error: No se pudo guardar el archivo PDF.");
}


header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . basename($archivo_pdf) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');

readfile($archivo_pdf);
?>
