<?php
    
    class Devolucion{
        
        public function registrarDevolucion($codigo_pedido, $fecha_devolucion, $detalles){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql="insert into registro_devolucion(cod_registro_pedido,fecha_devolucion,detalles) values ('$codigo_pedido','$fecha_devolucion','$detalles')";
            $query=mysqli_query($con,$sql);

            if($query){
                return(true);
            }else{
                return(false);
            }
        }

        public function getDevoluciones(){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql = "select * from devolucion";
            $result = mysqli_query($con, $sql);

            return($result);
        }
    }
    

?>