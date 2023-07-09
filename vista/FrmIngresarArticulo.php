<?php
    class FrmIngresarArticulo
    {
        public function frmIngresarArticuloShow(){
            ?>
            <!doctype html>
            <html>
            <head>
            <meta charset="utf-8">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
            <title>Ingresar Articulo</title>
            </head>

            <body>
                <div class="navbar navbar-expand-lg bg-dark navbar-dark">
                    <a class="navbar-brand ms-3" href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuPrincipal.php">ALMACÉN UNMSM - FACULTAD DE INGENIERÍA DE SISTEMAS E INFORMÁTICA</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <form class="d-flex ms-auto me-3" role="search">
                            <a class="btn btn-danger" href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlLogout.php">Cerrar Sesión</a>
                        </form>
                    </div>
                    
                    
                </div>
                <div class="d-flex bg-light">
                    <div class="ms-auto me-4 justify-contet-center">
                        <p class="p my-auto py-1 fw-bold">usuario: <?php echo $_SESSION['usuario']?></p>
                    </div>
                </div>
                    <div class="container-fluid">
                        <div class="row flex-nowrap col-12">
                            <div class="bg-dark col-md-2 col-auto min-vh-100">
                                <div class="bg-dark p-2">
                                    <a class="d-flex text-decoration-none align-items-center text-white">
                                        <i class="fs-5 fa fa-guage"></i><span class="fs-4 d-none d-sm-inline"></span>
                                    </a>
                                    <ul class="nav nav-pills flex-column mt-2">
                                        <li class="nav-item">
                                            <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuPedido.php" class="nav-link text-white">
                                                <i class="bi bi-box-fill"></i><span>Gestión de Pedidos</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuCliente.php" class="nav-link text-white">Gestionar Cliente</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuDevolucion.php" class="nav-link text-white">Gestionar Devolución</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuCatalogo.php" class="nav-link text-white ">Gestionar Catálogo</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowReporte.php" class="nav-link text-white">Reporte</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuInventario.php" class="nav-link text-white active">Gestionar Inventario</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuUsuario.php" class="nav-link text-white">Gestionar Usuario</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-auto min-vh-100 justify-content-center ps-5 pt-5 pe-0">
                                <div class="div-buscar">
                                    <h1 class="h2">Ingresar Artículo</h1>
                                    <form id="formBuscarArticulo" method="post" class="mt-3">
                                        <div class="d-flex">
                                            <div>
                                                <input class="form-control" name="txtCodigoBuscar" type="text" id="txtCodigoBuscar" placeholder="Código de Artículo">
                                            </div>
                                            <div class="ms-2">
                                                <button class="btn border" type="submit" name="btnBuscar" id="btnBuscar">
                                                    <img class="icon-buscar" src="../img/icons/lupa.png" style="height: 20px;">
                                                </button>
                                            </div>
                                            <div class="ms-1">
                                                <button type="button" class="btn border" name="btnVerArticulos" id="btnVerArticulos" title="Ver Artículos" onClick="verArticulos()">
                                                    <img class="icon-menu" src="../img/icons/tabla.png" style="height: 20px;"> Ver Articulos
                                                </button>
                                            </div>
                                            
                                        </div>
                                        
                                        <p class="text-danger d-none" id="txtErrorCodigo">El código de artículo debe contener un número entre 1001 y 9999</p>
                                    </form>
                                </div>
                                <form id="formIngresarArticulo">
                                    <div id="divForm" class="div-Form">
                
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                
                <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script src="../js/validarDatosformIngresarArticulo.js"></script>
            </body>
            </html>
        <?php
        }
    }
    
?>

