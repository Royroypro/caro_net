<?php
include_once("../../config.php");
header('Content-Type: application/json');

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $datos = json_decode(file_get_contents('php://input'), true);
        $nombre_plan = $datos["nombre_plan"];
        $tarifa_mensual = $datos["tarifa_mensual"];
        $descripcion = $datos["descripcion"];
        $velocidad = $datos["velocidad"];
        $estado = 1;

        $stmt = $pdo->prepare("INSERT INTO planes_servicio (nombre_plan, descripcion, tarifa_mensual, velocidad, estado) VALUES (:nombre_plan, :descripcion, :tarifa_mensual, :velocidad, :estado)");
        $stmt->bindParam(':nombre_plan', $nombre_plan);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':tarifa_mensual', $tarifa_mensual);
        $stmt->bindParam(':velocidad', $velocidad);
        $stmt->bindParam(':estado', $estado);
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



/* CREATE TABLE IF NOT EXISTS `planes_servicio` (
    `id_plan_servicio` int NOT NULL AUTO_INCREMENT,
    `nombre_plan` varchar(100) NOT NULL,
    `descripcion` text,
    `tarifa_mensual` decimal(10,2) NOT NULL,
    `velocidad` varchar(50) DEFAULT NULL,
    `estado` tinyint DEFAULT '1',
    `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
    `fecha_actualizacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_plan_servicio`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
   */