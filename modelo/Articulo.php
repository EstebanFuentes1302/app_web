<?php
    //include 'SingletonConexionDB.php';
    
    class Articulo
    {
        public function registrarArticulo($nombre, $cantidad, $descripcion){
        
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            //$con = conectar();
            $sql = "insert into producto(nom_producto,cantidad_stock,descripcion) values ('$nombre',$cantidad,'$descripcion')";
            $query = mysqli_query($con, $sql);
            if($query){
                return(true);
            }else{
                return(false);
            }
        }

        public function isUsedArticulo($codigo){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql = "select * from registro_pedido_detallado where cod_producto='$codigo'";
            $result = mysqli_query($con, $sql);
            if($result){
                if(mysqli_num_rows($result) > 0){
                    return(true);
                }else{
                    return(false);
                }
            }else{
                return(false);
            }
        }

        public function ingresarArticulo($codigo, $cantidad){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql = "select cantidad_stock from producto where cod_producto='$codigo'";
            $r = mysqli_query($con, $sql);
            $cant = mysqli_fetch_array($r)['cantidad_stock'];
            $newcantidad = $cant + $cantidad;

            $sql = "update producto set cantidad_stock=$newcantidad where cod_producto='$codigo'";
            $result = mysqli_query($con, $sql);
            if($result){
                return(true);
            }else{
                return(false);
            }
        }

        public function retirarArticulo($codigo, $cantidad){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql = "select cantidad_stock from producto where cod_producto='$codigo'";
            $r = mysqli_query($con, $sql);
            $cant = mysqli_fetch_array($r)['cantidad_stock'];
            if($cant < $cantidad){
                return(false);
            }else{
                $newcantidad = $cant - $cantidad;
                $sql = "update producto set cantidad_stock=$newcantidad where cod_producto='$codigo'";
                $result = mysqli_query($con, $sql);
                if($result){
                    return(true);
                }else{
                    return(false);
                }
            }
            

            
        }

        public function getArticulos(){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql="select * from producto";
            $result=mysqli_query($con,$sql);
            return($result);
        }

        public function buscarArticulo($codigo){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql="select * from producto where cod_producto='$codigo'";
            $result=mysqli_query($con,$sql);

            if(mysqli_num_rows($result)>0){
                return(mysqli_fetch_array($result));
            }else{
                return(null);
            }
        }

        public function modificarArticulo($codigo,$nombre,$cantidad,$descripcion){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            //$sql="update Articulo set nombre='$nombre',cantidad=$cantidad,fecha_registro='$fecha' where codigo='$codigo'";
            $sql="update producto set nom_producto='$nombre',cantidad_stock=$cantidad,descripcion='$descripcion' where cod_producto=$codigo";
            //echo $sql."<br>";
            $query=mysqli_query($con,$sql);
            if($query){
                return(true);
            }else{
                return(false);
            }
        }

        public function eliminarArticulo($codigo){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql="delete from producto where cod_producto='$codigo'";
            $query=mysqli_query($con,$sql);
            if($query){
                return(true);
            }else{
                return(false);
            }
        }
        
        public function verificarCantidad($codigo, $cantidad){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql = "select cantidad_stock from producto where cod_producto='$codigo'";
            $result = mysqli_query($con, $sql);
            
            if(mysqli_num_rows($result) > 0){
                $arr = mysqli_fetch_assoc($result);
                $oldcantidad = $arr['cantidad_stock'];
                if($cantidad <= $oldcantidad){
                    return(true);
                }else{
                    return(false);
                }
            }else{
                return(false);
            }
        }
        
        public function actualizarStock($cantidad, $codigo){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql = "select cantidad_stock from producto where cod_producto='$codigo'";
            $query = mysqli_query($con, $sql);
            if(mysqli_num_rows($query) > 0){
                $articulo = mysqli_fetch_assoc($query);
                $oldcantidad = $articulo['cantidad_stock'];
                $newcantidad = $cantidad + $oldcantidad;
                $sql2 = "update producto set cantidad_stock=$newcantidad where cod_producto='$codigo'";
                $query2 = mysqli_query($con, $sql2);
                if($query2){
                    return(true);
                }else{
                    return(false);
                }
            }else{
                return(false);
            }
        }
    }
?>
