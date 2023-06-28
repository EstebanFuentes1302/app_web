<?php
    class FrmMensaje
    {
        public function frmMensajeShow($mensaje, $enlace){
            ?>
            <!doctype html>
            <html>
            <head>
            <meta charset="utf-8">
                <link rel="stylesheet" href="../css/style.css">
            <title>Mensaje</title>
            </head>
            <body>
            <table class="tblMensaje">
              <tbody>
                <tr align="center" valign="middle">
                  <td width="318" class="headerMensaje">Mensaje</td>
                </tr>
                <tr>
                  <td align="center" valign="middle"><?php echo $mensaje?></td>
                </tr>
                <tr>
                    <td align="center" valign="middle"><?php echo $enlace?></td>
                </tr>
              </tbody>
            </table>
            </body>
            </html>
            <?php
        }    
    }
    
?>