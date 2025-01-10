<?php

include_once('../../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $nombre = $_POST["nombre"] ?? null;
        $apellido_paterno = $_POST["apellido_paterno"] ?? null;
        $apellido_materno = $_POST["apellido_materno"] ?? null;
        $tipo_documento = $_POST["tipo_documento"] ?? null;
        $dni_ruc = $_POST["dni_ruc"] ?? null;
        $celular = $_POST["celular"] ?? null;
        $email = $_POST["email"] ?? null;
        $direccion = $_POST["direccion"] ?? null;
        $referencia = $_POST["referencia"] ?? null;

        if (empty($nombre) || empty($apellido_paterno) || empty($apellido_materno) || empty($tipo_documento) || empty($dni_ruc) || empty($celular) || empty($email) || empty($direccion) || empty($referencia)) {
            $response['success'] = false;
            $response['message'] = "Debe completar todos los campos";
        } else {
            // Check if dni_ruc already exists
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM clientes WHERE dni_ruc = :dni_ruc");
            $stmt->bindParam(':dni_ruc', $dni_ruc);
            $stmt->execute();
            $dniExists = $stmt->fetchColumn() > 0;

            // Check if email already exists
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM clientes WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $emailExists = $stmt->fetchColumn() > 0;

            if ($dniExists) {
                $response['success'] = false;
                $response['message'] = "El DNI/RUC ya existe";
            } elseif ($emailExists) {
                $response['success'] = false;
                $response['message'] = "El correo electr nico ya existe";
            } else {
                $stmt = $pdo->prepare("INSERT INTO clientes (nombre, apellido_paterno, apellido_materno, tipo_documento, dni_ruc, celular, email, direccion, referencia) VALUES (:nombre, :apellido_paterno, :apellido_materno, :tipo_documento, :dni_ruc, :celular, :email, :direccion, :referencia)");
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':apellido_paterno', $apellido_paterno);
                $stmt->bindParam(':apellido_materno', $apellido_materno);
                $stmt->bindParam(':tipo_documento', $tipo_documento);
                $stmt->bindParam(':dni_ruc', $dni_ruc);
                $stmt->bindParam(':celular', $celular);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':direccion', $direccion);
                $stmt->bindParam(':referencia', $referencia);

                if ($stmt->execute()) {
                    $response['success'] = true;
                    $response['message'] = "Guardado correctamente";
                } else {
                    $response['success'] = false;
                    $response['message'] = "Error al guardar el cliente. Intente nuevamente.";
                }
            }
        }
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

