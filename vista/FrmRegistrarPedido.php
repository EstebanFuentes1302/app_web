<?php
    class FrmRegistrarPedido
    {
        public function frmRegistrarPedidoShow(){
            ?>
            <!doctype html>
            <html>
            <head>
            <meta charset="utf-8">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
            <title>Registrar Pedido</title>
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
                                            <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuPedido.php" class="nav-link text-white active">
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
                                            <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuUsuario.php" class="nav-link text-white">Gestionar Usuario</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-auto col-md-10 min-vh-100 justify-content-center m-3">
                                <p class="h1 text-center mb-3">Registrar Pedido</p>
                                    <form id="formRegistrarPedido" method="post">
                                        <div class="container">
                                            <div class="row py-3 bg-light">
                                                <div class="col-6 px-4 py-2">
                                                    <h1>Artículos</h1>
                                                    <div class="d-flex">
                                                        <span class="fs-6 mb-1">Código de articulo</span>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="div-input-form-row div-input-form-row-small">
                                                        <input class="form-control" type="text" name="txtCodigoArticulo" id="txtCodigoArticulo">
                                                        </div>
                                                        <button class="ms-3 btn border" type="button" name="btnBuscar" id="btnBuscar" onClick="buscarArticulo()">
                                                            <img class="icon-buscar" src="../img/icons/lupa.png" style="height: 20px;">
                                                        </button>
                                                    </div>
                                                    
                                                    <p class="d-none text-danger my-1" id="txtErrorCodigoArticulo">El código del artículo debe ser un número</p>
                                                    <div class="d-flex">
                                                        <span class="fs-6 mt-2 mb-1">Cantidad</span>
                                                    </div>
                                                    <div class="d-flex wrap">
                                                        <div>
                                                            <input class="form-control" type="text" name="txtCantidadArticulo" id="txtCantidadArticulo">
                                                        </div>
                                                        <button type="button" style="width: 140px;" class="btn border ms-3" name="btnVerArticulos" id="btnVerArticulos" title="Ver Artículos" onClick="verArticulos()">
                                                            <img class="icon-menu" src="../img/icons/tabla.png" style="height: 20px;"> Ver Articulos
                                                        </button>
                                                    </div>
                                                    <p class="d-none text-danger" id="txtErrorCantidad">La cantidad ingresada es incorrecta</p>
                                                    
                                                    <div id="divArticulo">
                                                        <table id="tblArticulos" class="table d-none mt-3">
                                                            <tbody id="tbodyArticulos">
                                                                <tr>
                                                                <th class="txtHeader">Código</th>
                                                                <th class="txtHeader">Nombre</th>
                                                                <th class="txtHeader">Cantidad</th>
                                                                <th class="txtHeader" width="150px">Descripción</th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-6 pt-2 px-3 pb-4">
                                                    <h1>Pedido</h1>
                                                    <div class="div-form-row">
                                                        <div class="div-txt-form-row">
                                                            <span class="txtForm">Código de cliente</span>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="div-input-form-row">
                                                                <input class="form-control" type="text" name="txtCodigoSolicitante" id="txtCodigoSolicitante">
                                                            </div>
                                                            <button class="ms-3 btn border" type="button" name="btnBuscar" id="btnBuscar" onClick="buscarSolicitante()">
                                                                <img src="../img/icons/lupa.png" style="height: 20px;">
                                                            </button>
                                                        </div>
                                                        
                                                    </div>
                                                    <p class="d-none text-danger mt-1 mb-0" id="txtErrorCodigoSolicitante">El código de solicitante debe ser un número</p>
                                                    <div class="div-form-row">
                                                        <button type="button" class="mt-2 btn border" name="btnVerArticulos" id="btnVerArticulos" title="Ver Clientes" onClick="verSolicitantes()">
                                                            <img class="icon-menu" src="../img/icons/tabla.png" style="height: 20px;"> Ver Clientes
                                                        </button>    
                                                    </div>
                                                    <div id="divSolicitante">
                                                        <table id="tblSolicitante" class="table mt-3 d-none">
                                                            <tbody id="tbodySolicitante">
                                                                <tr>
                                                                <th class="txtHeader">Código</th>
                                                                <th class="txtHeader">Nombre</th>
                                                                <th class="txtHeader">Apellido</th>
                                                                <th class="txtHeader">DNI</th>
                                                                <th class="txtHeader">Escuela</th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="mt-2">
                                                    <div class="div-form-row">
                                                        <div>
                                                            <span class="txtForm">Fecha de registro</span>
                                                        </div>
                                                        <div class="d-flex wrap">
                                                            <div>
                                                                <input class="form-control" type="date" name="date" id="date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="d-none text-danger" id="txtErrorFecha">La fecha de registro está incompleta</p>
                                                    <div class="mt-2">
                                                        <div>
                                                            <span class="txtForm">Fecha de Vencimiento</span>
                                                        </div>
                                                        <div class="d-flex wrap">
                                                            <div>
                                                                <input class="form-control" type="date" name="dateVencimiento" id="dateVencimiento">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="d-none text-danger" id="txtErrorFechaVencimiento">La fecha de vencimiento está incompleta</p>
                                                    

                                                </div>
                                            </div>
                                        </div>
                                        <div class="container mt-3">
                                            <div class="text-center">
                                              <input class="btn border btn-primary" type="submit" name="btnRegistrarPedido" id="btnRegistrarPedido" value="Registrar Pedido">
                                              <input class="btn border" type="reset" name="btnLimpiar" id="btnLimpiar" value="Limpiar">
                                            </div>
                                          </div>
                                          
                                    </form>    

                            </div>
                        </div>
                    </div>
                </div>

                
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script src="../js/validarDatosFormRegistrarPedido.js"></script>
            </body>
            </html>
            <?php
        }
    }
?>


