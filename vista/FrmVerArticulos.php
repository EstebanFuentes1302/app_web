<?php
class FrmVerArticulos
{
    public function frmVerArticulosShow($articulos){
    ?>
        <!doctype html>
        <html>
        <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <title>Ver Artículos</title>
        </head>
        <body>
            <div class="topPanel">
                <a class="back" href="../controlador/CtrlShowMenuArticulo.php?r=value">&lt; Ir Al Menú</a>
                <a class="logout" href="../controlador/CtrlLogout.php">Cerrar Sesión</a>
            </div>
            
        <h1 align="center">Artículos Registrados</h1>
        <div class="d-flex justify-content-center">
            <table class="table mx-4 bg-light" width="573">
                <tr>
                    <td class="txtHeader" width="82" height="27" align="center" valign="middle">Código</td>
                    <td class="txtHeader" width="131" align="center" valign="middle">Nombre</td>
                    <td class="txtHeader" width="67" align="center" valign="middle">Cantidad</td>
                    <td class="txtHeader" width="158" align="center" valign="middle">Fecha de Registro</td>
                </tr>
                <?php
                    while($array=mysqli_fetch_array($articulos)){
                ?>
                    <tr>
                        <td class="txtRow" height="35" align="center" valign="middle"><?php echo $array['cod_producto']?></td>
                        <td class="txtRow" align="center" valign="middle"><?php echo $array['nom_producto']?></td>
                        <td class="txtRow" align="center" valign="middle"><?php echo $array['cantidad_stock']?></td>
                        <td class="txtRow" align="center" valign="middle"><?php echo $array['descripcion']?></td>
              </tr>
                <?php                
                    }
                ?>
            </table>
        </div>
        </body>
        </html>
    <?php
    }
    
    public function frmVerArticulosPopUpShow($articulos){
    ?>
        <!doctype html>
        <html>
        <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <title>Ver Artículos</title>
        </head>
        <body>
        <h1 class="text-center mt-3">Artículos Registrados</h1>
        <div class="d-flex justify-content-center">
            <table class="table mx-4 bg-light" width="573">
                <tr>
                    <td class="txtHeader" width="82" height="27" align="center" valign="middle">Código</td>
                    <td class="txtHeader" width="131" align="center" valign="middle">Nombre</td>
                    <td class="txtHeader" width="67" align="center" valign="middle">Cantidad</td>
                    <td class="txtHeader" width="158" align="center" valign="middle">Fecha de Registro</td>
                </tr>
                <?php
                    while($array=mysqli_fetch_array($articulos)){
                ?>
                    <tr>
                        <td class="txtRow" height="35" align="center" valign="middle"><?php echo $array['cod_producto']?></td>
                        <td class="txtRow" align="center" valign="middle"><?php echo $array['nom_producto']?></td>
                        <td class="txtRow" align="center" valign="middle"><?php echo $array['cantidad_stock']?></td>
                        <td class="txtRow" align="center" valign="middle"><?php echo $array['descripcion']?></td>
              </tr>
                <?php                
                    }
                ?>
            </table>
        </div>
        </body>
        </html>
    <?php 
    }
}

?>

