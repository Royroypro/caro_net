<?php
include_once("../../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Leer datos JSON desde la entrada
        $json = file_get_contents('php://input');
        $datos = json_decode($json, true);

        // Validar campos antes de procesar
        if (!isset($datos['nombre_plan'], $datos['tarifa_mensual'], $datos['descripcion'], $datos['velocidad'], $datos['codigo_plan'])) {
            echo json_encode(['success' => false, 'message' => 'Por favor, complete todos los campos.']);
            exit;
        }

        $nombre_plan = $datos['nombre_plan'];
        $tarifa_mensual = $datos['tarifa_mensual'];

        $tarifa_mensual = $datos['tarifa_mensual'] / 1.18;
        $igv_tarifa = $datos['tarifa_mensual'] - $tarifa_mensual;

        $descripcion = $datos['descripcion'];
        $velocidad = $datos['velocidad'];
        $codigo_plan = $datos['codigo_plan'];
        $estado = 1;

        // Preparar la consulta SQL para insertar
        $stmt = $pdo->prepare("
            INSERT INTO planes_servicio (nombre_plan, descripcion, tarifa_mensual, velocidad, codigo_plan, estado, igv_tarifa) 
            VALUES (:nombre_plan, :descripcion, :tarifa_mensual, :velocidad, :codigo_plan, :estado, :igv_tarifa)
        ");

        // Enlazar los valores
        $stmt->bindParam(':nombre_plan', $nombre_plan);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':tarifa_mensual', $tarifa_mensual);
        $stmt->bindParam(':velocidad', $velocidad);
        $stmt->bindParam(':codigo_plan', $codigo_plan);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':igv_tarifa', $igv_tarifa);

        // Ejecutar la consulta
        $stmt->execute();

        // Enviar respuesta JSON
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Plan creado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al crear el plan']);
        }
    } catch (Exception $e) {
        // Manejo de errores
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

