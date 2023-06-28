<?php
    session_start();
    $sesion=$_SESSION['usuario'];
    
    if($sesion!=null){
            include_once('../modelo/Registro_Pedido.php');
            $codigo=$_POST['codigo'];
            if(isset($codigo)){
                $p = new Pedido;
                $dev = $p -> isDevuelto($codigo);
                if($dev == false){
                    $pedido = $p -> buscarPedido($codigo);
                    if($pedido){
                        /*$json = array(
                            'codigo_pedido' => $pedido['codigo_pedido'],
                            'codigo_solicitante' => $pedido['codigo_solicitante'],
                            'estado' => $pedido['estado'],
                            'fecha_registro' => $pedido['fecha_pedido']
                        );*/
                        echo json_encode($pedido);
                    }else{
                        echo json_encode("null");
                    }
                }else{
                    echo json_encode("dev");
                }
                      
            }else{
                  echo json_encode("null");
            }
    }else{
        include_once('../vista/FrmMensaje.php');
        frmMensajeShow("<p class='p'>Acceso Denegado, no ha iniciado sesión<p>","<a class='link-p' href='../controlador/CtrlShowLogin.php'>Inicio de sesión</a>");
        die();
    }
