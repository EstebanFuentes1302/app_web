<?php
    session_start();
    $sesion=$_SESSION['usuario'];
    $codigo = $_POST['codigo'];
    if($sesion!=null){
        if(isset($codigo)){
            include_once('../modelo/Registro_Pedido.php');
            include_once('../modelo/Articulo.php');
            include_once('../modelo/Devolucion.php');
            include_once('../modelo/Registro_Pedido_Detallado.php');
            $d = new Devolucion;
            $p = new Pedido;
            $a = new Articulo;
            $rel = new Registro_Pedido_Detallado;
            $dev = $p -> isDevuelto($codigo);
            if($dev == false){
                $fecha_devolucion = str_replace("/","-",$_POST['fecha_devolucion']);
                $detalles = $_POST['detalles'];
                
                $registrar = $d -> registrarDevolucion($codigo, $fecha_devolucion, $detalles);
                if($registrar){
                    $articulos = $rel -> getArticulosPedido($codigo);
                    if($articulos != null){
                        $ver = true;
                        
                        while($articulo = mysqli_fetch_assoc($articulos)){
                            $v = $a -> actualizarStock($articulo['cantidad'], $articulo['cod_producto']);
                            if($v == false){
                                $ver = false;
                            }
                        }
                        if($ver){
                            $devolver = $p -> devolverPedido($codigo);
                            if($devolver){
                                echo json_encode('true');
                            }else{
                                echo json_encode('false');
                            }
                        }else{
                            echo json_encode('false');
                        }
                    }else{
                        echo json_encode('false');
                    }
                }else{
                    echo json_encode('false');
                }
                   
            }else{
                echo json_encode('dev');
            }
        }else{
            include_once('../vista/FrmMensaje.php');
            frmMensajeShow("<p class='p'>No es el acceso correcto<p>","<a class='link-p'  href='../controlador/CtrlShowMenuDevolucion.php>Volver</a>");
            die();
        }
    }else{
        include_once('../vista/FrmMensaje.php');
        frmMensajeShow("Acceso Denegado, no ha iniciado sesión","<a href='../controlador/CtrlShowLogin.php?'>Inicio de sesión</a>");
        die();
    }
    
?>