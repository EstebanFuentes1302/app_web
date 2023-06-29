<?php
    session_start();
    $sesion=$_SESSION['usuario'];
    
    if($sesion!=null){
        $codigo=$_POST['codigo'];
        $cantidad=$_POST['cantidad'];
        if(isset($codigo) && isset($cantidad)){
            include_once('../modelo/Articulo.php');
            $a = new Articulo;
            $result = $a -> ingresarArticulo($codigo, $cantidad);
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