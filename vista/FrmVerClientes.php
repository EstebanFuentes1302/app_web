<?php
    class FrmVerClientes
    {
        public function frmVerClientesShow($clientes){
        ?>
            <!doctype html>
            <html>
            <head>
            <meta charset="utf-8">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
            <title>Clientes</title>
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
                                </ul>
                            </div>
                        </div>
                            <div class="col-auto col-md-10 min-vh-100 justify-content-center">
                                <p class="h1 text-center mb-3">Registro de Clientes</p>
                                <div class="d-flex justify-content-center mx-auto">
                                    <div >
                                        <table class="table table-striped">
                                            <tr>
                                            <td class="txtHeader" width="116" height="27" align="center" valign="middle">Código</td>
                                                <td class="txtHeader" width="169" align="center" valign="middle">Nombre</td>
                                                <td class="txtHeader" width="159" align="center" valign="middle">Apellido</td>
                                                <td class="txtHeader" width="138" align="center" valign="middle">DNI</td>
                                                <td class="txtHeader" width="151" align="center" valign="middle">Dirección</td>
                                                <td class="txtHeader" width="151" align="center" valign="middle">Escuela</td>
                                                <td class="txtHeader" width="151" align="center" valign="middle">Celular</td>
                                                <td class="txtHeader" width="151" align="center" valign="middle">Estado</td>
                                            </tr>
                                            <?php
                                                while($array=mysqli_fetch_array($clientes)){
                                            ?>
                                                <tr>
                                                    <td class="txtRow" height="60" align="center" valign="middle"><?php echo $array['cod_cliente']?></td>
                                                    <td class="txtRow" align="center" valign="middle"><?php echo $array['nom_cliente']?></td>
                                                    <td class="txtRow" align="center" valign="middle"><?php echo $array['ape_cliente']?></td>
                                                    <td class="txtRow" align="center" valign="middle"><?php echo $array['dni']?></td>
                                                    <td class="txtRow" align="center" valign="middle"><?php echo $array['direccion']?></td>
                                                    <td class="txtRow" align="center" valign="middle"><?php echo $array['escuela_profesional']?></td>
                                                    <td class="txtRow" align="center" valign="middle"><?php echo $array['celular']?></td>
                                                    <td class="txtRow" align="center" valign="middle"><?php echo $array['estado_cliente']?></td>
                                                </tr>
                                            <?php                
                                                }
                                            ?>
                                        </table>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </body>
            </html>
        <?php
        }
        
        public function frmVerClientesPopUpShow($clientes){
        ?>
            <!doctype html>
            <html>
            <head>
            <meta charset="utf-8">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
            <title>Solicitantes Registrados</title>
            </head>
            <body>
                
                <h1 class="text-center h1 my-3">Clientes Registrados</h1>
                <div class="d-flex justify-content-center">
                    <table class="table table-striped mx-3">
                        <tr>
                        <td class="txtHeader" width="116" height="27" align="center" valign="middle">Código</td>
                            <td class="txtHeader" width="169" align="center" valign="middle">Nombre</td>
                            <td class="txtHeader" width="159" align="center" valign="middle">Apellido</td>
                            <td class="txtHeader" width="138" align="center" valign="middle">DNI</td>
                            <td class="txtHeader" width="151" align="center" valign="middle">Dirección</td>
                            <td class="txtHeader" width="151" align="center" valign="middle">Escuela</td>
                            <td class="txtHeader" width="151" align="center" valign="middle">Celular</td>
                            <td class="txtHeader" width="151" align="center" valign="middle">Estado</td>
                        </tr>
                        <?php
                            while($array=mysqli_fetch_array($clientes)){
                        ?>
                            <tr>
                                <td class="txtRow" height="60" align="center" valign="middle"><?php echo $array['cod_cliente']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['nom_cliente']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['ape_cliente']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['dni']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['direccion']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['escuela_profesional']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['celular']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['estado_cliente']?></td>
                            </tr>
                        <?php                
                            }
                        ?>
                    </table>    
                </div>
            </body>
            </html>
        <?php
        }
    }
?>

