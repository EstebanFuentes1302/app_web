<?php
    $boton=$_POST['btnIngresar'];
    if(isset($boton)){
        include_once('../modelo/Usuario.php');
        $usuario = trim($_POST['txtUsuario']);
        $password = trim($_POST['txtPassword']);
        $con = mysqli_connect('localhost','root','','db_app_dw');
        $u = new Usuario;
        $result = $u -> validarUsuario($usuario, $password);
        if($result){
            session_start();
            $_SESSION['usuario'] = $usuario;
            include_once('../vista/FrmMenuPrincipal.php');
            $frm = new FrmMenuPrincipal;
            $frm -> frmMenuPrincipalShow();
        }else{
            include_once('../vista/FrmMensaje.php');
            $frm = new FrmMensaje;
            $frm -> frmMensajeShow("<p class='p'>Los datos ingresados no coinciden con una cuenta<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php'>Volver</a>");
            die();
        }
    }else{
       include_once('../vista/FrmMensaje.php');
        $frm = new FrmMensaje;
        $frm -> frmMensajeShow("<p class='p'>Acceso Denegado, no ha iniciado sesión<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php'>Inicio de sesión</a>");
        die();
    }
?>