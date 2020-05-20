<?php
if (strlen(session_id())<1){
    session_start();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DSI Sistema de Inventarios</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="../public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../public/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../public/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../public/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
           <!-- Notifications Dropdown Menu -->
          <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                   <!-- <img src="../files/users/<?php /*echo ($_SESSION['imagen']); */?>" class="user-image" alt="User Image">-->
                    <img src ="../public/dist/img/avatar04.png" class="user-image" alt="user">
                    <span class="hidden-xs"><?php echo($_SESSION['nombre']);?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                       <!-- <img src="../files/users/<?php /*echo ($_SESSION['imagen']); */?>" class="img-circle" alt="User Image">-->
                        <img src ="../public/dist/img/avatar04.png" class="img-circle" alt="user">
                        <p><?php echo($_SESSION['nombre']);?></p>
                        <p>
                            DSI - Sistema de Inventarios
                            <small>desarrollo de soluciones Informaticas</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">

                        <div class="pull-right pt-2">
                            <a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat">Cerrar</a>
                        </div>
                    </li>
                </ul>
          </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-info elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="../public/dist/img/logodsi.png" alt="dsi" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light"> - Inventarios</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <?php
                        if ($_SESSION['escritorio']==1) {
                            echo('<li class="nav-item">
                                        <a href="escritorio.php" class="nav-link">
                                            <i class="fas fa-chart-bar"></i>
                                            <p>
                                                Escritorio
                                                <span class="right badge badge-danger">New</span>
                                            </p>
                                        </a>
                                    </li>    ');}


                    if ($_SESSION['alamcen']==1) {
                    echo(' <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-warehouse"></i>
                            <p>
                                Almacen
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="articulo.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Articulos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="categoria.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Categorias</p>
                                </a>
                            </li>
                        </ul>
                    </li>');}


                    if ($_SESSION['compras']==1) {
                    echo(' <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cash-register"></i>
                            <p>
                                Compras
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="articulo.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ingresos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="categoria.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Proveedores</p>
                                </a>
                            </li>
                        </ul>
                    </li>');}

                    if ($_SESSION['ventas']==1) {
                    echo(' <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cart-plus"></i>
                            <p>
                                Ventas
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="articulo.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ventas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="categoria.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Clientes</p>
                                </a>
                            </li>
                        </ul>
                    </li>');}
                    if ($_SESSION['acceso']==1) {
                    echo(' <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-key"></i>
                            <p>
                                Accesos
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="articulo.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permisos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="categoria.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Usuarios</p>
                                </a>
                            </li>
                        </ul>
                    </li>');}
                    if ($_SESSION['consultac']==1) {
                    echo(' <li class="nav-item">
                                        <a href="escritorio.php" class="nav-link">
                                            <i class="nav-icon fas fa-chart-pie"></i>
                                            <p>
                                                Consuta Compras                                             
                                            </p>
                                        </a>
                                    </li>    ');}
                    if ($_SESSION['consultav']==1) {
                    echo(' <li class="nav-item">
                                        <a href="escritorio.php" class="nav-link">
                                            <i class="nav-icon fas fa-chart-line"></i>
                                            <p>
                                                Consulta Ventas
                                            </p>
                                        </a>
                                    </li>    ');}


                    ?>
                    <li class="nav-item">
                        <a href="escritorio.php" class="nav-link">
                            <i class="nav-icon fas fa-stethoscope"></i>
                            <p>
                                Ayuda
                                <span class="right badge badge-danger">PDF</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="escritorio.php" class="nav-link">
                            <i class="nav-icon fas fa-code"></i>
                            <p>
                                Acerda De ...
                                <span class="right badge badge-info">IT</span>
                            </p>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

