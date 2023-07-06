<?php
    session_start();
    $sesion=$_SESSION['usuario'];
    
    if($sesion!=null){
            include_once('../modelo/Usuario.php');
            $codigo=$_POST['codigo'];
            if(isset($codigo)){
                $u = new Usuario;
                $usuario = $u -> buscarUsuario($codigo);
                if($usuario){
                    /*$json = array(
                        'codigo_pedido' => $pedido['codigo_pedido'],
                        'codigo_solicitante' => $pedido['codigo_solicitante'],
                        'estado' => $pedido['estado'],
                        'fecha_registro' => $pedido['fecha_pedido']
                    );*/
                    echo json_encode($usuario);
                }else{
                    echo json_encode("null");
                }
                      
            }else{
                  echo json_encode("null");
            }
    }else{
        include_once('../vista/FrmMensaje.php');
        frmMensajeShow("<p class='p'>Acceso Denegado, no ha iniciado sesión<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php'>Inicio de sesión</a>");
        die();
    }
