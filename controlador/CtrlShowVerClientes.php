<?php
    session_start();
    error_reporting(0);
    $sesion=$_SESSION['usuario'];
    $action = $_POST['action'];
    
    if(!isset($action)){
        $action = '';
    }

    if($sesion!=null){
        include_once('../vista/FrmVerClientes.php');
        include_once('../modelo/Cliente.php');
        $c = new Cliente;
        $clientes = $c -> getClientes();
        
        if($action == 'popup'){
            $frm = new FrmVerClientes;
            $frm -> frmVerClientesPopUpShow($clientes);
        }else if($action == ''){
            $frm = new FrmVerClientes;
            $frm -> frmVerClientesShow($clientes);
        }
        
    }else{
        include_once('../vista/FrmMensaje.php');
        $frm = new FrmMensaje;
        $frm -> frmMensajeShow("<p class='p'>Acceso Denegado, no ha iniciado sesión<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php?r=value'>Inicio de sesión</a>");
        die();
    }
?>  
