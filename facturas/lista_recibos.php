<?php
include_once '../app/config.php';
?>
<div id="main-wrapper">
    <?php

    include_once '../layout/parte1.php';
    ?>


    <div class="page-wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Lista de Recibos</h5>

                            <div style="overflow-x:auto;">
                                <input type="text" id="searchInput" class="form-control" placeholder="Buscar clientes..." onkeyup="searchFunction()">
                                <table id="reciboTable" class="table table-striped table-bordered" style="width:100%; font-size: 0.9em;">
                                    <thead>
                                        <tr>
                                            <th>N° Recibo</th>

                                            <th>Cliente</th>
                                            <th>Fecha Emisión</th>
                                            <th>Fecha Vencimiento</th>
                                            <th>Fecha Envio SUNAT</th>
                                            <th>Monto Total</th>
                                            <th>Descargar XML</th>
                                            <th>Descargar PDF</th>
                                            <th>Descargar TICKET</th>
                                            <th>Estado de pago Cliente</th>


                                            <th>Estado SUNAT</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $pdo->prepare("SELECT r.id_recibo, r.numero_recibo, r.Tipo_documento, r.dni_ruc, r.id_cliente, r.id_emisor, r.id_plan_servicio, r.fecha_emision, r.fecha_vencimiento, r.monto_unitario, r.descuento, r.monto_total, r.estado, r.estado_sunat, r.fecha_envio_sunat FROM recibos r ");
                                        $stmt->execute();
                                        $recibos = $stmt->fetchAll();
                                        $totalRecibos = count($recibos);
                                        $recibosPorPagina = 5;
                                        $totalPaginas = ceil($totalRecibos / $recibosPorPagina);
                                        $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                        $inicio = ($paginaActual - 1) * $recibosPorPagina;
                                        $recibosPagina = array_slice($recibos, $inicio, $recibosPorPagina);

                                        foreach ($recibosPagina as $row) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['numero_recibo']; ?></td>

                                                <td>
                                                    <?php
                                                    $stmt2 = $pdo->prepare("SELECT nombre FROM clientes WHERE id_cliente = :id_cliente");
                                                    $stmt2->execute(['id_cliente' => $row['id_cliente']]);
                                                    $fila2 = $stmt2->fetch();
                                                    echo $fila2['nombre'] . ' - ' . $row['dni_ruc'];
                                                    ?>
                                                </td>
                                                <td><?php echo date('d-m-Y', strtotime($row['fecha_emision'])); ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($row['fecha_vencimiento'])); ?></td>

                                                <td><?php echo (is_null($row['fecha_envio_sunat'])) ? 'Aun no ha sido enviado' : date('d-m-Y H:i:s', strtotime($row['fecha_envio_sunat'])); ?></td>

                                                <td><?php echo $row['monto_total']; ?></td>

                                                <td>
                                                    <a href="descargar_xml.php?id_recibo=<?php echo $row['id_recibo']; ?>" class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-file-download"></i> XML
                                                    </a>
                                                </td>

                                                <td>
                                                    <a href="descargar_pdf.php?id_recibo=<?php echo $row['id_recibo']; ?>" class="btn btn-outline-info btn-sm">
                                                        <i class="fas fa-file-pdf"></i> PDF
                                                    </a>

                                                </td>

                                                <td>
                                                    <a href="descargar_tiket.php?id_recibo=<?php echo $row['id_recibo']; ?>" class="btn btn-outline-warning btn-sm">
                                                        <i class="fas fa-file-pdf"></i> TIKET
                                                    </a>

                                                </td>
                                                <td>
                                                    <!-- Span para el estado -->
                                                    <span id="estadoSpan<?php echo $row['id_recibo']; ?>" class="badge 
        <?php
                                            switch ($row['estado']) {
                                                case 'NO_ENVIADO':
                                                    echo 'badge-secondary';
                                                    break;
                                                case 'ENVIADO':
                                                    echo 'badge-info';
                                                    break;
                                                case 'VENCIDO':
                                                    echo 'badge-danger';
                                                    break;
                                                case 'PAGADO':
                                                    echo 'badge-success';
                                                    break;
                                                default:
                                                    echo 'badge-secondary';
                                                    break;
                                            }
        ?>">
                                                        <?php echo $row['estado']; ?>
                                                    </span>
                                                    <!-- Mostrar estado actual -->
                                                    <div id="estadoActual<?php echo $row['id_recibo']; ?>"></div>
                                                
                                                    <!-- Botón para abrir el modal -->
                                                    <button id="botonCambiarEstado<?php echo $row['id_recibo']; ?>" type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#modalCambiarEstado<?php echo $row['id_recibo']; ?>">
                                                        <i class="fas fa-edit"></i> Cambiar Estado
                                                    </button>
                                                </td>







                                                <td>
                                                    <?php
                                                    if ($row['estado_sunat'] == 'ACEPTADA') {
                                                        echo '<span class="badge badge-success">ACEPTADA</span>';
                                                    } else if ($row['estado_sunat'] == 'RECHAZADA') {
                                                        echo '<span class="badge badge-danger">RECHAZADA</span>';
                                                    } else if ($row['estado_sunat'] == 'NO_ENVIADA') {
                                                        echo '<span class="badge badge-warning">NO_ENVIADA</span>';
                                                    } else {
                                                        echo '<span class="badge badge-secondary">PENDIENTE</span>';
                                                    }
                                                    ?>



                                                    <?php if ($row['estado_sunat'] == 'NO_ENVIADA') { ?>
                                                        <a href="enviar_sunat.php?id_recibo=<?php echo $row['id_recibo']; ?>" class="btn btn-outline-primary btn-sm ml-2">Enviar a SUNAT</a>
                                                    <?php } ?>
                                                </td>

                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="modal fade" id="modalCambiarEstado<?php echo $row['id_recibo']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cambiar estado del recibo de <?php echo $fila2['nombre'] . ' - ' . $row['dni_ruc']; ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!-- Agregamos un id único para el formulario -->
                                            <form id="formCambiarEstado<?php echo $row['id_recibo']; ?>">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="estado">Estado</label>
                                                        <select class="form-control" id="estado" name="estado" required>
                                                            <option value="NO_ENVIADO" <?php echo $row['estado'] == 'NO_ENVIADO' ? 'selected' : ''; ?>>No Enviado</option>
                                                            <option value="ENVIADO" <?php echo $row['estado'] == 'ENVIADO' ? 'selected' : ''; ?>>Enviado</option>
                                                            <option value="VENCIDO" <?php echo $row['estado'] == 'VENCIDO' ? 'selected' : ''; ?>>Vencido</option>
                                                            <option value="PAGADO" <?php echo $row['estado'] == 'PAGADO' ? 'selected' : ''; ?>>Pagado</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <!-- Cambiamos el botón de tipo submit -->
                                                    <button type="button" class="btn btn-primary" onclick="guardarEstado(<?php echo $row['id_recibo']; ?>)">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <div class="pagination">
                                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                                        <a href="?pagina=<?php echo $i; ?>" class="btn btn-primary <?php echo $i == $paginaActual ? 'active' : ''; ?>"><?php echo $i; ?></a>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <script>
                                function searchFunction() {
                                    var input, filter, table, tr, td, i, txtValue;
                                    input = document.getElementById("searchInput");
                                    filter = input.value.toUpperCase();
                                    table = document.getElementById("reciboTable");
                                    tr = table.getElementsByTagName("tr");
                                    for (i = 1; i < tr.length; i++) {
                                        tr[i].style.display = "none";
                                        td = tr[i].getElementsByTagName("td");
                                        for (var j = 0; j < td.length; j++) {
                                            if (td[j]) {
                                                txtValue = td[j].textContent || td[j].innerText;
                                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                                    tr[i].style.display = "";
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                }

                                function guardarEstado(idRecibo) {
                                    const formId = `formCambiarEstado${idRecibo}`;
                                    const form = document.getElementById(formId);

                                    if (!form) {
                                        console.error(`No se encontró el formulario con ID ${formId}`);
                                        alert('Hubo un problema al encontrar el formulario.');
                                        return;
                                    }

                                    const formData = new FormData(form);
                                    formData.append('id_recibo', idRecibo);

                                    fetch('cambiar_estado_cliente.php', {
                                            method: 'POST',
                                            body: formData,
                                        })
                                        .then((response) => response.json())
                                        .then((data) => {
                                            if (data.success) {
                                                alert('Estado actualizado correctamente.');

                                                // Actualizar el span del estado
                                                const estadoSpan = document.querySelector(`#estadoSpan${idRecibo}`);
                                                if (estadoSpan) {
                                                    estadoSpan.textContent = data.estado;
                                                    estadoSpan.className = `badge badge-${data.estado === 'PAGADO' ? 'success' :
                                            data.estado === 'VENCIDO' ? 'danger' :
                                            data.estado === 'ENVIADO' ? 'info' : 'secondary'}`;
                                                } else {
                                                    console.error(`No se encontró el elemento span para el estado con ID ${idRecibo}`);
                                                }

                                                // Actualizar el botón si es necesario
                                                const botonCambiarEstado = document.querySelector(`#botonCambiarEstado${idRecibo}`);
                                                if (botonCambiarEstado) {
                                                    botonCambiarEstado.disabled = false;
                                                }

                                                // Mostrar el estado actualizado en el span
                                                const estadoActualSpan = document.querySelector(`#estadoSpan${idRecibo}`);
                                                if (estadoActualSpan) {
                                                    estadoActualSpan.textContent = data.estadoactualizado;
                                                    estadoActualSpan.className = `badge badge-${data.estado === 'PAGADO' ? 'success' :
                                                            data.estado === 'VENCIDO' ? 'danger' :
                                                            data.estado === 'ENVIADO' ? 'info' :
                                                            data.estado === 'PENDIENTE' ? 'warning' :
                                                            'secondary'}`;
                                                } else {
                                                    console.error(`No se encontró el elemento span para el estado con ID ${idRecibo}`);
                                                }
                                            } else {
                                                alert('Error al actualizar el estado: ' + (data.message || 'Respuesta desconocida del servidor.'));
                                            }
                                        })
                                        .catch((error) => {
                                            console.error('Error en la solicitud:', error);
                                            alert('Hubo un error al procesar la solicitud. Intenta nuevamente.');
                                        });
                                }
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>




<?php include('../layout/parte2.php'); ?>