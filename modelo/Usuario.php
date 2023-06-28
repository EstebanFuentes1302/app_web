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
        
    }
    
?>