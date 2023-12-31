<?php
    error_reporting(0);
    class FrmLogin
    {
        public function frmLoginShow(){
            ?>
            <!doctype html>
            <html>
            <head>
            <meta charset="utf-8">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
            <title>Gestión de Almacén</title>
            </head>

            <body class="bg-light">
                <form id="formIniciarSesion" method="post" action="<?php $_SERVER['DOCUMENT_ROOT']?>/app_web/controlador/CtrlValidarLogin.php" class="justify-content-center">
                    <h1 class="text-center my-4">Almacén - UNMSM</h1>
                    <div class="form-outline mb-1 mt-2 col-4 mx-auto">
                        <label class="form-label">Usuario</label>
                        <input type="text" id="form2Example1" class="form-control" name="txtUsuario" id="txtUsuario"/>
                        
                    </div>

                    <div class="form-outline mb-4 col-4 mx-auto">
                        <label class="form-label mt-2 mb-1" for="form2Example2">Contraseña</label>
                        <input type="password" id="form2Example2" class="form-control" name="txtPassword" id="txtPassword"/>
                        
                    </div>
                    <div class="d-flex justify-content-center">
                        <input type="submit" class="btn btn-dark mb-4 mx-auto" name="btnIngresar" id="btnIngresar" value="Ingresar">
                    </div>
                </form>
            </body>
            </html>
        <?php
        }    
    }
    
?>

