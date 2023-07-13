<?php
error_reporting(0);
class FrmVerPedidos
{
    public function frmVerPedidosShow($pedidos){
    ?>
        <!doctype html>
        <html>
        <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <title>Ver Pedidos</title>
        </head>
        <body onload="obtenerMesActual()">
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
                                                <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowReporte.php" class="nav-link text-white active">Reporte</a>
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
                                                    <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuCliente.php" class="nav-link text-white">Gestionar Cliente</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuDevolucion.php" class="nav-link text-white">Gestionar Devolución</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowMenuCatalogo.php" class="nav-link text-white">Gestionar Catálogo</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlShowReporte.php" class="nav-link text-white active">Reporte</a>
                                                </li>
                                        <?php
                                        }
                                        ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-auto col-md-10 min-vh-100 justify-content-center px-4 py-2">
                            
                            <h1 class="h1 mb-3 text-center">Reporte de Pedidos</h1>
                            <script>
                                function obtenerMesActual() {
                                    var fecha = new Date();
                                    var mes = fecha.getMonth();
                                    var mesesDelAño = [
                                        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                                        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
                                    ];
                                    var mesActual = mesesDelAño[mes];
                                    document.getElementById("mesActual").textContent = mesActual;
                                }
                            </script>
                            <div>
                                <p class="fs-5"><b>Mes: </b><span id="mesActual"></span></p>
                            </div>
                            
                            <button class="btn border btn-success mb-3" onclick="exportarExcel('xlsx','Reporte-Pedidos-Mes')">
                                Exportar Reporte
                            </button>
                            
                            <table class="table table-striped" id="tblReporte">
                                <tr>
                                    <td class="txtHeader" width="70px" align="center" valign="middle">Código de Pedido</td>
                                    <td class="txtHeader" width="90px" align="center" valign="middle">Código de Solicitante</td>
                                    <td class="txtHeader" width="150px" align="center" valign="middle">Nombre de Solicitante</td>
                                    <td class="txtHeader" width="80px" align="center" valign="middle">Estado</td>
                                    <td class="txtHeader" width="100px" align="center" valign="middle">Fecha de Registro</td>
                                    <td class="txtHeader" width="100px" align="center" valign="middle">Fecha de Vencimiento</td>
                                </tr>
                                <?php
                                    include_once('../modelo/Articulo.php');
                                    include_once('../modelo/Cliente.php');
                                    while($pedido = mysqli_fetch_array($pedidos)){
                                        $c = new Cliente;
                                        $cliente = $c -> buscarCliente($pedido['cod_cliente']);
                                        
                                ?>
                                    <tr>
                                        <td class="txtRow" height="35" align="center" valign="middle"><?php echo $pedido['cod_registro_pedido']?></td>
                                        <td class="txtRow" align="center" valign="middle"><?php echo $pedido['cod_cliente']?></td>
                                        <td class="txtRow" align="center" valign="middle"><?php echo $cliente['nom_cliente']." ".$cliente['ape_cliente']?></td>
                                        <td class="txtRow" align="center" valign="middle"><?php echo $pedido['estado_pedido']?></td>
                                        <td class="txtRow" align="center" valign="middle"><?php echo $pedido['fecha_inicio']?></td>
                                        <td class="txtRow" align="center" valign="middle"><?php echo $pedido['fecha_vencimiento']?></td>
                              </tr>
                                <?php                
                                    }
                                ?>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
            <script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>          
            <script src="../js/validarDatosFormReporte.js"></script>
        </body>
        </html>
    <?php
    }
}

?>

