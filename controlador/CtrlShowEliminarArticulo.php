<?php
    session_start();
    $sesion=$_SESSION['usuario'];
    //$boton=$_POST['btnEliminarArticulo'];
    if($sesion!=null){
        include_once('../vista/FrmEliminarArticulo.php');
        $frm = new FrmEliminarArticulo;
        $frm -> frmEliminarArticuloShow();
    }else{
        include_once('../vista/FrmMensaje.php');
        $frm = new FrmMensaje;
        $frm -> frmMensajeShow("<p class='p'>Acceso Denegado, no ha iniciado sesión<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php?r=value'>Inicio de sesión</a>");
        die();
    }
?>