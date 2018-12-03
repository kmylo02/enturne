<?php
$idv = $vehiculos->idVehiculo;
$idempresa = $vehiculos->idEmpresa;
$placa = $vehiculos->placa;
$capacidad = $vehiculos->capacidad_carga;
$urlfrontal = base_url('uploads/vehiculos') . '/' . $idv . '/' . $vehiculos->foto_frontal;
$urllateral = base_url('uploads/vehiculos') . '/' . $idv . '/' . $vehiculos->foto_latder;
$urltrasera = base_url('uploads/vehiculos') . '/' . $idv . '/' . $vehiculos->foto_latizq;
$marcav = $vehiculos->marcav;
$matricula = $vehiculos->nombre_ciudad;
$numsoat = $vehiculos->numsoat;
$numtecno = $vehiculos->numtecno;
$vencesoat = $vehiculos->vence_soat;
$vencetecno = $vehiculos->vence_rtecnomecanica;
$fv = $vehiculos->vencelic;
$fa = $vehiculos->created_at;
$tmarca = $vehiculos->trailermarca;
$trailer = $vehiculos->trailer;
$tmodelo = $vehiculos->modelo_trailer;
$tpesov = $vehiculos->peso_vacio_trailer;
$pesov = $vehiculos->peso_vacio;
$nomaseg = $vehiculos->nombre_aseguradora;
$modelo = $vehiculos->modelo;
if ($idempresa != NULL) {
    $sql = "select t1.*,t2.nombre_ciudad FROM Empresas t1"
            . " JOIN Ciudades t2 ON t1.idCiudad=t2.idCiudad"
            . " WHERE t1.idEmpresa='$idempresa'";
    $value = $this->db->query($sql)->row();
    $propietario = $value->nombre_empresa;
    $apeprop = '';
    $telprop = $value->telefono;
    $ciudadp = $value->nombre_ciudad;
    $direccion = $value->direccion;
    $cedula = $value->nit;
} else {
    $propietario = $vehiculos->nomprop;
    $apeprop = $vehiculos->apeprop;
    $telprop = $vehiculos->celp;
    $ciudadp = $vehiculos->ciudadp;
    $direccion = $vehiculos->dirp;
    $cedula = $vehiculos->cedp;
}
$urlsoat = base_url('uploads/vehiculos') . '/' . $idv . '/' . $vehiculos->soat;
$urlrtm = base_url('uploads/vehiculos') . '/' . $idv . '/' . $vehiculos->rtecnomecanica;
$urllict = base_url('uploads/vehiculos') . '/' . $idv . '/' . $vehiculos->licenciatransito;
$urlcedp = base_url('uploads/vehiculos') . '/' . $idv . '/' . $vehiculos->cedulapropietario;
$urlrutp = base_url('uploads/vehiculos') . '/' . $idv . '/' . $vehiculos->rutpropietario;
$urlremolque = base_url('uploads/vehiculos') . '/' . $idv . '/' . $vehiculos->remolque;
$docVehiculo = base_url('uploads/vehiculos') . '/' . $idv . '/' . $vehiculos->pdf;
$arrContextOptions = array(
    "ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
    ),
);
$type = pathinfo($urlsoat, PATHINFO_EXTENSION);
$soatData = file_get_contents($urlsoat, false, stream_context_create($arrContextOptions));
$soatBase64Data = base64_encode($soatData);
$fotosoat = 'data:image/' . $type . ';base64,' . $soatBase64Data;

$type1 = pathinfo($urlrtm, PATHINFO_EXTENSION);
$rtmData = file_get_contents($urlrtm, false, stream_context_create($arrContextOptions));
$rtmBase64Data = base64_encode($rtmData);
$fotortm = 'data:image/' . $type1 . ';base64,' . $rtmBase64Data;

$type2 = pathinfo($urlcedp, PATHINFO_EXTENSION);
$cedpData = file_get_contents($urlcedp, false, stream_context_create($arrContextOptions));
$cedpBase64Data = base64_encode($cedpData);
$fotocedp = 'data:image/' . $type2 . ';base64,' . $cedpBase64Data;

$type3 = pathinfo($urlrutp, PATHINFO_EXTENSION);
$rutpData = file_get_contents($urlrutp, false, stream_context_create($arrContextOptions));
$rutpBase64Data = base64_encode($rutpData);
$fotorutp = 'data:image/' . $type3 . ';base64,' . $rutpBase64Data;

$type4 = pathinfo($urlremolque, PATHINFO_EXTENSION);
$remolqueData = file_get_contents($urlremolque, false, stream_context_create($arrContextOptions));
$remolqueBase64Data = base64_encode($remolqueData);
$fotoremolque = 'data:image/' . $type4 . ';base64,' . $remolqueBase64Data;

$type5 = pathinfo($urllict, PATHINFO_EXTENSION);
$lictData = file_get_contents($urllict, false, stream_context_create($arrContextOptions));
$lictBase64Data = base64_encode($lictData);
$fotolict = 'data:image/' . $type5 . ';base64,' . $lictBase64Data;

$type6 = pathinfo($urlfrontal, PATHINFO_EXTENSION);
$frontalData = file_get_contents($urlfrontal, false, stream_context_create($arrContextOptions));
$frontalBase64Data = base64_encode($frontalData);
$frontal = 'data:image/' . $type6 . ';base64,' . $frontalBase64Data;

$type7 = pathinfo($urllateral, PATHINFO_EXTENSION);
$lateralData = file_get_contents($urllateral, false, stream_context_create($arrContextOptions));
$lateralBase64Data = base64_encode($lateralData);
$lateral = 'data:image/' . $type7 . ';base64,' . $lateralBase64Data;

$type8 = pathinfo($urltrasera, PATHINFO_EXTENSION);
$traseraData = file_get_contents($urltrasera, false, stream_context_create($arrContextOptions));
$traseraBase64Data = base64_encode($traseraData);
$trasera = 'data:image/' . $type8 . ';base64,' . $traseraBase64Data;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hoja de vida vehiculo</title>
        <style type="text/css">
            table { 
                margin: 0 auto;
                font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
                font-size: 12px; margin-top: 25px; margin-bottom: 25px; width: 720px; text-align: left;
                border-collapse: collapse; }

            th {     
                font-size: 13px;     
                font-weight: normal;     
                padding: 2px;     
                background: #BDBDBD; border: 1px solid #000000; color: #fff; }

            td {   
                text-align: center; 
                padding: 2px;     
                background: #fff;    
                border: 1px solid #000000;
                color: #000000;}
            .footer {
                position: fixed;
                left: 0px;
                bottom: -180px;
                right: 0px;
                height: 220px;
                text-align: center
            }
            .footer .page:after {
                content: counter(page, upper-roman);
            }
            h1{
                color: #DFBE00;
                text-decoration: underline;
                text-align: center
            }
            h3 {
                color: #DFBE00;
                text-decoration: underline
            }
            h5 {
                color: #B1562A;
                text-align: center;
            }
            hr {color:#DFBE00;
                width: 100%
            }
            .ext {
                margin-left: auto;
                margin-right: auto;
                padding-top: 17px;
                width: 190px;
                height: 70px;
                background-color: #DFBE00;
                text-align: center;
                border-radius: 40%;
                border: 3px solid #CCC;
            }
            .rectangulo {
                margin: 0 auto;
                width: 160px;
                height: 50px;
                background-color: #DFBE00;
                text-align: center;
                color: white;
                border: 2px solid #CCC;
                font-size: 21;
            }
            .docs {
                max-width:100%;width:auto;height:auto 
            }
        </style>
    </head>
    <body>
        <div class="footer"><hr><h5>Enturne En Línea SAS, No se hace responsable de la informacion contenida en esta hoja de vida, es deber del usuario que haga uso de ésta, 
                validar su autenticidad y de realizar el uso adecuado.</h5></div>
        <h1>HOJA DE VIDA - VEHICULO</h1>
        <div class="ext"><div class="rectangulo"><?= $placa ?></div></div><br>
        <h3>INFORMACION DEL VEHICULO</h3>
        <br><br>
        <div style="text-align:center">
            <img src="<?= $frontal; ?>" width="160" height="190" alt="">&nbsp;&nbsp;
            <img src="<?= $lateral; ?>" width="320" height="190" alt="">&nbsp;&nbsp;
            <img src="<?= $trasera; ?>" width="160" height="190" alt="">
        </div>
        <table>
            <thead>
                <tr>
                    <th>PLACA</th>
                    <th>MARCA</th>
                    <th>MODELO</th>
                    <th>PESO VACIO</th>
                    <th>CAPACIDAD</th>
                    <th>MATRICULA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $placa ?></td>
                    <td><?= $marcav ?></td>
                    <td><?= $modelo ?></td>
                    <td><?= $pesov ?></td>
                    <td><?= $capacidad ?></td>
                    <td><?= $matricula ?></td>
                </tr>
                <?php if ($trailer == '') { ?>
                <?php } else { ?>
                    <tr>
                        <td><?= $trailer ?></td>
                        <td><?= $tmarca ?></td>
                        <td><?= $tmodelo ?></td>
                        <td><?= $tpesov ?></td>
                        <td style="border: 0"></td>
                        <td style="border: 0"></td>
                    </tr>
                <?php } ?>
            </tbody>        
        </table>
        <table>
            <thead>
                <tr>
                    <th>DOCUMENTO</th>
                    <th>VENCIMIENTO</th>
                    <th>NUMERO</th>
                    <th>ASEGURADORA</th>                   
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>SOAT</td>
                    <td><?= $vencesoat ?></td>
                    <td><?= $numsoat ?></td>
                    <td><?= $nomaseg ?></td>           
                </tr>
                <tr>
                    <td>REVISION TECNOMECANICA</td>              
                    <td><?= $vencetecno ?></td>
                    <td style="border: 0"></td>
                    <td style="border: 0"></td>
                </tr>
            </tbody>
        </table>
        <h3>INFORMACION DEL PROPIETARIO</h3>
        <table>
            <thead>
                <tr>
                    <th>NOMBRE</th>
                    <th>CEDULA</th>
                    <th>DIRECCION</th>
                    <th>CIUDAD</th>
                    <th>TEL. 2</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $propietario . ' ' . $apeprop; ?></td>
                    <td><?= $cedula ?></td>
                    <td><?= $direccion ?></td>
                    <td><?= $ciudadp ?></td>
                    <td><?= $telprop ?></td>
                </tr>
            </tbody>
        </table>
        <br><br><br><br><br><br>
        <h2>DOCUMENTACIÓN</h2>
        <br>
    <center><img class = "docs" src = "<?= $fotolict ?>" alt="Licencia de transito"></center>
    <br>
    <center><img class = "docs" src = "<?= $fotosoat ?>" alt="Soat"></center>
    <br>
    <center><img class = "docs" src = "<?= $fotortm ?>" alt="RTM"></center>
    <?php if ($trailer == '') { ?>
    <?php } else { ?>
        <br>
        <center><img class = "docs" src = "<?= $fotoremolque ?>" alt="Remolque"></center>
    <?php } ?>
    <br>
    <center><img class = "docs" src = "<?= $fotocedp ?>" alt="Cédula Propietario"></center>
    <br>
    <center><img class = "docs" src = "<?= $fotorutp ?>" alt="Rut Propietario"></center>
    <br>
    <center><a href="<?= $docVehiculo ?>" target="_blank">Otros documentos del vehiculo . (Para visualizarlos, dar clic derecho y seleccionar abrir enlace en una pestaña nueva)</a></center>
    <br>
    <h5>DECLARACION DE CONSENTIMIENTO
        Declaracion de los clientes que reciben asistencia ÚNICAMENTE para el ingreso de informacion en la solicitud en línea: He recibido ayuda del personal de Enturne En Línea SAS para ingresar la hoja de vida mía y de los datos del vehículo que conduzco. He proporcionado toda la informacion y respuestas requeridas en el formulario de Hoja de vida. He leído el formulario de solicitud una vez completo e impreso. Asimismo declaro que la informacion que he brindado es verdadera y que los documentos que presento para apoyar mi solicitud son genuinos y no han sido alterados de ninguna forma.
        POLÍTICA DE PRIVACIDAD Y DE PROTECCIÓN DE DATOS PERSONALES

        La presente política de privacidad y de proteccion de datos personales; regula la recoleccion, almacenamiento, tratamiento, administracion, transferencia, transmision y proteccion de aquella informacion que se reciba de terceros a través de los diferentes canales de recoleccion de informacion (en adelante los "Datos Personales") que Enturne En Líneas SAS. identificada con NIT 900.612.664-1, y domiciliada en la Cra 96G N° 19A -18 de la ciudad de Bogotá D.C., Colombia, Correo electronico: administrativo@enturne.co, Teléfono: 4968958-, a través de los servicios ofrecidos en www.enturne.co, ha dispuesto al público en general, de acuerdo con las disposiciones contenidas en la Ley Estatutaria 1581 de 2012, Decreto 1377 de 2013, y demás normas concordantes, por las cuales se dictan disposiciones generales para la proteccion de datos personales. 
        ENTURNE, quien será el responsable del tratamiento de los Datos Personales, tal y como este término se define en la Ley 1581 de 2012, respeta la privacidad de cada uno de los terceros que le suministren sus Datos Personales a través de los diferentes puntos de recoleccion y captura de dicha informacion dispuestos para tal efecto. Enturne en Línea SAS recibe la mencionada informacion, la almacena de forma adecuada y segura, y usa, lo que no impide que los terceros puedan verificar la exactitud de la misma y ejercer sus derechos relativos a conocer, actualizar, rectificar y suprimir la informacion suministrada, así como su derecho a revocar la autoriza-cion suministrada a Enturne en Línea SAS para el tratamiento de sus Datos Personales. Los datos que Enturne en Línea SAS recolecta de terceros, se procesan y usa de conformidad con las regulaciones actuales de proteccion de informacion y privacidad, antes mencionadas.</h5>
    <table>
        <thead>
            <tr>
                <td height="120px">FIRMA-PROPIETARIO</td>
                <td></td>
            </tr>
            <tr>
                <td height="20px">NOMBRE-CC</td>
            </tr>
            <tr>
                <td>Fecha de Registro a Enturne En Linea</td>
                <td><?= $fa ?></td>
            </tr>
        </thead>
    </table>
</body>
</html>
