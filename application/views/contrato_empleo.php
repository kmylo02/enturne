<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Enturne S.A.S - Mail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div>
<div style="font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center" align="center" id="emb-email-header"></div>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Cordial saludo,</p> 
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"><br>Estimado Conductor: <?php echo $nombre?><br>Ha sido contratado por: <?php echo $contratante?><br>Para el vehiculo: <?php echo $placa?><br>Teléfono: <?php echo $telefono?><br>Celular: <?php echo $celular?><br><br>ENTURNE EN LINEA le informa que, a través de nuestra multiplataforma, le ha sido contratado ó asignado un vehiculo. Para continuar con el proceso y poderse enturnar, favor ingresar con su usuario y contraseña a través del siguiente enlace: <a href="https://app.logiservi.com/">https://app.logiservi.com/</a> ó a traves del aplicativo móvil, que puede descargar en Play Store.<br>Si desea soporte, favor contactarnos.<br>Gracias, por su valiosa colaboración prestada.<br><br>
<img style="border: 0;-ms-interpolation-mode: bicubic;display: block;Margin-left: auto;Margin-right: auto;max-width: 559px" src="<?php echo base_url('assets/img/firmaemail.png')?>" alt="Firma" width="559" height="165">
</p>
</div>
</body>
</html>

