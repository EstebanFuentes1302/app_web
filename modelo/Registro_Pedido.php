
<?php    
    class Pedido
    {
        public function registrarPedido($cod_cliente, $fecha, $fechaVencimiento){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $code = $this -> getAutoIncrement();
            $sql = "insert into registro_pedido(cod_cliente,estado_pedido,fecha_inicio,fecha_vencimiento) values('$cod_cliente','Ejecución','$fecha','$fechaVencimiento')";
            $query = mysqli_query($con, $sql);
            if($query){
                return($code);
            }else{
                return(false);
            }  
        }

        public function buscarPedido($codigo){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql = "select * from registro_pedido where cod_registro_pedido='$codigo'";
            $result = mysqli_query($con,$sql);
            if(mysqli_num_rows($result) > 0){
                return(mysqli_fetch_array($result));
            }else{
                return(null);
            }
        }

        public function modificarPedido($codigo, $estado, $fechav){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql = "update registro_pedido set estado_pedido='$estado', fecha_vencimiento='$fechav' where cod_registro_pedido='$codigo'";
            $result = mysqli_query($con, $sql);
            if($result){
                return(true); 
            }else{
                return(false);
            }
                     
        }

        public function isDevuelto($codigo){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql = "select * from registro_pedido where cod_registro_pedido = '$codigo' and estado_pedido = 'Devuelto'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0){
                return(false);
            }else{
                return(true);
            }
        }

        public function devolverPedido($codigo_pedido){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql = "update registro_pedido set estado_pedido='Devuelto' where cod_registro_pedido='$codigo_pedido'";
            $query = mysqli_query($con, $sql);
            if($query){
                return(true);
            }else{
                return(false);
            }
        }

        public function eliminarPedido($codigo,$codigo_articulo,$cantidad){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql="delete from registro_pedido where codigo_pedido='$codigo'";
            $query=mysqli_query($con,$sql);
            if($query){
                $sql2="select cantidad from Articulo where codigo='$codigo_articulo'";
                $query2=mysqli_query($con,$sql2);
                $result=mysqli_fetch_array($query2);
                if($result){
                    $newcantidad=$result['cantidad']+$cantidad;
                    $sql3="update Articulo set cantidad=$newcantidad where codigo='$codigo_articulo'";
                    $query3=mysqli_query($con,$sql3);
                    return(true);
                }else{
                    return(false);
                }
            }else{
                return(false);
            }
        }

        public function getPedidos(){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql = "select * from registro_pedido";
            $result = mysqli_query($con,$sql);
            return($result);
        }

        public function getPedidosReporte(){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql = "SELECT * FROM registro_pedido WHERE fecha_inicio >= DATE_FORMAT(CURDATE(), '%Y-%m-01') AND fecha_inicio <= CURDATE();";
            $result = mysqli_query($con,$sql);
            return($result);
        }
        
        private function getAutoIncrement(){
            $auto = null;
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql = "select AUTO_INCREMENT from INFORMATION_SCHEMA.TABLES
            where TABLE_SCHEMA = 'db_app_dw' and TABLE_NAME = 'registro_pedido'";
            $result = mysqli_query($con, $sql);
            while($arr = mysqli_fetch_assoc($result)){
                $auto = $arr['AUTO_INCREMENT'];
            }
            return($auto);
        }
    }

?>