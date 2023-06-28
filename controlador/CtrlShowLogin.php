<?php
    error_reporting(0);
    session_start();
    $sesion = $_SESSION['usuario'];
    if($sesion != null){
        include_once('CtrlShowMenuPrincipal.php');
    }else{
        include_once('../vista/FrmLogin.php');
        $frm = new FrmLogin;
        $frm -> frmLoginShow();
    }
        
?>