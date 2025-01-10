<?php
include_once '../app/config.php';

?>

<div id="main-wrapper">
    <?php

    include_once '../layout/parte1.php';
    ?>

    <div class="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Crear Plan</h4>
                        <h6 class="card-subtitle">Complete la información</h6>
                        <form id="crearPlanForm" class="form-horizontal m-t-30">
                            <div class="form-group">
                                <label for="nombre" class="col-sm-12">Nombre</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nombre" name="nombre_plan" placeholder="Ingrese el nombre del plan" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="codigo" class="col-sm-12">Código</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="codigo" name="codigo_plan" placeholder="El código se generará automáticamente" required readonly>
                                </div>
                            </div>
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                                // Escuchar cambios en el campo de nombre
                                $('#nombre').on('input', function() {
                                    var nombre = $('#nombre').val().trim(); // Eliminar espacios adicionales
                                    if (nombre.length >= 2) {
                                        // Tomar las primeras 2 letras del nombre y convertirlas en mayúsculas
                                        var letras = nombre.substring(0, 2).toUpperCase();
                                        // Generar un número aleatorio de 8 dígitos
                                        var numero = String(Math.floor(10000000 + Math.random() * 90000000));
                                        // Concatenar las letras con el número generado
                                        var codigo = letras + numero;
                                        // Asignar el código al campo correspondiente
                                        $('#codigo').val(codigo);
                                    } else {
                                        $('#codigo').val(''); // Vaciar el código si el nombre es muy corto
                                    }
                                });
                            </script>


                            <div class="form-group">
                                <label for="costo" class="col-sm-12">Tarifa mensual S/.</label>
                                <div class="col-sm-12">
                                    <input type="number" step="0.01" class="form-control" id="costo" name="tarifa_mensual" placeholder="Ingrese la tarifa mensual del plan" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="descripcion" class="col-sm-12">Descripción</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese una descripción del plan" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="velocidad" class="col-sm-12">Velocidad</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="velocidad" name="velocidad" placeholder="Ingrese la velocidad del plan" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-warning" style="background-color: #EC672B; border-color: #EC672B;">Crear</button>
                                </div>
                            </div>
                        </form>
                        

                        <!-- Contenedor para mensajes -->
                        <div id="mensajeExito" style="display:none; color:green; font-weight:bold;"></div>

                        <!-- JavaScript -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                // Escuchar el evento submit del formulario
                                $("#crearPlanForm").on("submit", function(e) {
                                    e.preventDefault(); // Evitar que se recargue la página

                                    // Obtener datos del formulario
                                    const datos = {
                                        nombre_plan: $("#nombre").val().trim(),
                                        tarifa_mensual: $("#costo").val().trim(),
                                        descripcion: $("#descripcion").val().trim(),
                                        velocidad: $("#velocidad").val().trim(),
                                        codigo_plan: $("#codigo").val().trim() // Cambié "codigo" a "codigo_plan" para consistencia
                                    };

                                    // Validar campos antes de enviar (opcional)
                                    if (!datos.nombre_plan || !datos.tarifa_mensual || !datos.descripcion || !datos.velocidad || !datos.codigo_plan) {
                                        alert("Por favor, complete todos los campos.");
                                        return;
                                    }

                                    // Enviar datos usando AJAX
                                    $.ajax({
                                        url: "../app/controllers/planes/crear_plan.php", // Archivo PHP que procesa la solicitud
                                        method: "POST",
                                        contentType: "application/json",
                                        data: JSON.stringify(datos), // Convertir datos a JSON
                                        success: function(respuesta) {
                                            // Intentar parsear la respuesta como JSON
                                            try {
                                                const res = JSON.parse(respuesta);
                                                if (res.success) {
                                                    // Mostrar mensaje de éxito
                                                    $("#mensajeExito").text(res.message || "Guardado correctamente").show();

                                                    // Limpiar formulario
                                                    $("#crearPlanForm")[0].reset();
                                                } else {
                                                    // Mostrar mensaje de error del servidor
                                                    alert(res.message || "Ocurrió un error al guardar el plan.");
                                                }
                                            } catch (error) {
                                                console.error("Error al parsear la respuesta del servidor:", error);
                                                alert("Respuesta inesperada del servidor.");
                                            }
                                        },
                                        error: function(xhr, status, error) {
                                            console.error("Error de AJAX:", status, error);
                                            alert("Ocurrió un error al guardar el plan. Intente nuevamente.");
                                        }
                                    });
                                });
                            });
                        </script>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../layout/parte2.php'); ?>