<?php
    define('ROOTPATH', dirname(__FILE__));
    session_start();
    if(isset($_SESSION['usuario'])){
        include_once('vista/FrmMenuPrincipal.php');
        $frm = new FrmMenuPrincipal;
        $frm -> frmMenuPrincipalShow();
    }else{
        include_once('vista/FrmLogin.php');
        $frm = new FrmLogin;
        $frm -> frmLoginShow();
    }
?> 