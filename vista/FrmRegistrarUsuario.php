<?php
    class FrmRegistrarUsuario
    {
        public function frmRegistrarUsuarioShow(){
            ?>
            <!doctype html>
            <html>
            <head>
            <meta charset="utf-8">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
            <title>Registrar Usuario</title>
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
                                    <?php
                                        include_once('../modelo/Usuario.php');
                                        $usuario = new Usuario;
                                        $cargo = $usuario->getCargo($_SESSION['usuario'])['cod_cargo'];
                                        if($cargo=='1'){
                                            ?>
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
                                                <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuCatalogo.php" class="nav-link text-white">Gestionar Catálogo</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowReporte.php" class="nav-link text-white">Reporte</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuInventario.php" class="nav-link text-white">Gestionar Inventario</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuUsuario.php" class="nav-link text-white active">Gestionar Usuario</a>
                                            </li>
                                        <?php
                                        }else{
                                        ?>
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
                                                    <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuCatalogo.php" class="nav-link text-white">Gestionar Catálogo</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowReporte.php" class="nav-link text-white">Reporte</a>
                                                </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-auto col-md-10 min-vh-100 justify-content-center m-5">
                                <p class="h1 mb-3">Registrar Usuario</p>
                                <div class="d-flex">
                                    <div class="div-Form">
                                        <form id="formRegistrarUsuario" method="post" >
                                            <div class="div-form-row">
                                                <div class="div-txt-form-row">
                                                    <span>Nombre</span>
                                                </div>
                                                <div class="div-input-form-row">
                                                    <input class="form-control" type="text" name="txtNombre" id="txtNombre">
                                                </div>
                                            </div>
                                            
                                            <p class="text-danger d-none" id="txtErrorNombre">El nombre del usuario debe contener al menos 2 caracteres</p>
                                            <div class="mt-2">
                                                <div class="div-txt-form-row">
                                                    <span class="txtForm">Apellido</span>
                                                </div>
                                                <div class="div-input-form-row">
                                                    <input class="form-control" type="text" name="txtApellido" id="txtApellido">
                                                </div>
                                            </div>
                                            <span class="text-danger d-none" id="txtErrorApellido">El nombre del usuario debe contener al menos 2 caracteres</span>
                                            
                                            <div>
                                                <div class="div-txt-form-row mt-2">
                                                    <span class="txtForm">DNI</span>
                                                </div>
                                                <div class="mb-1">
                                                    <input type="text" name="txtDNI" id="txtDNI" class="form-control">
                                                </div>
                                            </div>
                                            <span class="text-danger d-none" id="txtErrorDNI">El DNI debe contener 8 dígitos</span>

                                            <div class="mt-2">
                                                <div class="div-txt-form-row">
                                                    <span class="txtForm">Celular</span>
                                                </div>
                                                <div class="mb-1">
                                                    <input type="text" name="txtCelular" id="txtCelular" class="form-control">
                                                </div>
                                            </div>
                                            <span class="text-danger d-none" id="txtErrorCelular">El celular debe contener 9 dígitos y empezar por 9</span>

                                            <div class="mt-2">
                                                <div class="div-txt-form-row">
                                                    <span class="txtForm">Usuario</span>
                                                </div>
                                                <div class="div-input-form-row">
                                                    <input class="form-control" type="text" name="txtUsuario" id="txtUsuario" autocomplete="off">
                                                </div>
                                            </div>
                                            <span class="text-danger d-none" id="txtErrorUsuario">El usuario ingresado no es admitido</span>

                                            <div class="mt-2">
                                                <div class="div-txt-form-row">
                                                    <span class="txtForm">Contraseña</span>
                                                </div>
                                                <div class="div-input-form-row">
                                                    <input class="form-control" type="password" name="txtPassword" id="txtPassword" autocomplete="none">
                                                </div>
                                            </div>
                                            <p class="text-danger d-none mt-1" id="txtErrorPassword">La contrasña ingresada no es admitida</p>

                                            <div class="mt-2">
                                                <div class="div-txt-form-row">
                                                    <span class="txtForm">Código de Cargo</span>
                                                </div>
                                                <div class="mb-1">
                                                    <input class="form-control" type="text" name="txtCargo" id="txtCargo">
                                                </div>
                                                <span class="text-danger d-none" id="txtErrorCargo">El código de cargo debe ser un número</span>
                                            </div>
                                            
                                            <input class="mt-3 btn border btn-primary" type="submit" name="btnRegistrarUsuario" id="btnRegistrarUsuario" value="Registrar Usuario">
                                            <input class="mt-3 btn border" type="reset" name="btnLimpiar" id="btnLimpiar" value="Limpiar">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                

                <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script src="../js/validarDatosFormRegistrarUsuario.js"></script>
            </body>
            </html>

            <?php
        }
    }
?>


