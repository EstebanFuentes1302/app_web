<?php

    class Usuario
    {
        public function validarUsuario($usuario, $password){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql = "select * from usuario where nombre_usuario='$usuario' and contrasena='$password'";
            $query = mysqli_query($con, $sql);
            if(mysqli_num_rows($query) > 0){
                return(true);
            }else{
                return(false);
            }
        }
        
        public function registrarUsuario($nombre, $apellido, $dni, $celular, $usuario, $password, $cargo){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            //$con = conectar();
            $sql = "insert into usuario(cod_cargo,nombre_trabajador,apellido_trabajador,dni_trabajador,celular_trabajador,nombre_usuario,contrasena) values ($cargo,'$nombre','$apellido','$dni','$celular','$usuario','$password')";
            $query = mysqli_query($con, $sql);
            if($query){
                return(true);
            }else{
                return(false);
            }
        }

        public function buscarUsuario($codigo){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql="select * from usuario where cod_trabajador='$codigo'";
            $result=mysqli_query($con,$sql);

            if(mysqli_num_rows($result)>0){
                return(mysqli_fetch_array($result));
            }else{
                return(null);
            }
        }

        public function modificarUsuario($codigo, $nombre, $apellido, $celular, $usuario, $password, $cod_cargo){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            //$con = conectar();
            $sql = "update usuario set cod_cargo=$cod_cargo,nombre_trabajador='$nombre',apellido_trabajador='$apellido',celular_trabajador='$celular',nombre_usuario='$usuario',contrasena='$password' where cod_trabajador=$codigo";
            $query = mysqli_query($con, $sql);
            if($query){
                return(true);
            }else{
                return(false);
            }
        }

        public function getUsuarios(){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql="select * from usuario";
            $result=mysqli_query($con,$sql);
            return($result);
        }

        public function eliminarUsuario($codigo){
            $con = mysqli_connect('localhost','root','','db_app_dw'); 
            $sql="delete from usuario where cod_trabajador='$codigo'";
            $query=mysqli_query($con,$sql);
            if($query){
                return(true);
            }else{
                return(false);
            }
        }

    }
    
?>