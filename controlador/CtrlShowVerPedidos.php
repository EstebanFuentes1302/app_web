<?php
    error_reporting(0);
    session_start();
    $sesion=$_SESSION['usuario'];
    $action = $_POST['action'];
    if(!isset($action)){
        $action = '';
    }
    
    if($sesion!=null){  
        include_once('../modelo/Registro_Pedido.php');
        include_once('../vista/FrmVerPedidos.php');
        
        $p = new Pedido;
        $pedidos = $p -> getPedidos();
        
        if($action == 'popup'){
            $frm = new FrmVerPedidos;
            $frm -> frmVerPedidosPopUpShow($pedidos);
        }else{
            $frm = new FrmVerPedidos;
            $frm -> frmVerPedidosShow($pedidos);
        }
    }else{
        include_once('../vista/FrmMensaje.php');
        $frm = new FrmMensaje;
        $frm -> frmMensajeShow("<p class='p'>Acceso Denegado, no ha iniciado sesión<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php?r=value'>Inicio de sesión</a>");
        die();
    }
    
    
?>  
