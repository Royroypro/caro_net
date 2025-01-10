<?php
include_once '../app/config.php';
include_once '../app/controllers/clientes/consultar_cliente.php';


?>

<div id="main-wrapper">
    <?php

    include_once '../layout/parte1.php';

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    
    ?>
    <div class="page-wrapper">
        <?php
        


        if ($cliente){
            $id_cliente = htmlspecialchars($cliente['id_cliente'], ENT_QUOTES, 'UTF-8');
            $id_planes_servicios = htmlspecialchars($cliente['id_planes_servicios'], ENT_QUOTES, 'UTF-8');
            $Ip = htmlspecialchars($cliente['Ip'], ENT_QUOTES, 'UTF-8');
            $Nombre_wifi = htmlspecialchars($cliente['Nombre_wifi'], ENT_QUOTES, 'UTF-8');
            $Contraseña_wifi = htmlspecialchars($cliente['Contraseña_wifi'], ENT_QUOTES, 'UTF-8');
            $Ubicacion = htmlspecialchars($cliente['Ubicacion'], ENT_QUOTES, 'UTF-8');
            $Foto_ubicacion = htmlspecialchars($cliente['Foto_ubicacion'], ENT_QUOTES, 'UTF-8');
            $Foto_router = htmlspecialchars($cliente['Foto_router'], ENT_QUOTES, 'UTF-8');
            $Fecha_inicio = htmlspecialchars($cliente['Fecha_inicio'], ENT_QUOTES, 'UTF-8');
            $Fecha_finalizacion = htmlspecialchars($cliente['Fecha_finalizacion'], ENT_QUOTES, 'UTF-8');
            $Estado = htmlspecialchars($cliente['Estado'], ENT_QUOTES, 'UTF-8');
            $nombre_plan = htmlspecialchars($cliente['nombre_plan'], ENT_QUOTES, 'UTF-8');
            $tarifa_mensual = htmlspecialchars($cliente['tarifa_mensual'], ENT_QUOTES, 'UTF-8');
          
            $velocidad = htmlspecialchars($cliente['velocidad'], ENT_QUOTES,
             'UTF-8');
        }
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Detalle del Cliente</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <tbody>
                                                <tr>
                                                    <td>Estado</td>
                                                    <td><?php echo $cliente['estado'] == '1' ? '<span style="color:green;">Activo</span>' : '<span style="color:red;">Inactivo</span>'; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Nombre</td>
                                                    <td><?php echo $nombre; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Apellido Paterno</td>
                                                    <td><?php echo $apellido_paterno; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Apellido Materno</td>
                                                    <td><?php echo $apellido_materno; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>DNI/RUC</td>
                                                    <td><?php echo $dni_ruc; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tipo de Documento</td>
                                                    <td><?php echo $tipo_documento; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Celular</td>
                                                    <td><?php echo $celular; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td><?php echo $email; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Dirección</td>
                                                    <td><?php echo $direccion; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Referencia</td>
                                                    <td><?php echo $referencia; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-left">
                    <a href="lista_cliente.php" class="btn btn-primary">Regresar</a>
                </div>
                <br>
            </div>
        </div>
</div>

<?php include('../layout/parte2.php'); ?>