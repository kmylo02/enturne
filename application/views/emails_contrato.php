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
            <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Cordial saludo<br><?= $nombre_contratado ?><br><br>Desea contrata al: <br>Conductor: <?= $conductor ?><br>Placa: <?= $placa ?><br><br>Para el siguiente transporte:<br>Trayecto: <?= $trayecto ?><br>Fecha Oferta: <?= $fecha ?><br>Flete Inicial: <?php
                setlocale(LC_MONETARY, 'es_CO');
                echo money_format('%.0n', $flete);
                ?><br>Peso: <?= $peso ?><br>Volumén: <?= $volumen ?>
                <br><br>Mensaje: <?= $mensaje ?>Equipo Enturne.<br><br>Si tiene cualquier duda, contactanos a las lineas <br> (571) 4968958  </h3><br> <a href="http://www.enturne.co">http://www.enturne.co</a><br><br><h5>
                <br><img style="border: 0;-ms-interpolation-mode: bicubic;display: block;Margin-left: auto;Margin-right: auto;max-width: 559px" src="<?= base_url('assets/img/firmaemail.png') ?>" alt="Firma" width="559" height="165"><br>
                <h5>AVISO LEGAL: La información transmitida a través de este correo electrónico es confidencial y dirigida única y exclusivamente para uso de su(s) destinatario(s). Su reproducción, lectura o uso está prohibido a cualquier persona o entidad diferente, sin autorización previa por escrito. Si usted lo ha recibido por error, por favor notifíquelo inmediatamente al remitente y elimínelo de su sistema. Cualquier uso, divulgación, copia, distribución, impresión o acto derivado del conocimiento total o parcial de este mensaje sin autorización del remitente será sancionado de acuerdo con las normas legales vigentes.  El presente mensaje y sus archivos anexos se encuentran libre de virus y defectos que puedan llegar a afectar los computadores o sistemas que lo reciban, no se hace responsable por la eventual transmisión de virus o programas dañinos por este conducto, y por lo tanto es responsabilidad del destinatario confirmar la existencia de este tipo de elementos al momento de recibirlo y abrirlo.</h5>
        </div>
    </body>
</html>
