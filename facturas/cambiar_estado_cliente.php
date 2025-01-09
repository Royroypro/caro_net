<?php
header('Content-Type: application/json');
require_once '../app/config.php'; // Asegúrate de incluir tu conexión a la base de datos

$id_recibo = $_POST['id_recibo'] ?? null;
$estado = $_POST['estado'] ?? null;

if ($id_recibo && $estado) {
    $stmt = $pdo->prepare("UPDATE recibos SET estado = :estado WHERE id_recibo = :id_recibo");
    if ($stmt->execute([':estado' => $estado, ':id_recibo' => $id_recibo])) {
        echo json_encode(['success' => true, 'estadoactualizado' => $estado]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al ejecutar la consulta.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}

