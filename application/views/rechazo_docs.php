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
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"><br>Estimado Usuario: <?= $nombre_empresa?><br>Documento Rechazado: <?= $ndoc?><br><?php if(isset($placa)){ echo "Placa-vehiculo:".$placa."<br>"; }?>Motivo: <?= $obsv?><br><br><br>ENTURNE EN LINEA le informa que el documento <?= $ndoc?>,
le ha sido rechazado en la multiplataforma. Para continuar con el proceso de creación de su cuenta y habilitar todas las herramientas que le brinda Enturne en Línea, favor ingresar con su usuario y contraseña a <a href="https://app.enturne.co/">https://app.enturne.co/</a>para reeemplazar el archivo con la observacion.<br><br>Si desea soporte, favor contactarnos.<br><br>Gracias, por su valiosa colaboración prestada.<br><br>
<img style="border: 0;-ms-interpolation-mode: bicubic;display: block;Margin-left: auto;Margin-right: auto;max-width: 559px" src="<?= base_url('assets/img/firmaemail.png')?>" alt="Firma" width="559" height="165">
</p>
</div>
</body>
</html>