<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="plan/image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Matrix Template - The Ultimate Multipurpose admin template</title>
    <!-- Custom CSS -->
    <link href="<?php echo $URL; ?>/plan/assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo $URL; ?>/plan/dist/css/style.min.css" rel="stylesheet">

</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>


    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header" data-logobg="skin5">
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <a class="navbar-brand" href="index.html">
                    <!-- Logo icon -->
                    <b class="logo-icon p-l-10">
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="<?php echo $URL; ?>/plan/assets/images/logo.png" alt="homepage" class="light-logo" />

                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span class="logo-text">
                        <!-- dark Logo text -->
                        <!-- <img src="plan/assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                    </span>

                </a>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Toggle which is visible on mobile only -->
                <!-- ============================================================== -->
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-left mr-auto">
                    <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>

                </ul>
                <!-- ============================================================== -->
                <!-- Right side toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-right">

                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        
                        <a style="margin-top: 10px; margin-bottom: -20px;" class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $URL; ?>/plan/assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                        <div class="dropdown-menu dropdown-menu-right user-dd animated">
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                            <div class="dropdown-divider"></div>
                            <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                </ul>
            </div>
        </nav>
    </header>
 
    <aside class="left-sidebar" data-sidebarbg="skin5">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav" class="p-t-30">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $URL; ?>home.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>

                    <li class="sidebar-item active" id="menu-planes">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="true">
                            <i class="mdi mdi-package-variant"></i><span class="hide-menu">Planes </span>
                        </a>
                        <ul aria-expanded="true" class="collapse first-level" id="submenu-planes" style="margin-left: 5mm; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                            <li class="sidebar-item"><a href="<?php echo $URL; ?>planes/crear_plan.php" class="sidebar-link"><i class="mdi mdi-package"></i><span class="hide-menu"> Registrar Planes </span></a></li>
                            <li class="sidebar-item"><a href="<?php echo $URL; ?>planes/lista_planes.php" class="sidebar-link"><i class="mdi mdi-package-variant-closed"></i><span class="hide-menu"> Lista de Planes </span></a></li>
                        </ul>
                    </li>


                    <li class="sidebar-item active" id="menu-clientes">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="true">
                            <i class="mdi mdi-account-multiple"></i><span class="hide-menu">Clientes </span>
                        </a>
                        <ul aria-expanded="true" class="collapse first-level" id="submenu-clientes" style="margin-left: 5mm; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                            <li class="sidebar-item"><a href="<?php echo $URL; ?>clientes/crear_cliente.php" class="sidebar-link"><i class="mdi mdi-account-outline"></i><span class="hide-menu"> Registrar Clientes </span></a></li>
                            <li class="sidebar-item"><a href="<?php echo $URL; ?>clientes/lista_cliente.php" class="sidebar-link"><i class="mdi mdi-account-plus"></i><span class="hide-menu"> Lista de Clientes </span></a></li>
                        </ul>
                    </li>

                    
                    <li class="sidebar-item active" id="menu-venta-planes">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="true">
                            <i class="mdi mdi-cash-usd"></i><span class="hide-menu">Venta de Planes </span>
                        </a>
                        <ul aria-expanded="true" class="collapse first-level" id="submenu-venta-planes" style="margin-left: 5mm; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                            <li class="sidebar-item"><a href="<?php echo $URL; ?>venta_planes/venta_plan.php" class="sidebar-link"><i class="mdi mdi-cash-usd"></i><span class="hide-menu"> Crear Venta</span></a></li>
                            <li class="sidebar-item"><a href="<?php echo $URL; ?>venta_planes/lista_venta.php" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Lista de Ventas </span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item active" id="menu-facturas">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="true">
                            <i class="mdi mdi-receipt"></i><span class="hide-menu">Facturas </span>
                        </a>
                        <ul aria-expanded="true" class="collapse first-level" id="submenu-facturas" style="margin-left: 5mm; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                            <li class="sidebar-item"><a href="factura/factura.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Generar Factura </span></a></li>
                            <li class="sidebar-item"><a href="factura/ver-factura.php" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Ver Factura </span></a></li>
                        </ul>
                    </li>


                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
   
</body>

</html>

<script>
    //script para el menu lateral


    document.addEventListener("DOMContentLoaded", function() {
        const menuItem = document.getElementById("menu-clientes");
        const submenu = document.getElementById("submenu-clientes");

        // Restaurar el estado del menú desde localStorage
        const isExpanded = localStorage.getItem("menu-clientes-expanded") === "true";

        if (isExpanded) {
            menuItem.classList.add("active");
            submenu.style.display = "block"; // Mostrar el submenú
        } else {
            menuItem.classList.remove("active");
            submenu.style.display = "none"; // Ocultar el submenú
        }

        // Manejar clics en el enlace principal del menú
        menuItem.querySelector("a").addEventListener("click", function() {
            const currentlyExpanded = menuItem.classList.contains("active");

            if (currentlyExpanded) {
                menuItem.classList.remove("active");
                submenu.style.display = "none"; // Ocultar
                localStorage.setItem("menu-clientes-expanded", "false");
            } else {
                menuItem.classList.add("active");
                submenu.style.display = "block"; // Mostrar
                localStorage.setItem("menu-clientes-expanded", "true");
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const menuItem = document.getElementById("menu-facturas");
        const submenu = document.getElementById("submenu-facturas");

        // Restaurar el estado del menú desde localStorage
        const isExpanded = localStorage.getItem("menu-facturas-expanded") === "true";

        if (isExpanded) {
            menuItem.classList.add("active");
            submenu.style.display = "block"; // Mostrar el submenú
        } else {
            menuItem.classList.remove("active");
            submenu.style.display = "none"; // Ocultar el submenú
        }

        // Manejar clics en el enlace principal del menú
        menuItem.querySelector("a").addEventListener("click", function() {
            const currentlyExpanded = menuItem.classList.contains("active");

            if (currentlyExpanded) {
                menuItem.classList.remove("active");
                submenu.style.display = "none"; // Ocultar
                localStorage.setItem("menu-facturas-expanded", "false");
            } else {
                menuItem.classList.add("active");
                submenu.style.display = "block"; // Mostrar
                localStorage.setItem("menu-facturas-expanded", "true");
            }
        });
    });


    document.addEventListener("DOMContentLoaded", function() {
        const menuItem = document.getElementById("menu-planes");
        const submenu = document.getElementById("submenu-planes");

        // Restaurar el estado del menú desde localStorage
        const isExpanded = localStorage.getItem("menu-planes-expanded") === "true";

        if (isExpanded) {
            menuItem.classList.add("active");
            submenu.style.display = "block"; // Mostrar el submenú
            submenu.style.marginLeft = "5mm";
            submenu.style.boxShadow = "0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19)";
        } else {
            menuItem.classList.remove("active");
            submenu.style.display = "none"; // Ocultar el submenú
        }

        // Manejar clics en el enlace principal del menú
        menuItem.querySelector("a").addEventListener("click", function() {
            const currentlyExpanded = menuItem.classList.contains("active");

            if (currentlyExpanded) {
                menuItem.classList.remove("active");
                submenu.style.display = "none"; // Ocultar
                localStorage.setItem("menu-planes-expanded", "false");
            } else {
                menuItem.classList.add("active");
                submenu.style.display = "block"; // Mostrar
                localStorage.setItem("menu-planes-expanded", "true");
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const menuItem = document.getElementById("menu-venta-planes");
        const submenu = document.getElementById("submenu-venta-planes");

        // Restaurar el estado del menú desde localStorage
        const isExpanded = localStorage.getItem("menu-venta-planes-expanded") === "true";

        if (isExpanded) {
            menuItem.classList.add("active");
            submenu.style.display = "block"; // Mostrar el submenú
            submenu.style.marginLeft = "5mm";
            submenu.style.boxShadow = "0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19)";
        } else {
            menuItem.classList.remove("active");
            submenu.style.display = "none"; // Ocultar el submenú
        }

        // Manejar clics en el enlace principal del menú
        menuItem.querySelector("a").addEventListener("click", function() {
            const currentlyExpanded = menuItem.classList.contains("active");

            if (currentlyExpanded) {
                menuItem.classList.remove("active");
                submenu.style.display = "none"; // Ocultar
                localStorage.setItem("menu-venta-planes-expanded", "false");
            } else {
                menuItem.classList.add("active");
                submenu.style.display = "block"; // Mostrar
                localStorage.setItem("menu-venta-planes-expanded", "true");
            }
        });
    });
</script>


