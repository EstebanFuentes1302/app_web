<?php
    //include 'SingletonConexionDB.php';
    
    class Articulo
    {
        public function registrarArticulo($nombre, $cantidad, $fecha){
        
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            //$con = conectar();
            $sql = "insert into articulo(nombre,cantidad_stock,descripcion) values ('$nombre',$cantidad,'$desripcion')";
            $query = mysqli_query($con, $sql);
            if($query){
                return(true);
            }else{
                return(false);
            }
        }

        public function isUsedArticulo($codigo){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql = "select * from registro_pedido where cod_producto='$codigo'";
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

        public function modificarArticulo($codigo,$nombre,$cantidad,$fecha){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            //$sql="update Articulo set nombre='$nombre',cantidad=$cantidad,fecha_registro='$fecha' where codigo='$codigo'";
            $sql="update producto set nom_producto='$nombre',cantidad_stock=$cantidad where cod_producto='$codigo'";
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
            $sql = "select cantidad from articulo where codigo='$codigo'";
            $query = mysqli_query($con, $sql);
            if(mysqli_num_rows($query) > 0){
                $articulo = mysqli_fetch_assoc($query);
                $oldcantidad = $articulo['cantidad'];
                $newcantidad = $cantidad + $oldcantidad;
                $sql2 = "update articulo set cantidad=$newcantidad where codigo='$codigo'";
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
