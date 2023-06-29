<?php
    session_start();
    $sesion=$_SESSION['usuario'];

    if($sesion!=null){
        include_once('../vista/FrmRegistrarArticulo.php');
        $frm = new FrmRegistrarArticulo;
        $frm -> frmRegistrarArticuloShow();
    }else{
        include_once('../vista/FrmMensaje.php');
        $frm = new FrmMensaje;
        $frm -> frmMensajeShow("<p class='p'>Acceso Denegado, no ha iniciado sesión<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php'>Inicio de sesión</a>");
        die();
    }
    
    
?>