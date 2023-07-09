<?php
    class FrmRegistrarArticulo
    {
        public function frmRegistrarArticuloShow(){
            ?>
            <!doctype html>
            <html>
            <head>
            <meta charset="utf-8">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
            <title>Registrar Artículo</title>
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
                        <div class="row flex-nowrap">
                            <div class="bg-dark col-auto col-md-2 min-vh-100">
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
                                            <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuCatalogo.php" class="nav-link text-white active">Gestionar Catálogo</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowReporte.php" class="nav-link text-white">Reporte</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuInventario.php" class="nav-link text-white">Gestionar Inventario</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuUsuario.php" class="nav-link text-white">Gestionar Usuario</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-auto col-md-10 min-vh-100 justify-content-center m-5">
                                <p class="h1 mb-3">Registrar Artículo</p>
                                <div class="d-flex">
                                    <div class="div-Form">
                                        <form id="formRegistrarArticulo" method="post">
                                            <div>
                                                <div class="d-flex">
                                                    <span>Nombre de artículo</span>
                                                </div>
                                                <div class="d-flex">
                                                    <div>
                                                        <input class="form-control" type="text" name="txtNombreArticulo" id="txtNombreArticulo">
                                                    </div>
                                                </div>
                                                <p class="text-danger d-none mt-1 mb-2" id="txtErrorNombre">El nombre del artículo debe contener al menos 2 dígitos</p>
                                            </div>
                                            
                                            <!-- <p class="txtError" id="txtErrorNombreLength">La cantidad máxima de caracteres es de 50</p> -->
                                            <div class="mt-2">
                                                <div class="div-txt-form-row">
                                                    <span>Cantidad en Stock</span>
                                                </div>
                                                <div class="d-flex">
                                                    <div>
                                                        <input class="form-control" type="text" name="txtCantidad" id="txtCantidad">
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <p class="text-danger d-none mt-1 mb-2" id="txtErrorCantidad">La cantidad debe ser un número entero</p>
                                            <div class="mt-2">
                                                <div class="div-txt-form-row">
                                                    <span class="txtForm">Descripción</span>
                                                </div>
                                                <div class="d-flex">
                                                    <div>
                                                        <textarea class="form-control" id="txtaDescripcion"></textarea>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <input class="mt-3 btn border btn-primary" type="submit" name="btnRegistrarArticulo" id="btnRegistrarArticulo" value="Registrar Articulo">
                                            <input class="mt-3 ms-2 btn border" type="reset" name="btnLimpiar" id="btnLimpiar" value="Limpiar">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                

                <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script src="../js/validarDatosFormRegistrarArticulo.js"></script>
            </body>
            </html>

            <?php
        }
    }
?>


