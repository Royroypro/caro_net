<?php

include_once '../app/config.php';
$codigo_recibo = $_GET['codigo_recibo'] ?? '';


if (empty($codigo_recibo)) {
    die('No se ha proporcionado el código de recibo');
}

$stmt = $pdo->prepare("SELECT r.id_recibo, r.numero_recibo, r.Tipo_documento, r.dni_ruc, r.id_cliente, r.id_emisor, r.id_plan_servicio, r.fecha_emision, r.fecha_vencimiento, r.monto_unitario, r.descuento, r.monto_total, r.igv, r.estado, r.fecha_pago, r.motivo_descuento, r.fecha_creacion, r.fecha_actualizacion, r.subtotal
FROM recibos r
WHERE r.codigo_recibo = :codigo_recibo");

$stmt->execute(['codigo_recibo' => $codigo_recibo]);

$recibo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!empty($recibo)) {
    echo "Este recibo es autentico<br>";
    echo "N mero de recibo: " . $recibo['numero_recibo'] . "<br>";
    echo "Fecha de emisi n: " . $recibo['fecha_emision'] . "<br>";
    echo "Monto Total: " . $recibo['monto_total'] . "<br>";
}

if (empty($recibo)) {
    die('El código de recibo no existe');
}



exit();
