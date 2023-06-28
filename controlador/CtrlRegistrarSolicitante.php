<?php
    session_start();
    $sesion=$_SESSION['usuario'];
    //error_reporting(0);
    if($sesion!=null){
        include_once('../modelo/Cliente.php');
        $c = new Cliente;
        $codigo = $c -> getAutoIncrement();
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dni = $_POST['dni'];
        $direccion = $_POST['direccion'];
        $escuela = $_POST['escuela'];
        $telefono = $_POST['telefono'];
        $estado = $_POST['estado'];
        
        if(isset($nombre) && isset($apellido) && isset($dni) && isset($direccion) && isset($escuela) && isset($telefono) && isset($estado)){
            $registrar = $c -> registrarCliente($nombre, $apellido, $dni, $direccion, $escuela, $telefono, $estado);
            if($registrar){
                echo json_encode('true');
            }else{
                echo json_encode('false');
            }

        }
        
    }else{
        include_once('../vista/FrmMensaje.php');
        frmMensajeShow("<p class='p'>Acceso Denegado, no ha iniciado sesión<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php?r=value'>Inicio de sesión</a>");
        die();
    }
    
    
?>