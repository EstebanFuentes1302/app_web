<?php
    session_start();
    $sesion=$_SESSION['usuario'];

    $codigo=$_POST['codigo'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $celular = $_POST['celular'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $cod_cargo = $_POST['cod_cargo'];

    if($sesion != null){
        if(isset($codigo, $nombre, $apellido, $celular, $usuario, $password, $cod_cargo)){
            include_once('../modelo/Usuario.php');
            $u = new Usuario;
            $result = $u -> modificarUsuario($codigo, $nombre, $apellido, $celular, $usuario, $password, $cod_cargo);
            if($result){
                echo json_encode('true');
            }else{
                echo json_encode('false');
            }
        }else{
            include_once('../vista/FrmMensaje.php');
            $frm = new FrmMensaje;
            $frm -> frmMensajeShow("<p class='p'>Acceso Denegado, no ha iniciado sesión<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php?r=value'>Inicio de sesión</a>");
            die();
        }
    }else{
        include_once('../vista/FrmMensaje.php');
        $frm = new FrmMensaje;
        $frm -> frmMensajeShow("<p class='p'>Acceso Denegado, no ha iniciado sesión<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php?r=value'>Inicio de sesión</a>");
        die();
    }
    
?>