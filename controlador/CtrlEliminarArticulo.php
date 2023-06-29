<?php
    session_start();
    $sesion=$_SESSION['usuario'];
    if($sesion!=null){
        $codigo=$_POST['codigo'];
        if(isset($codigo)){
            include_once('../modelo/Articulo.php');
            $a = new Articulo;
            $isused = $a -> isUsedArticulo($codigo);
            if(!$isused){
                $result = $a -> eliminarArticulo($codigo);
                if($result){
                    echo json_encode('true');
                }else{
                    echo json_encode('false');
                }
            }else{
                echo json_encode('used');
            }
        }else{
            include_once('../vista/FrmMensaje.php');
            frmMensajeShow("<p class='p'>No es el acceso correcto<p>","<a class='link-p'  href='../controlador/CtrlShowMenuArticulo.php>Volver</a>");
            die();
        }
    }else{
        include_once('../vista/FrmMensaje.php');
        frmMensajeShow("<p class='p'>Acceso Denegado, no ha iniciado sesión<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php'>Inicio de sesión</a>");
        die();
    }

    
?>