<?php
    error_reporting(0);
    session_start();
    $sesion=$_SESSION['usuario'];
    $action = null;
    if(isset($_POST['action'])){
        $action = $_POST['action'];
    }else{
        $action = '';
    }
    
    if($sesion!=null){  
        include_once('../modelo/Usuario.php');
        include_once('../vista/FrmVerUsuarios.php');
        
        $u = new Usuario;
        $usuarios = $u -> getUsuarios();
        
        if($action == 'popup'){
            $frm = new FrmVerUsuarios;
            $frm -> frmVerUsuariosPopUpShow($usuarios);
            
        }else{
            $frm = new FrmVerUsuarios;
            $frm -> frmVerUsuariosShow($usuarios);
        }
    }else{
        include_once('../vista/FrmMensaje.php');
        $frm = new FrmMensaje;
        $frm -> frmMensajeShow("<p class='p'>Acceso Denegado, no ha iniciado sesión<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php?r=value'>Inicio de sesión</a>");
        die();
    }
    
    
?>  
