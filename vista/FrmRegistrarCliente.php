<?php
class FrmRegistrarSolicitante
{
    public function frmRegistrarSolicitanteShow(){
        ?>
        <!doctype html>
        <html>
        <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <title>Registrar Cliente</title>
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
                                                    <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuCliente.php" class="nav-link text-white active">Gestionar Cliente</a>
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
                                                    <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuUsuario.php" class="nav-link text-white">Gestionar Usuario</a>
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
                                                        <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuCliente.php" class="nav-link text-white active">Gestionar Cliente</a>
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
                        <p class="h1 mb-3">Registro de Clientes</p>
                        <div class="d-flex">
                            <form method="post" id="formRegistrarSolicitante" enctype="multipart/form-data">
                                <div class="div-Form">
                                    <div>
                                        <div>
                                            <p class="mb-1">Nombre</p>
                                        </div>
                                        <div class="d-flex">
                                            <div class="mt-1">
                                                <input class="form-control" type="text" name="txtNombreSolicitante" id="txtNombreSolicitante">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0">
                                        <span class="text-danger d-none " id="txtErrorNombre">El nombre del solicitante debe contener al menos 2 dígitos</span>
                                    </div>
                                    
                                    <div>
                                        <div class="mt-2">
                                            <p class="p mb-2">Apellido</p>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <input class="form-control" type="text" name="txtApellidoSolicitante" id="txtApellidoSolicitante">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0">
                                        <span class="text-danger d-none" id="txtErrorApellido">El apellido del solicitante debe contener al menos 2 dígitos</span>
                                    </div>
                                    
                                    <div class="mt-2">
                                        <div>
                                            <p class="m-0">DNI</p>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <input class="form-control mt-1" type="text" name="txtDNI" id="txtDNI">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger d-none" id="txtErrorDNI">El DNI tiene que contener 8 dígitos numéricos</span>
                                    <div class="mt-2">
                                        <div>
                                            <p class="m-0">Direción</p>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <input class="form-control" type="text" name="txtDireccion" id="txtDireccion">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger d-none" id="txtErrorDireccion">La dirección es incorrecta</span>
                                    <div class="mt-2">
                                        <div>
                                            <p class="m-0">Escuela Profesional</p>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <input class="form-control" type="text" name="txtEscuela" id="txtEscuela">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger d-none" id="txtErrorEscuela">El formato es incorrecto</span>
                                    <div class="mt-2">
                                        <div>
                                            <p class="m-0">Teléfono</p>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <input class="form-control" type="text" name="txtTelefono" id="txtTelefono">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger d-none" id="txtErrorTelefono">El número de teléfono debe contener 9 dígitos y empezar con 9</span>

                                    <div class="mt-2">
                                        <div>
                                            <p class="m-0">Estado</p>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <select id="sEstadoCliente" class="form-select">
                                                    <option value="Ejecución">Activo</option>
                                                    <option value="Devuelto">Suspendido</option>
                                                    <option value="Devuelto">Deudor</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input class="btn border btn-primary mt-3" type="submit" name="btnRegistrarSolicitante" id="btnRegistrarSolicitante" value="Registrar Solicitante">
                                    <input class="mt-3 btn border" type="reset" name="btnLimpiar" id="btnLimpiar" value="Limpiar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="../js/validarDatosFormRegistrarSolicitante.js"></script>
        </body>
        </html>
        <?php
    }
}
    
?>


