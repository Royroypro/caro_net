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
                            <h5 class="card-title">Lista de Planes</h5>

                            <div style="overflow-x:auto;">
                                <input type="text" id="searchInput" class="form-control" placeholder="Buscar planes..." onkeyup="searchFunction()">
                                <table id="planes" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Nombre</th>
                                            <th>Código Plan</th>
                                            <th>Tarifa mensual</th>
                                            <th>Velocidad</th>
                                            
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $pdo->prepare("SELECT * FROM planes_servicio WHERE estado != 2");
                                        $stmt->execute();
                                        $planes = $stmt->fetchAll();
                                        $totalPlanes = count($planes);
                                        $planesPorPagina = 5;
                                        $totalPaginas = ceil($totalPlanes / $planesPorPagina);
                                        $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                        $inicio = ($paginaActual - 1) * $planesPorPagina;
                                        $planesPagina = array_slice($planes, $inicio, $planesPorPagina);

                                        foreach ($planesPagina as $row) {
                                        ?>
                                            <tr>
                                                <td><?php echo $inicio + array_search($row, $planesPagina) + 1; ?></td>
                                                <td><?php echo $row['nombre_plan']; ?></td>
                                                <!-- Add this column for Código Plan -->
                                                <td><?php echo $row['codigo_plan']; ?></td>

                                                <td><?php echo ($row['tarifa_mensual'] + $row['igv_tarifa']); ?></td>
                                                <td><?php echo $row['velocidad']; ?></td>
                                                
                                                <td>
                                                    <?php
                                                    if ($row['estado'] == 1) {
                                                        echo '<span class="badge badge-success">Activo</span>';
                                                    } else {
                                                        echo '<span class="badge badge-danger">Inactivo</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Acciones
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="editar_plan.php?id=<?php echo $row['id_plan_servicio']; ?>">Editar</a>
                                                            <a class="dropdown-item" href="eliminar_plan.php?id=<?php echo $row['id_plan_servicio']; ?>">Eliminar</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
                                    table = document.getElementById("planes");
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
                            </script>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>




<?php include('../layout/parte2.php'); ?>