<?php


try {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT id_plan_servicio, nombre_plan, descripcion, tarifa_mensual, velocidad, estado, fecha_creacion, fecha_actualizacion FROM planes_servicio WHERE id_plan_servicio = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $plan = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($plan) {
            $response['success'] = true;
            $response['data'] = $plan;
        } else {
            $response['success'] = false;
            $response['message'] = "No se encontr  el plan con id: " . $id;
        }
    } else {
        $response['success'] = false;
        $response['message'] = "No se ha especificado el id del plan";
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = "Error: " . $e->getMessage();
}



