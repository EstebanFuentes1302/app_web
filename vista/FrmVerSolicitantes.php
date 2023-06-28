<?php
    class FrmVerSolicitantes
    {
        public function frmVerSolicitantesShow($clientes){
        ?>
            <!doctype html>
            <html>
            <head>
            <meta charset="utf-8">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
            <title>Solicitantes</title>
            </head>
            <body>
            <h1 align="center">Solicitantes Registrados</h1>
                <div class="div-ver">
                    <table class="table table-striped">
                        <tr>
                            <td class="txtHeader" width="116" height="27" align="center" valign="middle">Código</td>
                            <td class="txtHeader" width="169" align="center" valign="middle">Nombre</td>
                            <td class="txtHeader" width="169" align="center" valign="middle">Apellido</td>
                            <td class="txtHeader" width="159" align="center" valign="middle">DNI</td>
                            <td class="txtHeader" width="138" align="center" valign="middle">Direccion</td>
                            <td class="txtHeader" width="138" align="center" valign="middle">Escuela Profesional</td>
                            <td class="txtHeader" width="138" align="center" valign="middle">Telefono</td>
                            <td class="txtHeader" width="138" align="center" valign="middle">Estado</td>
                        </tr>
                        <?php
                            while($array=mysqli_fetch_array($clientes)){
                        ?>
                            <tr>
                                <td class="txtRow" height="60" align="center" valign="middle"><?php echo $array['cod_cliente']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['nom_cliente']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['ape_cliente']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['dni']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['direccion']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['escuela_profesional']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['celular']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['estado_cliente']?></td>
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
        
        public function frmVerSolicitantesPopUpShow($clientes){
        ?>
            <!doctype html>
            <html>
            <head>
            <meta charset="utf-8">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
            <title>Clientes Registrados</title>
            </head>
            <body>
            <h1 align="center">Clientes Registrados</h1>
                <div class="d-flex justify-content-center mx-auto">
                <table class="mx-3 table table-striped">
                        <tr>
                            <td class="txtHeader" width="116" height="27" align="center" valign="middle">Código</td>
                            <td class="txtHeader" width="169" align="center" valign="middle">Nombre</td>
                            <td class="txtHeader" width="169" align="center" valign="middle">Apellido</td>
                            <td class="txtHeader" width="159" align="center" valign="middle">DNI</td>
                            <td class="txtHeader" width="138" align="center" valign="middle">Direccion</td>
                            <td class="txtHeader" width="138" align="center" valign="middle">Escuela Profesional</td>
                            <td class="txtHeader" width="138" align="center" valign="middle">Telefono</td>
                            <td class="txtHeader" width="138" align="center" valign="middle">Estado</td>
                        </tr>
                        <?php
                            while($array=mysqli_fetch_array($clientes)){
                        ?>
                            <tr>
                                <td class="txtRow" height="60" align="center" valign="middle"><?php echo $array['cod_cliente']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['nom_cliente']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['ape_cliente']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['dni']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['direccion']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['escuela_profesional']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['celular']?></td>
                                <td class="txtRow" align="center" valign="middle"><?php echo $array['estado_cliente']?></td>
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

