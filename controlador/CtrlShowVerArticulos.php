<?php
    session_start();
    $sesion = $_SESSION['usuario'];
    
    if(isset($_POST['action'])){
        $action = $_POST['action'];
    }else{
        $action = '';
    }

    if($sesion!=null){        
        include_once('../vista/FrmVerArticulos.php');
        include_once('../modelo/Articulo.php');
        $a = new Articulo;
        $articulos = $a -> getArticulos();
        $frm = new FrmVerArticulos;
        if($action == 'popup'){
            $frm -> frmVerArticulosPopUpShow($articulos);
        }else{
            $frm -> frmVerArticulosShow($articulos);
        }
    }else{
        include_once('../vista/FrmMensaje.php');
        $frm = new FrmMensaje;
        $frm -> frmMensajeShow("<p class='p'>Acceso Denegado, no ha iniciado sesión<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php?r=value'>Inicio de sesión</a>");
        die();
    }
    
    
?>  
