<?php
    session_start();
    $sesion=$_SESSION['usuario'];
    $codigo=$_POST['codigo'];
    if($sesion!=null){
        if(isset($codigo)){
            include_once('../modelo/Cliente.php');
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $dni = $_POST['dni'];
            $direccion = $_POST['direccion'];
            $escuela = $_POST['escuela'];
            $celular = $_POST['celular'];
            $estado = $_POST['estado'];

            $c = new Cliente;
            $result = $c -> modificarCliente($codigo, $nombre, $apellido, $dni, $direccion, $escuela, $celular, $estado);
            if($result){
                echo json_encode("true");
            }else{
                echo json_encode("false");
            }
        }else{
            $frm = new FrmMensaje;
            $frm -> frmMensajeShow("<p class='p'>Acceso Denegado, no ha iniciado sesión<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php?r=value'>Inicio de sesión</a>");
            die();
        }
    }else{
        $frm = new FrmMensaje;
        $frm -> frmMensajeShow("<p class='p'>Acceso Denegado, no ha iniciado sesión<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php?r=value'>Inicio de sesión</a>");
        die();
    }