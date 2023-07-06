<?php
    session_start();
    $sesion=$_SESSION['usuario'];

    if($sesion!=null){
        $articulos = $_POST['articulos'];
        $cod_cliente=$_POST['cod_solicitante'];
        $fecha = str_replace("/","-",$_POST['date']);
        $fechav = str_replace("/","-",$_POST['dateVencimiento']);
        if(isset($articulos) && isset($cod_cliente)){
            include_once('../modelo/Registro_Pedido.php');
            $p = new Pedido;
            $codigo_pedido = $p -> registrarPedido($cod_cliente, $fecha, $fechav);
            if($codigo_pedido != null){
                include_once('../modelo/Registro_Pedido_Detallado.php');
                $r = new Registro_Pedido_Detallado;
                $verif = true;
                $arr = json_decode($articulos);
                foreach($arr as $articulo){
                    $v = $r -> registrarRelPedidoArticulo($codigo_pedido, $articulo->cod_producto, $articulo->cantidad);
                    if($v == false){
                        $verif = false;
                    }
                }
                if($verif == true){
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
        include_once('../vista/FrmMensaje.php');
        $frm = new FrmMensaje;
        $frm -> frmMensajeShow("<p class='p'>Acceso Denegado, no ha iniciado sesión<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php?r=value'>Inicio de sesión</a>");
        die();
    }
    
    
?>