<?php
include_once '../app/config.php';
include_once '../layout/sesion.php';

// Verificar la conexión a la base de datos
if (!$pdo) {
    die("Error al conectar a la base de datos");
}
?>
<div id="main-wrapper">
    <?php include_once '../layout/parte1.php'; ?>
    <div class="page-wrapper">
        <form action="../app/controllers/facturas/emitir_recibo.php" method="post" class="form-horizontal m-t-30">
            <div class="form-group">
                <label for="buscar_cliente" class="col-sm-12">Buscar Cliente</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="buscar_cliente" placeholder="Ingrese nombre o DNI/RUC">
                </div>
            </div>

            <div class="form-group">
                <label for="id_cliente" class="col-sm-12">Seleccione un cliente y plan</label>
                <div class="col-sm-12">
                    <select class="form-control" id="id_cliente" name="id_cliente" required>
                        <option value="" selected>Seleccione un cliente y plan</option>
                        <?php
                        $stmt = $pdo->prepare("
                            SELECT c.id_cliente, c.nombre, c.apellido_paterno, c.apellido_materno, c.dni_ruc, c.tipo_documento, c.celular, c.email, c.direccion, c.referencia, p.nombre_plan, (p.tarifa_mensual + p.igv_tarifa) AS tarifa_mensual_igv, p.velocidad, p.igv_tarifa 
                            FROM clientes c 
                            JOIN cliente_planes cp ON c.id_cliente = cp.id_cliente 
                            JOIN planes_servicio p ON cp.id_planes_servicios = p.id_plan_servicio
                            WHERE c.estado = 1 AND cp.estado = 1
                        ");
                        $stmt->execute();
                        while ($fila = $stmt->fetch()) {
                            $tipo_documento = $fila['tipo_documento'] == 'DNI' ? 'DNI' : 'RUC';
                            echo "<option value='{$fila['id_cliente']}' data-precio='{$fila['tarifa_mensual_igv']}' data-igv_tarifa='{$fila['igv_tarifa']}' data-tipo-doc='{$fila['tipo_documento']}'>{$fila['nombre']} {$fila['apellido_paterno']} {$fila['apellido_materno']} - {$fila['dni_ruc']} ({$tipo_documento}) - {$fila['nombre_plan']} - S/.{$fila['tarifa_mensual_igv']} - Velocidad: {$fila['velocidad']}MB</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="numero_recibo" class="col-sm-12">Número de Recibo</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="numero_recibo" name="numero_recibo" placeholder="Ingrese el número de recibo" required readonly>
                </div>
            </div>

            <script>
                document.getElementById('id_cliente').addEventListener('change', function() {
                    const monto = document.getElementById('monto');
                    const numeroRecibo = document.getElementById('numero_recibo');

                    if (monto && numeroRecibo) {
                        const selectedOption = this.options[this.selectedIndex];
                        monto.value = selectedOption ? selectedOption.getAttribute('data-precio') : '';
                        
                        if (selectedOption) {
                            const tipoDocumento = selectedOption.getAttribute('data-tipo-doc');
                            $.ajax({
                                url: 'consultar_numero_recibo.php',
                                method: 'POST',
                                data: {
                                    tipo_documento: tipoDocumento
                                },
                                success: function(response) {
                                    numeroRecibo.value = response;
                                }
                            }).fail(function() {
                                console.error('Error al consultar número de recibo');
                            });
                        } else {
                            numeroRecibo.value = 'B001-000001';
                        }
                    }
                });
            </script>



            <div class="form-group">
                <label for="monto" class="col-sm-12">Monto Unitario</label>
                <div class="col-sm-12">
                    <input type="number" step="0.01" class="form-control" id="monto" name="monto" required readonly>
                </div>
            </div>

            <div class="form-group">
                <label for="descuento" class="col-sm-12">Descuento</label>
                <div class="col-sm-12">
                    <select class="form-control" id="aplica_descuento" name="aplica_descuento" required>
                        <option value="" selected>Seleccione una opción</option>
                        <option value="0" selected>No</option>
                        <option value="1">Sí</option>
                    </select>
                </div>
            </div>



            <div class="form-group" id="div_descuento" style="display: none;">
                <label for="descuento" class="col-sm-12">Monto del Descuento</label>
                <div class="col-sm-12">
                    <input type="number" step="0.01" class="form-control" id="descuento" name="descuento" value="0" required>
                </div>
            </div>

            <div class="form-group" id="div_motivo_descuento" style="display: none;">
                <label for="motivo_descuento" class="col-sm-12">Motivo del Descuento</label>
                <div class="col-sm-12">
                    <textarea class="form-control" id="motivo_descuento" name="motivo_descuento"></textarea>
                </div>
            </div>
            <script>
                document.getElementById('aplica_descuento').addEventListener('change', function() {
                    const aplica_descuento = this.value;
                    const div_motivo_descuento = document.getElementById('div_motivo_descuento');

                    if (aplica_descuento === '1') {
                        div_motivo_descuento.style.display = 'block';
                    } else {
                        div_motivo_descuento.style.display = 'none';
                    }
                });
            </script>

            
            <div class="form-group">
                <label for="subtotal" class="col-sm-12">Subtotal</label>
                <div class="col-sm-12">
                    <input type="number" step="0.01" class="form-control" id="subtotal" name="subtotal" value="0" required readonly>
                </div>
            </div>

            <div class="form-group">
                <label for="igv" class="col-sm-12">IGV (18%)</label>
                <div class="col-sm-12">
                    <input type="number" step="0.01" class="form-control" id="igv" name="igv" value="0" required readonly>
                </div>
            </div>

            <div class="form-group">
                <label for="monto_total" class="col-sm-12">Monto Total</label>
                <div class="col-sm-12">
                    <input type="number" step="0.01" class="form-control" id="monto_total" name="monto_total" required readonly>
                </div>
            </div>

            <script>
                document.getElementById('aplica_descuento').addEventListener('change', function() {
                    const aplica_descuento = this.value;
                    const div_descuento = document.getElementById('div_descuento');

                    if (aplica_descuento === '1') {
                        div_descuento.style.display = 'block';
                    } else {
                        div_descuento.style.display = 'none';
                    }
                });
            </script>

            <script>
                function calcularIGV() {
                    const monto = parseFloat(document.getElementById('monto').value) || 0;
                    const descuento = parseFloat(document.getElementById('descuento').value) || 0;
                    const montoTotal = monto - descuento;
                  
                    const selectedOption = document.getElementById('id_cliente').selectedOptions[0];
                    const igvTarifa = selectedOption ? parseFloat(selectedOption.getAttribute('data-igv_tarifa')) : 0;
                    document.getElementById('igv').value = igvTarifa.toFixed(2);
                    document.getElementById('monto_total').value = (montoTotal + igvTarifa).toFixed(2);
                    document.getElementById('subtotal').value = montoTotal.toFixed(2);
                }

                document.getElementById('descuento').addEventListener('input', calcularIGV);

                document.getElementById('id_cliente').addEventListener('change', function() {
                    const monto = document.getElementById('monto');
                    const selectedOption = this.options[this.selectedIndex];
                    const precio = selectedOption ? parseFloat(selectedOption.getAttribute('data-precio')) : 0;
                    const igvTarifa = selectedOption ? parseFloat(selectedOption.getAttribute('data-igv_tarifa')) : 0;
                    const neto = precio - igvTarifa;
                    monto.value = neto.toFixed(2);
                    calcularIGV(); // Trigger calculation
                });

                const id_cliente = document.getElementById('id_cliente');
                const id_cliente_hidden = document.getElementById('id_cliente_hidden');
                id_cliente.addEventListener('change', function() {
                    id_cliente_hidden.value = this.value;
                });
            </script>

            

            <div class="form-group">
                <label for="Fecha_inicio" class="col-sm-12">Fecha de Emision</label>
                <div class="col-sm-12">
                    <input type="date" class="form-control" id="Fecha_inicio" name="Fecha_inicio" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Fecha_finalizacion" class="col-sm-12">Pagar antes de:</label>
                <div class="col-sm-12">
                    <input type="date" class="form-control" id="Fecha_finalizacion" name="Fecha_finalizacion" value="<?php echo date('Y-m-d', strtotime('+15 days')); ?>" required>
                </div>
            </div>

            <script>
                document.getElementById('Fecha_inicio').addEventListener('change', function() {
                    const fechaInicio = new Date(this.value);
                    const fechaFinalizacion = document.getElementById('Fecha_finalizacion');
                    fechaInicio.setDate(fechaInicio.getDate() + 15);
                    fechaFinalizacion.value = fechaInicio.toISOString().split('T')[0];
                });
            </script>
            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Emitir Recibo</button>
                </div>
            </div>
        </form>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                let opcionesOriginales = $('#id_cliente').html();
                $('#buscar_cliente').on('input', function() {
                    const query = $(this).val();
                    if (query.length > 1) {
                        $('#loading').show();
                        $.ajax({
                            url: 'buscar_planes_cliente.php',
                            method: 'POST',
                            data: {
                                query
                            },
                            success: function(response) {
                                $('#id_cliente').html(response);
                                const selectedOption = $('#id_cliente').find('option:selected');
                                const precio = selectedOption ? parseFloat(selectedOption.data('precio')) : 0;
                                $('#monto').val(precio.toFixed(2));
                                const descuento = parseFloat($('#descuento').val()) || 0;
                                const montoTotal = precio - descuento;
                                $('#subtotal').val(montoTotal.toFixed(2));
                                const igv = (selectedOption ? parseFloat(selectedOption.data('igv_tarifa')) : 0).toFixed(2);
                                $('#igv').val(igv);
                                $('#monto_total').val((montoTotal + parseFloat(igv)).toFixed(2));
                                
                                $.ajax({
                                    url: 'consultar_numero_recibo.php',
                                    method: 'POST',
                                    data: {
                                        tipo_documento: selectedOption.data('tipo_documento')
                                    },
                                    success: function(response) {
                                        $('#numero_recibo').val(response);
                                    },
                                    error: function() {
                                        console.error('Error al consultar número de recibo');
                                    }
                                });



                                function checkNumeroReciboExiste(tipoDocumento, numeroRecibo) {
                                    // This function should make a synchronous AJAX call to verify if numeroRecibo exists
                                    // This is a placeholder and should be implemented accordingly
                                    return false;
                                }
                            },
                            complete: function() {
                                $('#loading').hide();
                            }
                        });
                    } else if (query.length === 0) {
                        $('#id_cliente').html(opcionesOriginales);
                        $('#monto').val('');
                        $('#monto_total').val('');
                        $('#igv').val('');
                        $('#numero_recibo').val('B001-000001');
                    }
                });

                $('#descuento').on('input', function() {
                    const precio = parseFloat($('#monto').val()) || 0;
                    const descuento = parseFloat($(this).val()) || 0;
                    const montoTotal = precio - descuento;
                    $('#subtotal').val(montoTotal.toFixed(2));
                    const igv = (selectedOption ? parseFloat(selectedOption.data('igv_tarifa')) : 0).toFixed(2);
                    $('#igv').val(igv);
                    $('#monto_total').val((montoTotal + parseFloat(igv)).toFixed(2));
                });
            });
        </script>
        <?php include "../layout/parte2.php"; ?>
    </div>
</div>