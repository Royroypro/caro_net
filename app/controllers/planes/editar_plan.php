<?php
include_once("../../config.php");
header('Content-Type: application/json');

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $datos = json_decode(file_get_contents('php://input'), true);
        $id_plan_servicio = $datos["id_plan"];
        $nombre_plan = $datos["nombre_plan"];
        $tarifa_mensual = $datos["tarifa_mensual"] / 1.18;
        $igv_tarifa = $datos["tarifa_mensual"] - $tarifa_mensual;
        $descripcion = $datos["descripcion"];
        $velocidad = $datos["velocidad"];
        $codigo_plan = $datos["codigo_plan"];

        $stmt = $pdo->prepare("UPDATE planes_servicio SET nombre_plan = :nombre_plan, descripcion = :descripcion, tarifa_mensual = :tarifa_mensual, velocidad = :velocidad, codigo_plan = :codigo_plan, igv_tarifa = :igv_tarifa WHERE id_plan_servicio = :id_plan_servicio");
        $stmt->bindParam(':id_plan_servicio', $id_plan_servicio);
        $stmt->bindParam(':nombre_plan', $nombre_plan);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':tarifa_mensual', $tarifa_mensual);
        $stmt->bindParam(':velocidad', $velocidad);
        $stmt->bindParam(':codigo_plan', $codigo_plan);
        $stmt->bindParam(':igv_tarifa', $igv_tarifa);
        $stmt->execute();

        $response['success'] = true;
        $response['message'] = "Guardado correctamente";
    } catch (Exception $e) {
        $response['success'] = false;
        $response['message'] = "Error: " . $e->getMessage();
    }
} else {
    $response['success'] = false;
    $response['message'] = "Método no permitido";
}

echo json_encode($response);
exit;

