<?php

    class Registro_Pedido_Detallado
    {
        public function registrarRelPedidoArticulo($codigo_pedido, $codigo_articulo, $cantidad){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            
            $sql = "select cantidad_stock from producto where cod_producto='$codigo_articulo'";
            $query = mysqli_query($con, $sql);
            if(mysqli_num_rows($query) > 0){
                $result = mysqli_fetch_array($query);
                $newcantidad = $result['cantidad_stock'] - $cantidad;
                
                $sql2 = "update producto set cantidad_stock=$newcantidad where cod_producto='$codigo_articulo'";
                $query2 = mysqli_query($con, $sql2);
                if($query2){
                    $sql3 = "insert into registro_pedido_detallado values ($codigo_articulo, $codigo_pedido, $cantidad)";
                    $query3 = mysqli_query($con, $sql3);
                    if($query3){
                        return(true);
                    }else{
                        return(false);
                    }
                }else{
                    return(false);
                }
            }else{
                return(false);
            }
        }
        
        public function getArticulosPedido($codigo_pedido){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql = "select * from registro_pedido_detallado where cod_registro_pedido='$codigo_pedido'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) > 0){
                return($result);
            }else{
                return(null);
            }
        }
    }
    
?>