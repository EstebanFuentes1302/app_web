<?php
     session_start();
    $sesion=$_SESSION['usuario'];
    $cantidad = $_POST['cantidad'];
    $codigo = $_POST['codigo'];
    if($sesion!=null){
        include_once('../modelo/Articulo.php');
        $a = new Articulo;
        $result = $a -> verificarCantidad($codigo, $cantidad);
        if($result == true){
            echo json_encode('true');
        }else{
            echo json_encode('false');
        }
    }else{
        include_once('../vista/FrmMensaje.php');
        frmMensajeShow("<p class='p'>Acceso Denegado, no ha iniciado sesión<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php?r=value'>Inicio de sesión</a>");
        die();
    }

?>