<?php

    class Cliente
    {
        public function registrarCliente($nombre, $apellido, $dni, $direccion, $escuela_profesional, $celular, $estado){
            try{
                $con = mysqli_connect('localhost','root','','db_app_dw'); 
                
                $sql = "insert into cliente(nom_cliente,ape_cliente,dni,direccion,escuela_profesional,celular,estado_cliente) values('$nombre','$apellido','$dni','$direccion','$escuela_profesional','$celular','$estado')";
                $query = mysqli_query($con,$sql);

                if($query){
                    return(true);
                }else{
                    return(false);
                } 
            }catch(MySQLException $e){
                echo "error: $e";
            }
            mysqli_close($con);
        }

        public function isUsed($codigo){
            $con = $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql = "select * from registro_pedido where cod_cliente='$codigo'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) > 0){
                return(true);
            }else{
                return(false);
            }
        }

        public function buscarCliente($codigo){
            $con = $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql="select * from cliente where cod_cliente='$codigo'";
            $result=mysqli_query($con, $sql);
            if(mysqli_num_rows($result) > 0){
                return(mysqli_fetch_array($result));
            }else{
                return(null);
            }
        }
        
        public function getAutoIncrement(){
            $auto = null;
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql = "select AUTO_INCREMENT from INFORMATION_SCHEMA.TABLES
            where TABLE_SCHEMA = 'db_app_dw' and TABLE_NAME = 'cliente'";
            $result = mysqli_query($con, $sql);
            while($arr = mysqli_fetch_assoc($result)){
                $auto = $arr['AUTO_INCREMENT'];
            }
            return($auto);
        }
        
        public function modificarCliente($codigo, $nombre, $apellido, $dni, $direccion, $escuela, $celular, $estado){
            $con = $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql="update cliente set nom_cliente='$nombre',ape_cliente='$apellido',dni='$dni',direccion='$direccion',escuela_profesional='$escuela',celular='$celular',estado_cliente='$estado' where cod_cliente='$codigo'";
            //echo $sql."<br>";
            $query=mysqli_query($con,$sql);
            mysqli_close($con);
            if($query){
                return(true);
            }else{
                return(false);
            }

        }

        public function getClientes(){
            $con = $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql="select * from cliente";
            $result=mysqli_query($con,$sql);
            mysqli_close($con);
            return($result);
        }

        public function eliminarCliente($codigo){
            $con = $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql="delete from Cliente where codigo_solicitante='$codigo'";
            $query=mysqli_query($con,$sql);
            mysqli_close($con);
            if($query){
                return(true);
            }else{
                return(false);
            }

        }    
    }

    
?>