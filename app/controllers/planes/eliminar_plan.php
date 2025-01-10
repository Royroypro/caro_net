<?php
include_once('../../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_plan_servicio = $_POST['id_plan_servicio'] ?? null;

    if (!$id_plan_servicio) {
        $response['success'] = false;
        $response['message'] = "No se ha especificado el plan a eliminar";
    } else {
        // Actualizar el estado del plan a 2 (eliminado) en la base de datos
        $stmt = $pdo->prepare("UPDATE planes_servicio SET estado = 2, fecha_actualizacion = CURRENT_TIMESTAMP WHERE id_plan_servicio = :id_plan_servicio");
        $stmt->bindParam(':id_plan_servicio', $id_plan_servicio);
        $stmt->execute(); // Ejecutar la consulta para eliminar el plan
        $response['success'] = true;
        $response['message'] = "Plan eliminado correctamente";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Método no permitido";
}


echo json_encode($response);
exit;

