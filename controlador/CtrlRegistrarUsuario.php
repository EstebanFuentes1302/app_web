<?php

    session_start();
    $sesion = $_SESSION['usuario'];
    
    if($sesion != null){
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $dni=$_POST['dni'];
        $celular=$_POST['celular'];  
        $usuario=$_POST['usuario'];
        $password=$_POST['password'];
        $cargo=$_POST['cargo'];
        if(isset($nombre, $apellido, $dni, $celular, $usuario, $password)){
            include_once('../modelo/Usuario.php');
            $u = new Usuario;
            $registrar = $u -> registrarUsuario($nombre, $apellido, $dni, $celular, $usuario, $password, $cargo);
            if($registrar){
                echo json_encode('true');
            }else{
                echo json_encode('false');
            }
        }else{
            include_once('../vista/FrmMensaje.php');
            frmMensajeShow("<p class='p'>No es el acceso correcto<p>","<a class='link-p'  href='../controlador/CtrlShowMenuArticulo.php>Volver</a>");
            die();
        }
    }else{
        include_once('../vista/FrmMensaje.php');
        $frm = new FrmMensaje;
        $frm -> frmMensajeShow("<p class='p'>Acceso Denegado, no ha iniciado sesión<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php?r=value'>Inicio de sesión</a>");
        die();
    }
    
    
?>