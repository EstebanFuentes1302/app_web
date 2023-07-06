<?php
error_reporting(0);
class FrmVerUsuarios
{
    public function frmVerUsuariosShow($usuarios){
    ?>
        <!doctype html>
        <html>
        <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <title>Ver Pedidos</title>
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
                                        <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuPedido.php" class="nav-link text-white ">
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
                                </ul>
                            </div>
                        </div>
                        <div class="col-auto col-md-10 min-vh-100 justify-content-center px-4 py-2">
                            <h1 class="h1 mb-3 text-center">Usuarios Registrados</h1>
                            <div class="container-fluid">
                            <div class="min-vh-100 justify-content-center px-4 py-2">
                                <table class="table table-striped">
                                    <tr>
                                        <td class="txtHeader" width="70px" align="center" valign="middle">Código de Usuario</td>
                                        <td class="txtHeader" width="90px" align="center" valign="middle">Nombre</td>
                                        <td class="txtHeader" width="150px" align="center" valign="middle">DNI</td>
                                        <td class="txtHeader" width="80px" align="center" valign="middle">Celular</td>
                                        <td class="txtHeader" width="100px" align="center" valign="middle">Nombre de Usuario</td>
                                    </tr>
                                    <?php
                                        include_once('../modelo/Articulo.php');
                                        include_once('../modelo/Cliente.php');
                                        while($usuario = mysqli_fetch_array($usuarios)){
                                            
                                    ?>
                                        <tr>
                                            <td class="txtRow" height="35" align="center" valign="middle"><?php echo $usuario['cod_trabajador']?></td>
                                            <td class="txtRow" align="center" valign="middle"><?php echo $usuario['nombre_trabajador']." ".$usuario['apellido_trabajador']?></td>
                                            <td class="txtRow" align="center" valign="middle"><?php echo $usuario['dni_trabajador']?></td>
                                            <td class="txtRow" align="center" valign="middle"><?php echo $usuario['celular_trabajador']?></td>
                                            <td class="txtRow" align="center" valign="middle"><?php echo $usuario['nombre_usuario']?></td>
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
                </div>
            </div>          
        </body>
        </html>
    <?php
    }
    
    public function frmVerUsuariosPopUpShow($usuarios){
    ?>
        <!doctype html>
        <html>
        <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <title>Ver Usuarios</title>
        </head>
        <body>

                <div class="container-fluid">
                        <div class="min-vh-100 justify-content-center px-4 py-2">
                            <h1 class="h1 mb-3 text-center">Usuarios Registrados</h1>
                            <table class="table table-striped">
                                <tr>
                                    <td class="txtHeader" width="70px" align="center" valign="middle">Código de Usuario</td>
                                    <td class="txtHeader" width="90px" align="center" valign="middle">Nombre</td>
                                    <td class="txtHeader" width="150px" align="center" valign="middle">DNI</td>
                                    <td class="txtHeader" width="80px" align="center" valign="middle">Celular</td>
                                    <td class="txtHeader" width="100px" align="center" valign="middle">Nombre de Usuario</td>
                                </tr>
                                <?php
                                    include_once('../modelo/Articulo.php');
                                    include_once('../modelo/Cliente.php');
                                    while($usuario = mysqli_fetch_array($usuarios)){
                                        
                                ?>
                                    <tr>
                                        <td class="txtRow" height="35" align="center" valign="middle"><?php echo $usuario['cod_trabajador']?></td>
                                        <td class="txtRow" align="center" valign="middle"><?php echo $usuario['nombre_trabajador']." ".$usuario['apellido_trabajador']?></td>
                                        <td class="txtRow" align="center" valign="middle"><?php echo $usuario['dni_trabajador']?></td>
                                        <td class="txtRow" align="center" valign="middle"><?php echo $usuario['celular_trabajador']?></td>
                                        <td class="txtRow" align="center" valign="middle"><?php echo $usuario['nombre_usuario']?></td>
                              </tr>
                                <?php                
                                    }
                                ?>
                            </table> 
                        </div>
                </div>
            </div>
        </body>
        </html>
    <?php
    }
}

?>

